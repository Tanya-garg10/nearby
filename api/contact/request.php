<?php
header('Content-Type: application/json');
require_once __DIR__ . '/../../controllers/ContactController.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$user = $_SESSION['user'] ?? null;
$input = json_decode(file_get_contents('php://input'), true) ?? $_POST;

$controller = new ContactController();
try {
    $result = $controller->requestContact($input, $user);
    echo json_encode($result);
} catch (Throwable $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Server error']);
}
