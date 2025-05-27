<?php
session_start();
header('Content-Type: application/json');

// Book database (would normally be in a separate file)
$books = [
    '1234567890' => ['title' => 'JavaScript Basics', 'price' => 29.99],
    '0987654321' => ['title' => 'Advanced JavaScript', 'price' => 39.99],
    '1122334455' => ['title' => 'PHP Programming', 'price' => 24.99]
];

// Initialize cart if not exists
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

$isbn = $_GET['isbn'] ?? '';
$action = $_GET['action'] ?? '';

if ($action === 'add' && isset($books[$isbn])) {
    // Add item to cart
    if (!isset($_SESSION['cart'][$isbn])) {
        $_SESSION['cart'][$isbn] = $books[$isbn];
        $_SESSION['cart'][$isbn]['quantity'] = 1;
    } else {
        $_SESSION['cart'][$isbn]['quantity']++;
    }
} elseif ($action === 'remove' && isset($_SESSION['cart'][$isbn])) {
    // Remove one copy of the item
    if ($_SESSION['cart'][$isbn]['quantity'] > 1) {
        $_SESSION['cart'][$isbn]['quantity']--;
    } else {
        unset($_SESSION['cart'][$isbn]);
    }
}

// Prepare response
$response = [];
foreach ($_SESSION['cart'] as $isbn => $item) {
    $response[] = [
        'isbn' => $isbn,
        'title' => $item['title'],
        'price' => $item['price'] * $item['quantity'],
        'quantity' => $item['quantity']
    ];
}

echo json_encode($response);
?>