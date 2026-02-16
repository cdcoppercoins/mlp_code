<?php
// contribute.php

$to = 'cdcoppercoins@gmail.com';
$subject = 'MiniLicensePlates.com Contribution';
$sent = false;
$error = '';

function clean($s) {
    $s = trim($s);
    $s = str_replace(["\r", "\n"], ' ', $s); // prevent header injection
    return $s;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Honeypot anti-spam: real users won't fill this
    $company = isset($_POST['company']) ? trim($_POST['company']) : '';
    if ($company !== '') {
        // Pretend success, but do nothing
        $sent = true;
    } else {

        $name  = clean($_POST['name']  ?? '');
        $email = clean($_POST['email'] ?? '');
        $topic = clean($_POST['topic'] ?? '');
        $msg   = trim($_POST['message'] ?? '');

        if ($name === '' || $email === '' || $msg === '') {
            $error = 'Please fill in your name, email, and message.';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = 'Please enter a valid email address.';
        } else {

            $body = "New contribution from MiniLicensePlates.com\n\n"
                        . "Name: {$name}\n"
                        . "Email: {$email}\n"
                        . "Topic: {$topic}\n\n"
                        . "Message:\n{$msg}\n\n"
                        . "IP: " . ($_SERVER['REMOTE_ADDR'] ?? 'unknown') . "\n"
                        . "User Agent: " . ($_SERVER['HTTP_USER_AGENT'] ?? 'unknown') . "\n";

            $headers = [];
            $headers[] = "From: MiniLicensePlates.com <no-reply@{$_SERVER['HTTP_HOST']}>";
            $headers[] = "Reply-To: {$name} <{$email}>";
            $headers[] = "Content-Type: text/plain; charset=UTF-8";

            // mail() depends on your server being configured to send email.
            $ok = @mail($to, $subject, $body, implode("\r\n", $headers));

            if ($ok) $sent = true;
            else $error = 'Sorry — your message could not be sent right now. Please email cdcoppercoins@gmail.com directly.';
        }
    }
}
?><!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Contribute | MiniLicensePlates.com</title>
    <link rel="stylesheet" href="main.css">
</head>
<body>

<?php include __DIR__ . '/header.php'; ?>

<main style="max-width: 900px; margin: 0 auto; padding: 16px;">
    <h1>Contribute</h1>

    <p>
        Have an unlisted plate, a variant, better images, or historical information? Send details below.
        You can also email <a href="mailto:cdcoppercoins@gmail.com">cdcoppercoins@gmail.com</a>.
    </p>

    <?php if ($sent): ?>
        <p style="padding:12px; border:1px solid #ccc;">
            <strong>Thank you!</strong> Your message has been sent.
        </p>
    <?php else: ?>
        <?php if ($error !== ''): ?>
            <p style="padding:12px; border:1px solid #cc0000;">
                <strong>Error:</strong> <?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?>
            </p>
        <?php endif; ?>

        <form method="post" action="contribute.php" style="display:block; max-width: 700px;">
            <p>
                <label>Your name<br>
                    <input type="text" name="name" style="width:100%;" required>
                </label>
            </p>

            <p>
                <label>Your email<br>
                    <input type="email" name="email" style="width:100%;" required>
                </label>
            </p>

            <p>
                <label>Topic (optional)<br>
                    <input type="text" name="topic" style="width:100%;" placeholder="Set/year, brand, state, etc.">
                </label>
            </p>

            <p>
                <label>Message<br>
                    <textarea name="message" rows="10" style="width:100%;" required
                        placeholder="Tell me what you have, what makes it different, and any details you know. If you have photos, mention that and how you'd like to send them."></textarea>
                </label>
            </p>

            <!-- Honeypot field (hidden) -->
            <div style="position:absolute; left:-9999px; top:auto; width:1px; height:1px; overflow:hidden;">
                <label>Company <input type="text" name="company" tabindex="-1" autocomplete="off"></label>
            </div>

            <p>
                <button type="submit">Send</button>
            </p>
        </form>
    <?php endif; ?>

    <p>
        Prefer mail? <br>
        Minilicenseplates, PO Box 2364, Smithfield, NC 27577
    </p>
</main>

<?php include __DIR__ . '/footer.php'; ?>

</body>
</html>
