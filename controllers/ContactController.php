<?php
require_once __DIR__ . '/../config/Database.php';

class ContactController
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::connection();
    }

    public function requestContact(array $payload, ?array $user): array
    {
        if (!$user) {
            return ['success' => false, 'message' => 'Please login to contact the owner'];
        }

        if (empty($payload['accommodation_id'])) {
            return ['success' => false, 'message' => 'Missing accommodation reference'];
        }

        $stmt = $this->db->prepare('SELECT id FROM accommodations WHERE id = ? AND is_active = 1');
        $stmt->execute([(int)$payload['accommodation_id']]);
        if (!$stmt->fetch()) {
            return ['success' => false, 'message' => 'Accommodation not found'];
        }

        $stmt = $this->db->prepare('INSERT INTO contact_requests (accommodation_id, requester_id, message)
                                    VALUES (?, ?, ?)');
        $stmt->execute([
            (int)$payload['accommodation_id'],
            (int)$user['id'],
            $payload['message'] ?? null
        ]);

        return ['success' => true, 'message' => 'Request sent to the owner'];
    }
}
