<?php

namespace Core;

use Config\Database;

/**
 * Base Model class for the MVC framework.
 * 
 * Each model connects to the database upon instantiation.
 */
class Model {
    /**
     * @var \PDO The database connection instance.
     */
    protected $db;

    /**
     * Constructor initializes the database connection.
     */
    public function __construct() {
        $this->db = Database::getConnection();
    }
}
