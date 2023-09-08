<?php
$uploadDir = 'uploads/card_english/';
$uploadFile = $uploadDir . basename($_FILES['pdfFile']['name']);
$thumbnailFile = $uploadDir . 'thumbnail.jpg'; // Nome fixo para a thumbnail

echo $uploadFile;
echo $thumbnailFile;

if (move_uploaded_file($_FILES['pdfFile']['tmp_name'], $uploadFile)) {
    // Se o upload for bem-sucedido, gere a thumbnail
    // Você pode usar uma biblioteca como Imagick para criar a thumbnail

    // Verifica se o PDF já existe
    if (file_exists($thumbnailFile)) {
        unlink($thumbnailFile); // Remove o arquivo existente
    }

    // Gere a nova thumbnail
    // Exemplo usando Imagick:
    $imagick = new Imagick($uploadFile);
    $imagick->setIteratorIndex(0); // Primeira página do PDF
    $imagick->thumbnailImage(100, 100); // Tamanho da thumbnail
    $imagick->writeImage($thumbnailFile);

    echo json_encode(array('success' => true, 'thumbnail' => $thumbnailFile));
} else {
    echo json_encode(array('success' => false, 'message' => 'Falha no upload do PDF.'));
}
?>
