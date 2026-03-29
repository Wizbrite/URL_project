<?php

namespace Config;

use PDO;
use PDOException;

/**
 * Database configuration and connection manager.
 * 
 * Provides a static method to obtain a shared PDO connection instance.
 */
class Database {
    /** @var string Hostname for the database connection. */
    private static $host = 'localhost';
    /** @var string Name of the database. */
    private static $db_name = 'url_shortener';
    /** @var string Username for the database connection. */
    private static $username = 'root';
    /** @var string Password for the database connection. */
    private static $password = 'njini000';
    /** @var \PDO|null The shared PDO connection instance. */
    private static $conn;

    /**
     * Returns a singleton PDO connection to the database.
     * 
     * Configures the connection with error exceptions and associative fetch mode.
     * Terminates the script if connection fails.
     * 
     * @return \PDO The database connection.
     */
    public static function getConnection() {
        if (self::$conn === null) {
            try {
                self::$conn = new PDO(
                    "mysql:host=" . self::$host . ";dbname=" . self::$db_name,
                    self::$username,
                    self::$password
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
