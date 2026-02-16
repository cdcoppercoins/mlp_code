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

    <?php
    if (!isset($metaDescription)) $metaDescription = '';
    if (!isset($canonical)) $canonical = '';
    ?>
    <?php if ($metaDescription !== ''): ?>
        <meta name="description" content="<?php echo htmlspecialchars($metaDescription, ENT_QUOTES, 'UTF-8'); ?>">
    <?php endif; ?>

    <?php if ($canonical !== ''): ?>
        <link rel="canonical" href="<?php echo htmlspecialchars($canonical, ENT_QUOTES, 'UTF-8'); ?>">
    <?php endif; ?>

    <script type="application/ld+json">
    {
        "@context":"https://schema.org",
        "@type":"WebSite",
        "name":"MiniLicensePlates.com",
        "url":"https://minilicenseplates.com/"
    }
    </script>



    <!-- DO NOT change the CSS path/name. Keep exactly as your working index uses -->
    <link rel="stylesheet" href="main.css" />
</head>
<body>

<?php include __DIR__ . '/../header.php'; ?>

<div class="content-wrapper">
