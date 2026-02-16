<?php
// inc/page_top.php
// Usage:
//   $pageTitle = 'Some Title';
//   include __DIR__ . '/page_top.php';

if (!isset($pageTitle) || $pageTitle === '') {
    $pageTitle = 'MiniLicensePlates.com';
}
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo htmlspecialchars($pageTitle, ENT_QUOTES, 'UTF-8'); ?></title>

    <!-- DO NOT change the CSS path/name. Keep exactly as your working index uses -->
    <link rel="stylesheet" href="main.css" />
</head>
<body>

<?php include __DIR__ . '/../header.php'; ?>

<div class="content-wrapper">
