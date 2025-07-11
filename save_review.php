
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    
    $name = htmlspecialchars($data['name']);
    $rating = htmlspecialchars($data['rating']);
    $review = htmlspecialchars($data['review']);

    // Bewertungen in einer JSON-Datei speichern
    $filePath = 'reviews.json';
    $reviews = [];

    if (file_exists($filePath)) {
        $reviews = json_decode(file_get_contents($filePath), true);
    }

    $reviews[] = [
        'name' => $name,
        'rating' => $rating,
        'review' => $review
    ];

    file_put_contents($filePath, json_encode($reviews));

    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false]);
}
?>