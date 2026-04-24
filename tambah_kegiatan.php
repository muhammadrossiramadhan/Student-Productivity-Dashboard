<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Kegiatan</title>
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
            border: 1px solid #ddd;
            border-radius: 8px;
            box-sizing: border-box;
        }

        button {
            background: #2563eb;
            color: white;
            border: none;
            font-weight: bold;
            cursor: pointer;
        }

        button:hover {
            background: #1d4ed8;
        }
    </style>
</head>
<body>

<div class="form-box">
    <h2>Tambah Kegiatan</h2>
    <form>
        <input type="text" placeholder="Nama kegiatan">
        <input type="date">
        <textarea placeholder="Deskripsi kegiatan"></textarea>
        <button type="submit">Simpan</button>
    </form>
</div>

</body>
</html>