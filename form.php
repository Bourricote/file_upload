<?php

$uploadDir = 'uploaded_files/';
$allowedTypes = [
    'image/jpeg',
    'image/png',
    'image/gif',
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (count($_FILES['file']['name']) > 0) {
        for ($i = 0; $i < count($_FILES['file']['name']); $i++) {
            $extension = pathinfo($_FILES['file']['name'][$i], PATHINFO_EXTENSION);
            $uploadFile = $uploadDir . 'image' . uniqid() . '.' . $extension;
            $fileSize = filesize($_FILES['file']['tmp_name'][$i]);
            $fileType = mime_content_type($_FILES['file']['tmp_name'][$i]);
            if ($fileSize < 1000 * 1000) {
                if (in_array($fileType, $allowedTypes)) {
                    move_uploaded_file($_FILES['file']['tmp_name'][$i], $uploadFile);
                } else {
                    echo 'Votre fichier doit être jpeg, png ou gif</br>';
                }
            } else {
                echo 'Taille limitée à 1Mo </br>';
            }
        }
    }
}

$images = array_slice(scandir($uploadDir), 2);
