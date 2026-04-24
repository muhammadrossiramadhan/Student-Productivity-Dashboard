<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PRODUKTIVITAS PELAJAR DAN MAHASISWA</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background: #f4f7fb;
            color: #1e293b;
        }

        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 40px;
            background: white;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        }

        .navbar h2 {
            color: #2563eb;
        }

        .container {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            gap: 20px;
            padding: 30px;
        }

        .card {
            background: white;
            padding: 20px;
            border-radius: 16px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.05);
        }

        .profile {
            text-align: center;
        }

        .profile img {
            width: 80px;
            border-radius: 50%;
            margin-bottom: 10px;
        }

        .btn-group {
            margin-top: 15px;
            display: flex;
            gap: 10px;
            justify-content: center;
        }

        .btn {
            padding: 10px 15px;
            border: none;
            border-radius: 8px;
            color: white;
            cursor: pointer;
            font-weight: bold;
        }

        .green { background: #10b981; }
        .blue { background: #2563eb; }

        .calendar table {
            width: 100%;
            margin-top: 10px;
            text-align: center;
            border-collapse: collapse;
        }

        .calendar th, .calendar td {
            padding: 8px;
        }

        .progress-bar {
            margin-top: 15px;
            background: #e5e7eb;
            border-radius: 10px;
            overflow: hidden;
        }

        .progress {
            height: 15px;
            width: 75%;
            background: #2563eb;
        }

        .chart {
            margin-top: 15px;
            height: 150px;
            background: linear-gradient(to top, #bfdbfe, #ffffff);
            border-radius: 10px;
            display: flex;
            align-items: end;
            justify-content: space-around;
            padding: 10px;
        }

        .bar {
            width: 30px;
            background: #10b981;
            border-radius: 6px 6px 0 0;
        }

        ul {
            margin-top: 10px;
            padding-left: 20px;
        }

        li {
            margin-bottom: 8px;
        }
    </style>
</head>
<body>

    <div class="navbar">
        <h2>PRODUKTIVITAS PELAJAR DAN MAHASISWA</h2>
        <div>Selamat datang, ayo buat tugas dan kegiatamu menjadi menyenangkan</div>
    </div>

    <div class="container">

        <div class="card profile">
            <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png" alt="profil">
            <h3>Profil Saya</h3>
            <div class="btn-group">
                <button class="btn green">+ Tambah Tugas</button>
                <button class="btn blue">+ Tambah Kegiatan</button>
            </div>
        </div>

        <div class="card">
            <h3>Deadline Tugas</h3>
            <ul>
                <li>Tugas Matematika - 25 April</li>
                <li>Laporan IPA - 28 April</li>
                <li>Presentasi - 30 April</li>
            </ul>
        </div>

        <div class="card">
            <h3>Waktu Belajar</h3>
            <h1 style="margin-top:15px;">02:15:30</h1>
            <button class="btn blue" style="margin-top:15px;">Mulai Timer</button>
        </div>

        <div class="card calendar">
            <h3>Kalender</h3>
            <table>
                <tr>
                    <th>Min</th><th>Sen</th><th>Sel</th><th>Rab</th>
                    <th>Kam</th><th>Jum</th><th>Sab</th>
                </tr>
                <tr><td></td><td></td><td>1</td><td>2</td><td>3</td><td>4</td><td>5</td></tr>
                <tr><td>6</td><td>7</td><td>8</td><td>9</td><td>10</td><td>11</td><td>12</td></tr>
                <tr><td>13</td><td>14</td><td>15</td><td>16</td><td>17</td><td>18</td><td>19</td></tr>
            </table>
        </div>

        <div class="card">
            <h3>Progress Pencapaian</h3>
            <div class="progress-bar">
                <div class="progress"></div>
            </div>
            <p style="margin-top:10px;">75% selesai</p>
        </div>

        <div class="card">
            <h3>Grafik Pencapaian</h3>
            <div class="chart">
                <div class="bar" style="height:40%;"></div>
                <div class="bar" style="height:60%;"></div>
                <div class="bar" style="height:75%;"></div>
                <div class="bar" style="height:90%;"></div>
            </div>
        </div>

    </div>

</body>
</html>