<?php
header('Content-Type: application/json');
require_once __DIR__ . '/../../controllers/AccommodationController.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (($_SESSION['user']['role'] ?? null) !== 'senior') {
    http_response_code(403);
    echo json_encode(['success' => false, 'message' => 'Only senior students can post accommodations']);
    exit;
}

$input = json_decode(file_get_contents('php://input'), true) ?? $_POST;

$controller = new AccommodationController();
try {
    $result = $controller->create($input, (int) $_SESSION['user']['id']);
    echo json_encode($result);
} catch (Throwable $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Server error']);
}
