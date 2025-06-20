<?php

// Load config
$config = require 'config/config.php';

try {
    // Connect to MySQL without selecting a database
    $mysqli = new mysqli(
        $config['db']['host'],
        $config['db']['user'],
        $config['db']['pass']
    );

    if ($mysqli->connect_error) {
        throw new Exception("Connection failed: " . $mysqli->connect_error);
    }

    // Create database if it doesn't exist
    $dbName = $config['db']['name'];
    $result = $mysqli->query("CREATE DATABASE IF NOT EXISTS `$dbName`");

    if ($result) {
        echo "Database '$dbName' created or already exists.\n";
    } else {
        throw new Exception("Error creating database: " . $mysqli->error);
    }

    // Select the database
    if (!$mysqli->select_db($dbName)) {
        throw new Exception("Error selecting database: " . $mysqli->error);
    }

    echo "Database setup completed successfully!\n";
    
} catch (Exception $e) {
    echo "Setup failed: " . $e->getMessage() . "\n";
} 