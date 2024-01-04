<?php require_once('server/config.php'); ?>

<?php
// Preventing the direct access of this page.
if (!isset($_REQUEST['id'])) {
    header('location: 404.php');
    exit;
} else {
    // Checking if the id is valid or not
    $statement = $PDO->prepare("SELECT * FROM projects WHERE id=?");
    $statement->execute(array($_REQUEST['id']));
    $total = $statement->rowCount();
    if ($total == 0) {
        header('location: 404.php');
        exit;
    }
}
?>

<?php

// Getting photo ID to unlink from folder
$statement = $PDO->prepare("SELECT * FROM projects WHERE id=?");
$statement->execute(array($_REQUEST['id']));
$result = $statement->fetchAll(PDO::FETCH_ASSOC);
foreach ($result as $row) {
    $photo = $row['image'];
    unlink('../assets/images/' . $photo);
}



// Delete from tbl_slider
$statement = $PDO->prepare("DELETE FROM projects WHERE id=?");
$statement->execute(array($_REQUEST['id']));

header('location: index.php');
?>