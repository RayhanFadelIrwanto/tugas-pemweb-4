<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $phone = htmlspecialchars(trim($_POST['phone']));
    $address = htmlspecialchars(trim($_POST['address']));
    $file = $_FILES['file'];

    // Validasi inputan PHP
    if (empty($name) || empty($email) || empty($phone) || empty($address) || empty($file)) {
        die("Semua data harus diisi!");
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Email tidak valid!");
    }
    if (!preg_match('/^\d+$/', $phone)) {
        die("Nomor telepon hanya boleh angka!");
    }
    if ($file['size'] > 1048576 || pathinfo($file['name'], PATHINFO_EXTENSION) !== 'txt') {
        die("File harus berformat .txt dan ukurannya tidak lebih dari 1MB!");
    }

    // Simpan file
    $uploadDir = 'uploads/';
    $filePath = $uploadDir . basename($file['name']);
    move_uploaded_file($file['tmp_name'], $filePath);

    // Baca isi file
    $fileContent = file_get_contents($filePath);
    $fileLines = explode("\n", $fileContent);

    // Browser info
    $browserInfo = $_SERVER['HTTP_USER_AGENT'];

    // Simpan ke database
    $conn = new mysqli('localhost', 'root', '', 'pendaftaran');
    if ($conn->connect_error) {
        die("Koneksi database gagal: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("INSERT INTO siswa (name, email, phone, address, file_path) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param('sssss', $name, $email, $phone, $address, $filePath);
    $stmt->execute();
    $stmt->close();
    $conn->close();

    // Redirect ke hasil
    session_start();
    $_SESSION['data'] = compact('name', 'email', 'phone', 'address', 'fileLines', 'browserInfo');
    header('Location: result.php');
}
?>
