<?php
require_once __DIR__ . '/../config/database.php';
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("ID de question invalide.");
}

$question_id = intval($_GET['id']);

$sql = "SELECT * FROM questions WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->execute([':id' => $question_id]);
$question = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$question) {
    die("Question non trouvée.");
}

$taux_reussite = ($question['tentatives'] > 0) ? round(($question['reussites'] / $question['tentatives']) * 100, 2) : 0;
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Répondre à la question</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
    <h2 class="mb-4">Répondre à la question</h2>
    
    <p><strong>Question :</strong> <?= htmlspecialchars($question['question']) ?></p>
    <p><strong>Taux de réussite :</strong> <?= $taux_reussite ?>%</p>

    <form action="../controllers/answer_question.php" method="POST">
        <input type="hidden" name="id" value="<?= $question_id ?>">
        <div class="mb-3">
            <label for="reponse" class="form-label">Votre réponse :</label>
            <input type="text" class="form-control" id="reponse" name="reponse" required>
        </div>
        <button type="submit" class="btn btn-primary">Valider</button>
        <a href="../views/list.php" class="btn btn-secondary mt-3">Retour à la liste</a>
    </form>
</body>
</html>
