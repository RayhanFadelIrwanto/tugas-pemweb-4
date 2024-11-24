<?php
session_start();
if (!isset($_SESSION['data'])) {
    header('Location: form.php');
    exit();
}
$data = $_SESSION['data'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Hasil Pendaftaran</title>
</head>
<body>
    <h1>Hasil Pendaftaran</h1>
    <table border="1">
        <tr><th>Nama Lengkap</th><td><?= $data['name'] ?></td></tr>
        <tr><th>Email</th><td><?= $data['email'] ?></td></tr>
        <tr><th>Nomor Telepon</th><td><?= $data['phone'] ?></td></tr>
        <tr><th>Alamat</th><td><?= $data['address'] ?></td></tr>
        <tr><th>Browser</th><td><?= $data['browserInfo'] ?></td></tr>
    </table>

    <h2>Isi File:</h2>
    <table border="1">
        <tr><th>Baris</th><th>Isi</th></tr>
        <?php foreach ($data['fileLines'] as $index => $line): ?>
            <tr><td><?= $index + 1 ?></td><td><?= htmlspecialchars($line) ?></td></tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
