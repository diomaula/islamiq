<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    <style>
        h1 {
            text-align: center;
            font-family: 'Times New Roman', Times, serif;
            margin-bottom: 20px;
            margin-top: 20px;
            border-bottom: 2px solid #333333;
            padding-bottom: 5px;
            text-transform: uppercase;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            page-break-inside: auto; /* Membatasi tabel agar tidak terpecah */
        }

        tr, th, td {
            border: 1px solid #333;
            padding: 8px;
        }

        thead {
            display: table-header-group; /* Menjaga header tetap ada di setiap halaman */
        }

        tbody {
            display: table-row-group;
        }

        tr {
            page-break-inside: avoid; /* Mencegah baris terpotong */
        }

        .page-break {
            page-break-after: always; /* Memaksa halaman baru */
        }
    </style>
</head>

<body>
    <h1>{{ $title }}</h1>

    <table>
        <thead>
            <tr>
                <th style="width: 5%;">NO</th>
                <th>Nama</th>
                <th>Nomor Induk</th>
                <th>Jenis Kelamin</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{ $loop->iteration }}</td> <!-- Iterasi untuk nomor urut -->
                <td>{{ $user->namaLengkap }}</td>
                <td>{{ $user->ni }}</td>
                <td>{{ $user->jenisKelamin }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
