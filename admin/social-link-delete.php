<?php require_once('server/config.php') ?>


<?php

if (!isset($_REQUEST['id'])) {
    header('location: 404.php');
    exit;
} else {
    // Check if the id is valid or not
    $statement = $PDO->prepare("SELECT * FROM social_links WHERE id=?");
    $statement->execute([$_REQUEST['id']]);
    $total = $statement->rowCount();
    if ($total == 0) {
        header('location: 404.php');
        exit;
    }
}

// Delete service from database and redirect to services page
$statement = $PDO->prepare("DELETE FROM social_links WHERE id=?");
$statement->execute([$_REQUEST['id']]);

header('location: social-links.php');
