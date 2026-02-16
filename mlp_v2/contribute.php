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
    $hp = trim($_POST['company'] ?? '');
    if ($hp !== '') { $sent = true; } // spam bot
    else {
        $name  = clean_line($_POST['name'] ?? '');
        $email = clean_line($_POST['email'] ?? '');
        $msg   = trim($_POST['message'] ?? '');

        if ($name === '' || $email === '' || $msg === '') $error = 'Please fill in name, email, and message.';
        elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) $error = 'Please enter a valid email address.';
        else {
            $subject = 'MiniLicensePlates Contribution';
            $body = "Name: $name\nEmail: $email\n\n$msg\n";
            $headers = "Reply-To: $name <$email>\r\nContent-Type: text/plain; charset=UTF-8\r\n";
            $ok = @mail($to, $subject, $body, $headers);
            $sent = $ok;
            if (!$ok) $error = 'Mail failed on this server. Please email cdcoppercoins@gmail.com directly.';
        }
    }
}

include __DIR__ . '/site_top.php';
?>

<h1>Contribute</h1>

<p>If you have an unlisted plate, a variety, better images, or historical information, send it here.</p>

<?php if ($sent): ?>
    <p><strong>Thank you!</strong> Your message was sent.</p>
<?php else: ?>
    <?php if ($error): ?><p><strong><?php echo htmlspecialchars($error); ?></strong></p><?php endif; ?>

    <form method="post" action="/mlp_v2/contribute.php">
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

        <!-- honeypot -->
        <div style="position:absolute; left:-9999px;">
            <label>Company <input name="company" tabindex="-1" autocomplete="off"></label>
        </div>

        <p><button type="submit" style="padding:12px 18px;">Send</button></p>
    </form>

    <p>Or email <a href="mailto:cdcoppercoins@gmail.com">cdcoppercoins@gmail.com</a>.</p>
<?php endif; ?>

<?php include __DIR__ . '/site_bottom.php'; ?>
