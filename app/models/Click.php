<?php

namespace app\models;

use core\Model;
use PDO;

/**
 * Click model handles click tracking and analytics database operations.
 */
class Click extends Model {
    /**
     * Records a new click for a link.
     * 
     * @param int $linkId The ID of the link clicked.
     * @param string $ipAddress The IP address of the visitor.
     * @param string $userAgent The user agent string of the visitor.
     * @return bool True on success, false on failure.
     */
    public function create($linkId, $ipAddress, $userAgent) {
        $stmt = $this->db->prepare("INSERT INTO clicks (link_id, ip_address, user_agent) VALUES (?, ?, ?)");
        return $stmt->execute([$linkId, $ipAddress, $userAgent]);
    }

    /**
     * Retrieves all click records for a specific link.
     * 
     * @param int $linkId The link ID.
     * @return array List of click records.
     */
    public function getByLinkId($linkId) {
        $stmt = $this->db->prepare("SELECT * FROM clicks WHERE link_id = ? ORDER BY clicked_at DESC");
        $stmt->execute([$linkId]);
        return $stmt->fetchAll();
    }

    /**
     * Retrieves daily click statistics for a link for the last 7 days.
     * 
     * @param int $linkId The link ID.
     * @return array Daily click statistics (date and count).
     */
    public function getStatsByLinkId($linkId) {
        // Daily clicks for the last 7 days
        $stmt = $this->db->prepare("
            SELECT DATE(clicked_at) as date, COUNT(*) as count 
            FROM clicks 
            WHERE link_id = ? 
            AND clicked_at >= DATE_SUB(NOW(), INTERVAL 7 DAY)
            GROUP BY DATE(clicked_at)
            ORDER BY date ASC
        ");
        $stmt->execute([$linkId]);
        return $stmt->fetchAll();
    }
}
