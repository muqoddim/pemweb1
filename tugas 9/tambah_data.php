<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Siswa</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: #1e1e2f;
            color: #fff;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .form-container {
            background: #2a2a3e;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.5);
            width: 100%;
            max-width: 400px;
        }
        h1 {
            text-align: center;
            font-size: 24px;
            margin-bottom: 20px;
            color: #00d4ff;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #a8a8b8;
        }
        input, select, button {
            width: 100%;
            padding: 12px;
            font-size: 14px;
            border: none;
            border-radius: 6px;
        }
        input, select {
            background: #1e1e2f;
            color: #fff;
            border: 1px solid #444;
        }
        input:focus, select:focus {
            border-color: #00d4ff;
            outline: none;
        }
        button {
            background: #00d4ff;
            color: #1e1e2f;
            font-weight: bold;
            cursor: pointer;
        }
        button:hover {
            background: #00b4e0;
        }
        .result {
            margin-top: 20px;
            background: #34344a;
            padding: 15px;
            border-radius: 6px;
            color: #fff;
            border: 1px solid #444;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h1>Tambah Data Siswa</h1>
        <form action="" method="post">
            <div class="form-group">
                <label for="idSiswa">ID Siswa</label>
                <input type="text" id="idSiswa" name="idSiswa" required>
            </div>
            <div class="form-group">
                <label for="namaSiswa">Nama Siswa</label>
                <input type="text" id="namaSiswa" name="namaSiswa" required>
            </div>
            <div class="form-group">
                <label for="jenisKelamin">Jenis Kelamin</label>
                <select id="jenisKelamin" name="jenisKelamin" required>
                    <option value="Laki-laki">Laki-laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>
            </div>
            <div class="form-group">
                <label for="asalSekolah">Asal Sekolah</label>
                <input type="text" id="asalSekolah" name="asalSekolah" required>
            </div>
            <button type="submit" name="submit">Tambah</button>
        </form>

        <?php
        if (isset($_POST['submit'])) {
            $idSiswa = htmlspecialchars($_POST['idSiswa']);
            $namaSiswa = htmlspecialchars($_POST['namaSiswa']);
            $jenisKelamin = htmlspecialchars($_POST['jenisKelamin']);
            $asalSekolah = htmlspecialchars($_POST['asalSekolah']);

            echo '<div class="result">';
            echo '<p><strong>ID Siswa:</strong> ' . $idSiswa . '</p>';
            echo '<p><strong>Nama Siswa:</strong> ' . $namaSiswa . '</p>';
            echo '<p><strong>Jenis Kelamin:</strong> ' . $jenisKelamin . '</p>';
            echo '<p><strong>Asal Sekolah:</strong> ' . $asalSekolah . '</p>';
            echo '</div>';
        }
        ?>
    </div>
</body>
</html>