<?php
require_once __DIR__ . '/../config/database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $question_id = intval($_POST["id"]);
    $reponse_utilisateur = trim($_POST["reponse"]);

    $sql = "SELECT * FROM questions WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':id' => $question_id]);
    $question = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$question) {
        die("Question non trouvée.");
    }

    $stmt = $pdo->prepare("UPDATE questions SET tentatives = tentatives + 1 WHERE id = :id");
    $stmt->execute([':id' => $question_id]);

    $bonne_reponse = strtolower($reponse_utilisateur) === strtolower($question['reponse']);
} else {
    die("Accès interdit.");
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Résultat de la réponse</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .container {
            max-width: 600px;
            margin-top: 50px;
            text-align: center;
        }
        .emoji {
            font-size: 50px;
        }
    </style>
</head>
<body class="d-flex justify-content-center align-items-center vh-100">
    <div class="container">
        <?php if ($bonne_reponse): ?>
            <div class="alert alert-success p-4 rounded shadow">
                <div class="emoji">🎉</div>
                <h2 class="mt-3">Bravo ! Bonne réponse !</h2>
                <p class="mt-3"><?= htmlspecialchars($question['message_succes']) ?></p>
                <a href="../views/list.php" class="btn btn-primary mt-3">Retour à la liste</a>
            </div>
            <?php
            $stmt = $pdo->prepare("UPDATE questions SET reussites = reussites + 1 WHERE id = :id");
            $stmt->execute([':id' => $question_id]);
            ?>
        <?php else: ?>
            <div class="alert alert-danger p-4 rounded shadow">
                <div class="emoji">❌</div>
                <h2 class="mt-3">Oups... Mauvaise réponse</h2>
                <p class="mt-3"><?= htmlspecialchars($question['message_echec']) ?></p>
                <a href="../views/answer.php?id=<?= $question_id ?>" class="btn btn-warning mt-3">Réessayer</a>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
