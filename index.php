<?php
require_once __DIR__ . '/config/database.php';

$order = isset($_GET['order']) && $_GET['order'] === 'asc' ? 'ASC' : 'DESC';

$sql = "SELECT *, 
            (CASE WHEN tentatives > 0 THEN ROUND((reussites / tentatives) * 100, 2) ELSE 0 END) AS taux_reussite
        FROM questions
        ORDER BY taux_reussite $order";

$stmt = $pdo->query($sql);
$questions = $stmt->fetchAll(PDO::FETCH_ASSOC);

$next_order = ($order === 'ASC') ? 'desc' : 'asc';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des questions</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
    <h2 class="mb-4">Liste des questions</h2>

    <a href="index.php?order=<?= $next_order ?>" class="btn btn-secondary mb-3">
        Trier par taux de réussite (<?= $order === 'ASC' ? 'Croissant' : 'Décroissant' ?>)
    </a>

    <?php if (count($questions) > 0): ?>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Question</th>
                    <th>Taux de réussite</th>
                    <th>Tentative(s)</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($questions as $question): ?>
                    <tr>
                        <td><?= $question['id'] ?></td>
                        <td><?= htmlspecialchars($question['question']) ?></td>
                        <td><?= $question['taux_reussite'] ?>%</td>
                        <td><?= $question['tentatives']  ?></td>
                        <td>
                            <a href="views/answer.php?id=<?= $question['id'] ?>" class="btn btn-success btn-sm">Répondre</a>
                            <a href="controllers/delete_question.php?id=<?= $question['id'] ?>" class="btn btn-danger btn-sm">Supprimer</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>Aucune question disponible.</p>
    <?php endif; ?>

    <a href="views/add_question.php" class="btn btn-primary mt-3">Ajouter une nouvelle question</a>
</body>
</html>
