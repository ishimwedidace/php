<?php
include "connection.php";

$file = __DIR__ . "/files/report.php";

if (file_exists($file)) {

    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="report.php"');
    header('Content-Length: ' . filesize($file));

    readfile($file);
    exit;

} else {
    echo "❌ File not found: " . $file;
}


?>