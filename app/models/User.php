<?php

namespace App\Models;

use Core\Model;
use PDO;

/**
 * User model handles user-related database operations.
 */
class User extends Model {
    /**
     * Creates a new user in the database.
     * 
     * @param string $username The username.
     * @param string $email The user's email address.
     * @param string $password The plain-text password (will be hashed).
     * @return bool True on success, false on failure.
     */
    public function create($username, $email, $password) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $this->db->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        return $stmt->execute([$username, $email, $hashedPassword]);
    }

    /**
     * Finds a user by their email address.
     * 
     * @param string $email The email address to search for.
     * @return array|false The user data as an associative array, or false if not found.
     */
    public function findByEmail($email) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch();
    }

    /**
     * Finds a user by their unique ID.
     * 
     * @param int $id The user ID.
     * @return array|false The user data as an associative array, or false if not found.
     */
    public function findById($id) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    /**
     * Updates a user's information.
     * 
     * @param int $id The user ID.
     * @param string $username The new username.
     * @param string|null $password The new plain-text password (optional).
     * @return bool True on success, false on failure.
     */
    public function update($id, $username, $password = null) {
        if ($password) {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $this->db->prepare("UPDATE users SET username = ?, password = ? WHERE id = ?");
            return $stmt->execute([$username, $hashedPassword, $id]);
        } else {
            $stmt = $this->db->prepare("UPDATE users SET username = ? WHERE id = ?");
            return $stmt->execute([$username, $id]);
        }
    }
}
