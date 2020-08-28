<?php
    $folderDest = './';
    $ext = strtolower(pathinfo($_FILES["file-upload"]["name"], PATHINFO_EXTENSION));
    $destination = $folderDest . sha1(md5($_FILES["file-upload"]["name"]));

    $source = $_FILES["file-upload"]["tmp_name"];
        
    $error = "";

    if (file_exists($destination. "." . $ext)) { $error = $destination . " já foi enviado."; }

    if ($error == "") {
    $allowed = ["jpg", "jpeg", "png", "gif"];
        if (!in_array($ext, $allowed)) {
            $error = "$ext, esta extensão, não é suportada. Apenas: jpg, jpeg png e gif - " . $_FILES["file-upload"]["name"];
        }
    }

    if ($error == "") {
        if (getimagesize($_FILES["file-upload"]["tmp_name"]) == false) {
            $error = "O arquivo - " . $_FILES["file-upload"]["name"] . " - não é uma imagem.";
        }
    }

    if ($error == "") {
        if ($_FILES["file-upload"]["size"] > 50000000) {
            $error = "Desculpe, ". $_FILES["file-upload"]["name"] . " - é um arquivo muito grande e não pode ser guardado!";
        }
    }

    if ($error == "") {
        if (!move_uploaded_file($source, $destination.".".$ext)) {
            $error = "Erro ao mover de $source para $destination";
        }
    }

    // ERROR OCCURED OR OK?
    if ($error == "") {
    echo $_FILES["file-upload"]["name"] . " - Envio com sucesso";
    } else {
    echo $error;
    }