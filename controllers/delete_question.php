<?php
require_once __DIR__ . '/../config/database.php';

// Vérifier si un ID est passé dans l'URL
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("ID de question invalide.");
}

$question_id = intval($_GET['id']);

try {
    $stmt = $pdo->prepare("DELETE FROM questions WHERE id = :id");
    $stmt->execute([':id' => $question_id]);

    header("Location: ../index.php");
    exit();
} catch (PDOException $e) {
    die("Erreur lors de la suppression : " . $e->getMessage());
}
?>
