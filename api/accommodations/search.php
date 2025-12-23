<?php
header('Content-Type: application/json');
require_once __DIR__ . '/../../controllers/AccommodationController.php';

$filters = $_GET + ($_POST ?? []);

$controller = new AccommodationController();
try {
    $result = $controller->search($filters);
    echo json_encode($result);
} catch (Throwable $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Server error']);
}
