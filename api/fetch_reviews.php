<?php
require_once '../config/db.php';
header('Content-Type: application/json');

$post_id = isset($_GET['post_id']) ? (int) $_GET['post_id'] : 0;

if ($post_id <= 0) {
    echo json_encode(["success" => false]);
    exit;
}

// Get average rating
$avgStmt = $conn->prepare("
    SELECT AVG(rating) as avg_rating, COUNT(*) as total_reviews 
    FROM reviews 
    WHERE post_id = ?
");
$avgStmt->bind_param("i", $post_id);
$avgStmt->execute();
$avgResult = $avgStmt->get_result()->fetch_assoc();

// Get reviews list
$stmt = $conn->prepare("
    SELECT r.rating, r.review, r.created_at, u.name 
    FROM reviews r
    JOIN users u ON r.user_id = u.id
    WHERE r.post_id = ?
    ORDER BY r.created_at DESC
");
$stmt->bind_param("i", $post_id);
$stmt->execute();
$result = $stmt->get_result();

$reviews = [];
while ($row = $result->fetch_assoc()) {
    $reviews[] = $row;
}

echo json_encode([
    "success" => true,
    "average" => round($avgResult['avg_rating'], 1),
    "total" => $avgResult['total_reviews'],
    "reviews" => $reviews
]);
?>
