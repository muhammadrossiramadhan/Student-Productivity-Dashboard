<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Tugas</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f7fb;
            padding: 40px;
        }

        .form-box {
            background: white;
            padding: 25px;
            width: 400px;
            margin: auto;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.05);
        }

        input, textarea, button {
            width: 100%;
            margin-top: 10px;
            padding: 10px;
            border-radius: 8px;
        }

        button {
            background: #10b981;
            color: white;
            border: none;
        }
    </style>
</head>
<body>

<div class="form-box">
    <h2>Tambah Tugas</h2>
    <form>
        <input type="text" placeholder="Nama tugas">
        <input type="date">
        <textarea placeholder="Deskripsi tugas"></textarea>
        <button type="submit">Simpan</button>
    </form>
</div>

</body>
</html>