<?php
include '../../../config.php';

// Força UTF-8 na conexão com o banco
$connection->set_charset("utf8mb4");

if (!isset($_GET['country_id'])) {
    die("Error: country ID not provided.");
}

$country_id = intval($_GET['country_id']);

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

// Criar o CSV
$filename = "translations_$country_id.csv";
header('Content-Type: text/csv; charset=utf-8');
header("Content-Disposition: attachment; filename=\"$filename\"");

$output = fopen('php://output', 'w');

// Adiciona BOM para evitar problemas de caracteres no Excel
fprintf($output, chr(0xEF).chr(0xBB).chr(0xBF));

fputcsv($output, ["Question", "Translation"], ";"); // Cabeçalho

// Escrever os dados
$index = 1;
foreach ($questions as $key => $question) {
    if (!isset($translations[$key])) continue;
    $translation = $translations[$key];

    // Converter para UTF-8 caso necessário
    $question = mb_convert_encoding($question, 'UTF-8', 'auto');
    $translation = mb_convert_encoding($translation, 'UTF-8', 'auto');

    fputcsv($output, ["$index. $question", $translation], ";");

    $index++;
}

fclose($output);
exit();
?>