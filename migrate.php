<?php

require_once 'vendor/autoload.php';

use App\Migrations\CreateAgentClientsTable;

// Load config
$config = require 'config/config.php';

// Set environment variables
putenv('DB_HOST=' . $config['db']['host']);
putenv('DB_USER=' . $config['db']['user']);
putenv('DB_PASS=' . $config['db']['pass']);
putenv('DB_NAME=' . $config['db']['name']);

try {
    $migration = new CreateAgentClientsTable();
    $migration->up();
    echo "Migration completed successfully!\n";
} catch (Exception $e) {
    echo "Migration failed: " . $e->getMessage() . "\n";
} 