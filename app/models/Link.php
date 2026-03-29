<?php

namespace App\Models;

use Core\Model;
use PDO;

/**
 * Link model handles link-related database operations.
 */
class Link extends Model {
    /**
     * Creates a new short link.
     * 
     * @param int $userId The ID of the user creating the link.
     * @param string $longUrl The original long URL.
     * @param string $shortSlug The custom or generated short slug.
     * @return bool True on success, false on failure.
     */
    public function create($userId, $longUrl, $shortSlug) {
        $stmt = $this->db->prepare("INSERT INTO links (user_id, long_url, short_slug) VALUES (?, ?, ?)");
        return $stmt->execute([$userId, $longUrl, $shortSlug]);
    }

    /**
     * Finds a link by its short slug.
     * 
     * @param string $slug The short slug.
     * @return array|false The link data, or false if not found.
     */
    public function findBySlug($slug) {
        $stmt = $this->db->prepare("SELECT * FROM links WHERE short_slug = ?");
        $stmt->execute([$slug]);
        return $stmt->fetch();
    }

    /**
     * Retrieves a paginated list of links for a specific user.
     * 
     * @param int $userId The ID of the user.
     * @param int $offset The starting offset for pagination.
     * @param int $limit The maximum number of links to return.
     * @return array List of links.
     */
    public function getByUserId($userId, $offset = 0, $limit = 10) {
        $stmt = $this->db->prepare("SELECT * FROM links WHERE user_id = ? ORDER BY created_at DESC LIMIT ?, ?");
        $stmt->bindParam(1, $userId, PDO::PARAM_INT);
        $stmt->bindParam(2, $offset, PDO::PARAM_INT);
        $stmt->bindParam(3, $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    /**
     * Gets the total number of links created by a user.
     * 
     * @param int $userId The ID of the user.
     * @return int Total number of links.
     */
    public function getCountByUserId($userId) {
        $stmt = $this->db->prepare("SELECT COUNT(*) as total FROM links WHERE user_id = ?");
        $stmt->execute([$userId]);
        $result = $stmt->fetch();
        return $result['total'];
    }

    /**
     * Deletes a link if it belongs to the specified user.
     * 
     * @param int $id The link ID.
     * @param int $userId The user ID for ownership verification.
     * @return bool True on success, false on failure.
     */
    public function delete($id, $userId) {
        $stmt = $this->db->prepare("DELETE FROM links WHERE id = ? AND user_id = ?");
        return $stmt->execute([$id, $userId]);
    }

    /**
     * Increments the click count for a link.
     * 
     * @param int $id The link ID.
     * @return bool True on success, false on failure.
     */
    public function incrementClicks($id) {
        $stmt = $this->db->prepare("UPDATE links SET clicks = clicks + 1 WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
