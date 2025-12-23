<?php
require_once __DIR__ . '/../config/Database.php';

class AuthController
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::connection();
    }

    public function register(array $payload): array
    {
        $required = ['name', 'email', 'password', 'role'];
        foreach ($required as $field) {
            if (empty($payload[$field])) {
                return ['success' => false, 'message' => ucfirst($field) . ' is required'];
            }
        }

        if (!filter_var($payload['email'], FILTER_VALIDATE_EMAIL) || !str_ends_with($payload['email'], '.edu')) {
            return ['success' => false, 'message' => 'Please register using a valid college email'];
        }

        if (!in_array($payload['role'], ['junior', 'senior'], true)) {
            return ['success' => false, 'message' => 'Invalid role selected'];
        }

        $stmt = $this->db->prepare('SELECT id FROM users WHERE email = ?');
        $stmt->execute([$payload['email']]);
        if ($stmt->fetch()) {
            return ['success' => false, 'message' => 'Email is already registered'];
        }

        $hash = password_hash($payload['password'], PASSWORD_DEFAULT);
        $stmt = $this->db->prepare('INSERT INTO users (name, email, password_hash, role) VALUES (?, ?, ?, ?)');
        $stmt->execute([
            $payload['name'],
            strtolower($payload['email']),
            $hash,
            $payload['role']
        ]);

        return ['success' => true, 'message' => 'Registration successful. You can login now.'];
    }

    public function login(array $payload): array
    {
        $required = ['email', 'password', 'role'];
        foreach ($required as $field) {
            if (empty($payload[$field])) {
                return ['success' => false, 'message' => ucfirst($field) . ' is required'];
            }
        }

        $stmt = $this->db->prepare('SELECT id, name, email, password_hash, role FROM users WHERE email = ? LIMIT 1');
        $stmt->execute([strtolower($payload['email'])]);
        $user = $stmt->fetch();

        if (!$user || !password_verify($payload['password'], $user['password_hash']) || $user['role'] !== $payload['role']) {
            return ['success' => false, 'message' => 'Invalid credentials'];
        }

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $_SESSION['user'] = [
            'id' => $user['id'],
            'name' => $user['name'],
            'email' => $user['email'],
            'role' => $user['role'],
        ];

        return [
            'success' => true,
            'message' => 'Login successful',
            'redirect' => $user['role'] === 'junior' ? 'junior-dashboard.php' : 'senior-dashboard.php'
        ];
    }
}
