<?php
// site_top.php
if (!isset($pageTitle)) { $pageTitle = 'Mini License Plates'; }
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo htmlspecialchars($pageTitle, ENT_QUOTES, 'UTF-8'); ?></title>
    <link rel="stylesheet" href="main.css">
</head>
<body>

<?php include __DIR__ . '/header.php'; ?>

<div class="content-wrapper">
