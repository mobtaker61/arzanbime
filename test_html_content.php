<?php
require_once 'config/config.php';

$config = require 'config/config.php';

try {
    $mysqli = new mysqli(
        $config['db']['host'],
        $config['db']['user'],
        $config['db']['pass'],
        $config['db']['name']
    );

    if ($mysqli->connect_error) {
        throw new Exception("Connection failed: " . $mysqli->connect_error);
    }

    echo "Connected to database successfully!\n";
    
    // Check post table structure
    $result = $mysqli->query("DESCRIBE post");
    if ($result) {
        echo "\nPost table structure:\n";
        while ($row = $result->fetch_assoc()) {
            echo "Field: {$row['Field']}, Type: {$row['Type']}, Null: {$row['Null']}, Key: {$row['Key']}, Default: {$row['Default']}\n";
        }
    }

    // Get a sample post with HTML content
    $result = $mysqli->query("SELECT id, title, LEFT(full_body, 200) as content_preview FROM post WHERE full_body IS NOT NULL AND full_body != '' ORDER BY id DESC LIMIT 1");
    if ($result) {
        echo "\nSample post content:\n";
        while ($row = $result->fetch_assoc()) {
            echo "ID: {$row['id']}\n";
            echo "Title: {$row['title']}\n";
            echo "Content Preview: " . htmlspecialchars($row['content_preview']) . "\n";
            echo "Content Length: " . strlen($row['content_preview']) . " characters\n";
            
            // Test htmlspecialchars_decode
            $decoded = htmlspecialchars_decode($row['content_preview']);
            echo "Decoded Preview: " . $decoded . "\n";
        }
    } else {
        echo "Error fetching sample post: " . $mysqli->error . "\n";
    }

    $mysqli->close();
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
?> 