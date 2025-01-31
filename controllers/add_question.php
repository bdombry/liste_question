<?php
require_once __DIR__ . '/../config/database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $question = trim($_POST["question"]);
    $reponse = trim($_POST["reponse"]);
    $message_succes = trim($_POST["message_succes"]);
    $message_echec = trim($_POST["message_echec"]);

    if (!empty($question) && !empty($reponse) && !empty($message_succes) && !empty($message_echec)) {
        try {
            $sql = "INSERT INTO questions (question, reponse, message_succes, message_echec) 
                    VALUES (:question, :reponse, :message_succes, :message_echec)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ':question' => $question,
                ':reponse' => $reponse,
                ':message_succes' => $message_succes,
                ':message_echec' => $message_echec
            ]);

            $last_id = $pdo->lastInsertId();
            $url = "http://localhost/escape_game/views/answer.php?id=" . $last_id;

            $success = true;
        } catch (PDOException $e) {
            $error_message = "Erreur lors de l'ajout de la question : " . $e->getMessage();
        }
    } else {
        $error_message = "Tous les champs sont obligatoires.";
    }
} else {
    die("Accès interdit.");
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajout de Question</title>
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
        .link-box {
            background: #f8f9fa;
            padding: 10px;
            border-radius: 10px;
            display: inline-block;
            word-break: break-all;
        }
    </style>
</head>
<body class="d-flex justify-content-center align-items-center vh-100">
    <div class="container">
        <?php if (isset($success) && $success): ?>

            <div class="alert alert-success p-4 rounded shadow">
                <div class="emoji">✅</div>
                <h2 class="mt-3">Question ajoutée avec succès !</h2>
                <p class="mt-3">Vous pouvez partager ce lien pour répondre :</p>
                <div class="link-box">
                    <a href="<?= $url ?>" target="_blank"><?= $url ?></a>
                </div>
            </div>
            <a href="../views/add_question.php" class="btn btn-primary mt-3">Ajouter une autre question</a>
            <a href="../index.php" class="btn btn-secondary mt-3">Voir toutes les questions</a>
        <?php elseif (isset($error_message)): ?>

            <div class="alert alert-danger p-4 rounded shadow">
                <div class="emoji">⚠️</div>
                <h2 class="mt-3">Erreur</h2>
                <p class="mt-3"><?= $error_message ?></p>
                <a href="../views/add_question.php" class="btn btn-danger mt-3">Réessayer</a>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
