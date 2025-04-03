<?php
include '../../../config.php';

// Força UTF-8 na conexão com o banco
$connection->set_charset("utf8mb4");

if (!isset($_GET['country_id'])) {
    die("Error: country ID not provided.");
}

$country_id = intval($_GET['country_id']);

// Definir as configurações de separador baseado no parâmetro ou usar padrão
$delimiter = isset($_GET['delimiter']) ? $_GET['delimiter'] : 'auto';

// Detectar separador baseado na região ou escolha do usuário
if ($delimiter === 'auto') {
    // Tentar detectar a região do usuário para escolher o separador mais apropriado
    $user_locale = isset($_SERVER['HTTP_ACCEPT_LANGUAGE']) ? substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2) : 'en';
    
    // Alguns países europeus usam ; (ponto e vírgula) como separador padrão de CSV
    $semicolon_countries = ['fr', 'de', 'it', 'es', 'pt', 'nl', 'be', 'fi', 'se', 'dk', 'no', 'pl', 'cz', 'sk', 'hu'];
    
    $delimiter = in_array($user_locale, $semicolon_countries) ? ';' : ',';
} else if ($delimiter === 'semicolon') {
    $delimiter = ';';
} else if ($delimiter === 'tab') {
    $delimiter = "\t";
} else {
    // Padrão para vírgula se nenhuma opção válida for fornecida
    $delimiter = ',';
}

// Obter as perguntas e traduções
$sql = "SELECT * FROM translations WHERE country_id = $country_id";
$result = $connection->query($sql);
if ($result->num_rows == 0) {
    die("Error: no translations found for this country.");
}
$translations = $result->fetch_assoc();

$sql_questions = "SELECT * FROM translation_questions WHERE id = 1";
$result_questions = $connection->query($sql_questions);
$questions = $result_questions->fetch_assoc();
unset($questions['id']); // Remover ID do array

// Obter o nome do país para o arquivo
$sql_country = "SELECT name FROM countries WHERE id = $country_id";
$result_country = $connection->query($sql_country);
$country_name = $result_country->fetch_assoc()['name'];
$country_name = preg_replace('/[^a-zA-Z0-9_]/', '_', $country_name); // Sanitizar nome para o arquivo

// Criar o CSV
$filename = "translations_{$country_name}_{$country_id}.csv";
header('Content-Type: text/csv; charset=utf-8');
header("Content-Disposition: attachment; filename=\"$filename\"");

// Função segura para escrever uma linha CSV com escape adequado
function writeCSVLine($handle, $row, $delimiter) {
    $output = [];
    foreach ($row as $field) {
        // Sempre coloca aspas em todos os campos para evitar problemas com delimitadores no texto
        $output[] = '"' . str_replace('"', '""', $field) . '"';
    }
    fwrite($handle, implode($delimiter, $output) . "\r\n");
}

$output = fopen('php://output', 'w');

// Adiciona BOM para evitar problemas de caracteres no Excel
fprintf($output, chr(0xEF).chr(0xBB).chr(0xBF));

// Escrever cabeçalho
writeCSVLine($output, ["Question", "Translation"], $delimiter);

// Escrever os dados
$index = 1;
foreach ($questions as $key => $question) {
    if (!isset($translations[$key])) continue;
    $translation = $translations[$key];

    // Converter para UTF-8 caso necessário
    $question = mb_convert_encoding($question, 'UTF-8', 'auto');
    $translation = mb_convert_encoding($translation, 'UTF-8', 'auto');

    // Formatação final e escrita com escape seguro
    writeCSVLine($output, ["$index. $question", $translation], $delimiter);

    $index++;
}

fclose($output);
exit();
?>