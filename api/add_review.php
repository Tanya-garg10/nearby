<?php
require_once '../config/db.php';
require_once '../includes/helpers/csrf.php';
session_start();

header('Content-Type: application/json');

// Check login
if (!isset($_SESSION['user_id'])) {
    echo json_encode(["success" => false, "message" => "Login required"]);
    exit;
}

$user_id = $_SESSION['user_id'];

// Validate input
$post_id = isset($_POST['post_id']) ? (int) $_POST['post_id'] : 0;
$rating  = isset($_POST['rating']) ? (int) $_POST['rating'] : 0;
$review  = isset($_POST['review']) ? trim($_POST['review']) : '';

if ($post_id <= 0 || $rating < 1 || $rating > 5) {
    echo json_encode(["success" => false, "message" => "Invalid input"]);
    exit;
}

// Prevent self review
$stmt = $conn->prepare("SELECT user_id FROM posts WHERE id = ?");
$stmt->bind_param("i", $post_id);
$stmt->execute();
$result = $stmt->get_result();
$post = $result->fetch_assoc();

if (!$post) {
    echo json_encode(["success" => false, "message" => "Post not found"]);
    exit;
}

if ($post['user_id'] == $user_id) {
    echo json_encode(["success" => false, "message" => "You cannot review your own listing"]);
    exit;
}

// Insert review
$stmt = $conn->prepare("INSERT INTO reviews (post_id, user_id, rating, review) VALUES (?, ?, ?, ?)");
$stmt->bind_param("iiis", $post_id, $user_id, $rating, $review);

if ($stmt->execute()) {
    echo json_encode(["success" => true, "message" => "Review added successfully"]);
} else {
    echo json_encode(["success" => false, "message" => "You already reviewed this listing"]);
}
?>
