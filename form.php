<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Form Pendaftaran Sekolah</title>
</head>
<body>
    <h1>Pendaftaran Sekolah</h1>
    <form id="registrationForm" action="process.php" method="POST" enctype="multipart/form-data">
        <label for="name">Nama Lengkap:</label>
        <input type="text" id="name" name="name" required minlength="3" maxlength="100">
        
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        
        <label for="phone">Nomor Telepon:</label>
        <input type="text" id="phone" name="phone" required pattern="\d+" maxlength="13">
        
        <label for="address">Alamat:</label>
        <textarea id="address" name="address" required minlength="10"></textarea>
        
        <label for="file">Unggah File Biodata (Teks):</label>
        <input type="file" id="file" name="file" required accept=".txt">
        
        <button type="submit">Daftar</button>
    </form>

    <script>
        // Validasi tambahan di JavaScript
        document.getElementById('registrationForm').addEventListener('submit', function (event) {
            const fileInput = document.getElementById('file');
            const file = fileInput.files[0];
            if (file.size > 1048576) { // 1MB
                alert('Ukuran file tidak boleh lebih dari 1MB.');
                event.preventDefault();
            }
        });
    </script>
</body>
</html>
