<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Tugas — Student.io</title>
    <link rel="stylesheet" href="/style.css">
</head>
<body class="auth-page">

<div class="auth-card" style="max-width:520px">
    <div class="auth-logo">✏️ Edit Tugas</div>

    <form method="POST" action="/index.php?url=task/update/<?= $task['id'] ?>">

        <div class="form-group">
            <label>Nama Tugas *</label>
            <input type="text" name="nama_tugas"
                   value="<?= htmlspecialchars($task['nama_tugas']) ?>"
                   required autofocus>
        </div>

        <div class="form-group">
            <label>Deskripsi</label>
            <textarea name="deskripsi" rows="4"><?= htmlspecialchars($task['deskripsi'] ?? '') ?></textarea>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label>Deadline</label>
                <input type="date" name="deadline"
                       value="<?= htmlspecialchars($task['deadline'] ?? '') ?>">
            </div>
            <div class="form-group">
                <label>Jam</label>
                <input type="time" name="waktu"
                       value="<?= htmlspecialchars(substr($task['waktu'] ?? '', 0, 5)) ?>">
            </div>
        </div>

        <div class="form-group">
            <label>Prioritas</label>
            <select name="prioritas">
                <?php foreach (['Tinggi', 'Sedang', 'Rendah'] as $p): ?>
                    <option value="<?= $p ?>"
                        <?= $task['prioritas'] === $p ? 'selected' : '' ?>>
                        <?= $p === 'Tinggi' ? '🔴' : ($p === 'Sedang' ? '🟡' : '🟢') ?>
                        <?= $p ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="modal-actions">
            <button type="submit" class="btn btn-primary">💾 Simpan Perubahan</button>
            <a href="/index.php?url=task/index" class="btn btn-ghost">← Batal</a>
        </div>

    </form>
</div>

</body>
</html>
