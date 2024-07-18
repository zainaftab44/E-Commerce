<?php
include '../config.php';

// Create connection
$conn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Directory where SQL files are stored
$sqlDir = __DIR__ . '/pending/';
$sqlExecutedDir = __DIR__ . '/complete/';

// Scan directory for SQL files
$sqlFiles = scandir($sqlDir);
sort($sqlFiles); // Ensure files are executed in order

foreach ($sqlFiles as $file) {
    if (pathinfo($file, PATHINFO_EXTENSION) == 'sql') {
        $filePath = $sqlDir . $file;
        $sql = file_get_contents($filePath);

        if ($conn->multi_query($sql)) {
            do {
                if ($result = $conn->store_result()) {
                    $result->free();
                }
            } while ($conn->more_results() && $conn->next_result());

            // move executed file
            rename($file,$sqlExecutedDir.$file);
        } else {
            echo "Error executing $file: " . $conn->error . "\n";
        }
    }
}

$conn->close();
?>