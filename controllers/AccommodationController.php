<?php
require_once __DIR__ . '/../config/Database.php';

class AccommodationController
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::connection();
    }

    public function search(array $filters): array
    {
        $sql = 'SELECT a.id, a.title, a.type, a.allowed_for, a.monthly_rent, a.location, a.description, a.facilities, a.is_verified,
                       u.name AS owner_name
                FROM accommodations a
                INNER JOIN users u ON u.id = a.owner_id
                WHERE a.is_active = 1';
        $params = [];

        if (!empty($filters['query'])) {
            $sql .= ' AND (a.location LIKE :query OR a.title LIKE :query)';
            $params[':query'] = '%' . $filters['query'] . '%';
        }

        if (!empty($filters['type'])) {
            $sql .= ' AND a.type = :type';
            $params[':type'] = $filters['type'];
        }

        if (!empty($filters['allowed_for'])) {
            $sql .= ' AND a.allowed_for = :allowed_for';
            $params[':allowed_for'] = $filters['allowed_for'];
        }

        if (!empty($filters['max_rent'])) {
            $sql .= ' AND a.monthly_rent <= :max_rent';
            $params[':max_rent'] = (int)$filters['max_rent'];
        }

        if (!empty($filters['min_rent'])) {
            $sql .= ' AND a.monthly_rent >= :min_rent';
            $params[':min_rent'] = (int)$filters['min_rent'];
        }

        if (!empty($filters['facilities']) && is_array($filters['facilities'])) {
            foreach ($filters['facilities'] as $idx => $facility) {
                $key = ':facility' . $idx;
                $sql .= " AND FIND_IN_SET($key, a.facilities)";
                $params[$key] = $facility;
            }
        }

        $sql .= ' ORDER BY a.is_verified DESC, a.created_at DESC LIMIT 60';

        $stmt = $this->db->prepare($sql);
        foreach ($params as $key => $value) {
            $stmt->bindValue($key, $value, is_int($value) ? PDO::PARAM_INT : PDO::PARAM_STR);
        }
        $stmt->execute();

        $rows = $stmt->fetchAll();
        foreach ($rows as &$row) {
            $row['facilities'] = $row['facilities'] ? explode(',', $row['facilities']) : [];
        }

        return ['success' => true, 'data' => $rows];
    }

    public function create(array $payload, int $ownerId): array
    {
        $required = ['title', 'type', 'allowed_for', 'monthly_rent', 'location', 'description'];
        foreach ($required as $field) {
            if (empty($payload[$field])) {
                return ['success' => false, 'message' => ucfirst(str_replace('_', ' ', $field)) . ' is required'];
            }
        }

        $facilities = !empty($payload['facilities']) && is_array($payload['facilities'])
            ? implode(',', $payload['facilities'])
            : null;

        $stmt = $this->db->prepare('INSERT INTO accommodations (owner_id, title, type, allowed_for, monthly_rent, location, facilities, description, is_verified, is_active)
                                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, 0, 1)');
        $stmt->execute([
            $ownerId,
            $payload['title'],
            $payload['type'],
            $payload['allowed_for'],
            (int)$payload['monthly_rent'],
            $payload['location'],
            $facilities,
            $payload['description']
        ]);

        return ['success' => true, 'message' => 'Accommodation posted successfully'];
    }

    public function findOne(int $id): array
    {
        $stmt = $this->db->prepare('SELECT a.*, u.name AS owner_name, u.email AS owner_email
                                     FROM accommodations a
                                     INNER JOIN users u ON u.id = a.owner_id
                                     WHERE a.id = ? AND a.is_active = 1');
        $stmt->execute([$id]);
        $accommodation = $stmt->fetch();

        if (!$accommodation) {
            return ['success' => false, 'message' => 'Accommodation not found'];
        }

        $accommodation['facilities'] = $accommodation['facilities'] ? explode(',', $accommodation['facilities']) : [];
        return ['success' => true, 'data' => $accommodation];
    }
}
