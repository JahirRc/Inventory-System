<?php
include('../connection.php');

$stmt = $conn->prepare("SELECT nombre_categoria from categoria ORDER BY nombre_categoria ASC");

$stmt->execute();

$stmt->setFetchMode(PDO::FETCH_ASSOC);

return $stmt->fetchAll();