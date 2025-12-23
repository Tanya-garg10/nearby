<?php
header('Content-Type: application/json');
require_once __DIR__ . '/../../controllers/AuthController.php';

$input = json_decode(file_get_contents('php://input'), true) ?? $_POST;

$auth = new AuthController();
$result = $auth->login($input);
echo json_encode($result);
