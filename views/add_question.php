<?php require_once __DIR__ . '/../config/database.php'; ?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter une question</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
    <h2 class="mb-4">Ajouter une question</h2>

    <form action="../controllers/add_question.php" method="POST">
        <div class="mb-3">
            <label for="question" class="form-label">Question :</label>
            <textarea class="form-control" id="question" name="question" required></textarea>
        </div>
        <div class="mb-3">
            <label for="reponse" class="form-label">Réponse attendue :</label>
            <input type="text" class="form-control" id="reponse" name="reponse" required>
        </div>
        <div class="mb-3">
            <label for="message_succes" class="form-label">Message de succès :</label>
            <input type="text" class="form-control" id="message_succes" name="message_succes" required>
        </div>
        <div class="mb-3">
            <label for="message_echec" class="form-label">Message d’échec :</label>
            <input type="text" class="form-control" id="message_echec" name="message_echec" required>
        </div>
        <button type="submit" class="btn btn-primary">Ajouter la question</button>
        <a href="../index.php" class="btn btn-secondary mt-3">Retour à la liste</a>

    </form>

</body>
</html>
