<!DOCTYPE html>
<html>
<head>
    <title>Laporan Nilai</title>
    <style>
        /* Tambahkan style untuk PDF sesuai kebutuhan */
        body { font-family: Arial, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h2>Laporan Nilai</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Siswa</th>
                <th>Materi</th>
                <th>Latihan Soal</th>
                <th>Nilai</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($reportData as $data)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $data->siswa->namaLengkap ?? '-' }}</td>
                    <td>{{ $data->latihansoal->judulMateri ?? '-' }}</td>
                    <td>{{ $data->latihansoal->judulLatsol ?? '-' }}</td>
                    <td>{{ number_format($data->nilai, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
