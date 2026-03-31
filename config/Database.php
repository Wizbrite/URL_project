<?php

namespace config;

use PDO;
use PDOException;

/**
 * Database configuration and connection manager.
 *
 * Reads connection details from environment variables (loaded via .env)
 * so that no credentials are ever hardcoded in source control.
 */
class Database {
    /** @var \PDO|null The shared PDO connection instance. */
    private static $conn;

    /**
     * Returns a singleton PDO connection to the database.
     *
     * Reads DB_HOST, DB_NAME, DB_USER, and DB_PASS from the environment.
     * Configures the connection with error exceptions and associative fetch mode.
     * Terminates the script if connection fails.
     *
     * @return \PDO The database connection.
     */
    public static function getConnection() {
        if (self::$conn === null) {
            $host   = \env('DB_HOST', 'localhost');
            $dbName = \env('DB_NAME', '');
            $user   = \env('DB_USER', 'root');
            $pass   = \env('DB_PASS', '');

            try {
                self::$conn = new PDO(
                    "mysql:host={$host};dbname={$dbName};charset=utf8mb4",
                    $user,
                    $pass
                );
                self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                die("Connection error: " . $e->getMessage());
            }
        }
        return self::$conn;
    }
}
