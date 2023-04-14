<?php
require_once __DIR__ . '/config/database.php';
$stmt=$dbh->prepare("DELETE FROM users WHERE id = {$_GET['id']}");
$stmt->execute();
header("Location: index.php");

?>