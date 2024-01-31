<?php
// Return server's current time as JSON
header('Content-Type: application/json');
echo json_encode(['serverTime' => time()]);
?>
