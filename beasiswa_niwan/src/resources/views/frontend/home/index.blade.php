<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Mahasiswa</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

    <h1>Data Akademik Beasiswa Universitas Indonesia</h1>

    <table>
        <thead>
            <tr>
                <th>Nama</th>
                <th>Program Studi</th>
                <th>Fakultas</th>
                <th>Tahun Masuk</th>
                <th>Tahun Lulus</th>
                <th>IPK</th>
            </tr>
        </thead>
        <tbody>
            @foreach($beasiswas as $beasiswa)
            <tr>
                <td>{{$beasiswa->name}}</td>
                <td>{{$beasiswa->nim}}</td>
                <td>{{$beasiswa->jurusan}}</td>
                <td>{{$beasiswa->fakultas}}</td>
                <td>{{$beasiswa->indeks}}</td>
                <td>{{$beasiswa->beasiswa}}</td>
            </tr>
            @endforeach
            <!-- Tambahkan baris lainnya di sini -->
        </tbody>
    </table>

</body>
</html>
