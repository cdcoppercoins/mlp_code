<?php
$pageTitle = 'Contribute | MiniLicensePlates.com';

$to = 'cdcoppercoins@gmail.com';
$sent = false;
$error = '';

function clean_line($s) {
    $s = trim($s);
    return str_replace(["\r", "\n"], ' ', $s);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // honeypot
    $hp = trim($_POST['company'] ?? '');
    if ($hp !== '') {
        $sent = true; // pretend success for bots
    } else {
        $name  = clean_line($_POST['name'] ?? '');
        $email = clean_line($_POST['email'] ?? '');
        $msg   = trim($_POST['message'] ?? '');

        if ($name === '' || $email === '' || $msg === '') {
            $error = 'Please fill in your name, email, and message.';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = 'Please enter a valid email address.';
        } else {
            $subject = 'MiniLicensePlates.com Contribution';
            $body =
                "Name: {$name}\n" .
                "Email: {$email}\n\n" .
                "Message:\n{$msg}\n\n" .
                "IP: " . ($_SERVER['REMOTE_ADDR'] ?? 'unknown') . "\n";

            $headers = [];
            $headers[] = "Reply-To: {$name} <{$email}>";
            $headers[] = "Content-Type: text/plain; charset=UTF-8";

            $ok = @mail($to, $subject, $body, implode("\r\n", $headers));
            if ($ok) $sent = true;
            else $error = 'Mail failed on this server. Please email cdcoppercoins@gmail.com directly.';
        }
    }
}

include __DIR__ . '/inc/page_top.php';
?>

<div class="set-width">
    <h1>Contribute</h1>

    <p>
        Have an unlisted plate, a variety, better images, or historical information?
        Send the details below, or email <a href="mailto:cdcoppercoins@gmail.com">cdcoppercoins@gmail.com</a>.
    </p>

    <?php if ($sent): ?>
        <p><strong>Thank you!</strong> Your message has been sent.</p>
    <?php else: ?>
        <?php if ($error): ?>
            <p><strong><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></strong></p>
        <?php endif; ?>

        <form method="post" action="contribute_test.php">
            <p>
                <label>Your name<br>
                    <input name="name" style="width:100%; padding:10px;" required>
                </label>
            </p>
            <p>
                <label>Your email<br>
                    <input type="email" name="email" style="width:100%; padding:10px;" required>
                </label>
            </p>
            <p>
                <label>Message<br>
                    <textarea name="message" rows="10" style="width:100%; padding:10px;" required></textarea>
                </label>
            </p>

            <!-- honeypot (bots fill this, humans don't) -->
            <div style="position:absolute; left:-9999px;">
                <label>Company <input name="company" tabindex="-1" autocomplete="off"></label>
            </div>

            <p><button type="submit" style="padding:12px 18px;">Send</button></p>
        </form>

        <p>
            Postal address:<br>
            Minilicenseplates<br>
            PO Box 2364<br>
            Smithfield, NC 27577
        </p>
    <?php endif; ?>
</div>

<?php include __DIR__ . '/inc/page_bottom.php'; ?>
