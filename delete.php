<?php
$filename = 'uploaded_files/' . $_GET['image'];

if (file_exists($filename)) {
    unlink($filename);
}

header('location: index.php');