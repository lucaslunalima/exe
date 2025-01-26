<?php
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

// Verifica se o arquivo é uma imagem real ou falsa
if (isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if ($check !== false) {
        echo "Arquivo é uma imagem - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "Arquivo não é uma imagem.";
        $uploadOk = 0;
    }
}

// Verifica se o arquivo já existe
if (file_exists($target_file)) {
    echo "Desculpe, o arquivo já existe.";
    $uploadOk = 0;
}

// Verifica o tamanho do arquivo
if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "Desculpe, seu arquivo é muito grande.";
    $uploadOk = 0;
}

// Permite certos formatos de arquivo
if (
    $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif"
) {
    echo "Desculpe, apenas arquivos JPG, JPEG, PNG e GIF são permitidos.";
    $uploadOk = 0;
}

// Verifica se $uploadOk está definido como 0 por um erro
if ($uploadOk == 0) {
    echo "Desculpe, seu arquivo não foi enviado.";
    // Se tudo estiver ok, tenta fazer o upload do arquivo
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "O arquivo " . htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " foi enviado.";
    } else {
        echo "Desculpe, houve um erro ao enviar seu arquivo.";
    }
}
