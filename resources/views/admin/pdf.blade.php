<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    <style>
        h1 {
            text-align: center;
            font-family:'Times New Roman', Times, serif;
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
        }

        tr,
        th {
            border: 1px solid #333;
            text-align: center;
        }

        tr,
        td {
            border: 1px solid #333;
            padding: 8px;
            text-align: left;
        }

        td:first-child {
            text-align: center;
        }
    </style>
</head>

<body>
    <h1>{{ $title }}</h1>

    <table>
        <table class="table table-bordered">
            <tr>
                <th style="width: 5%;">NO</th>
                <th>Nama</th>
                <th>Nomor Induk</th>
                <th>Tanggal Lahir</th>
                <th>Jenis Kelamin</th>
                @if(request()->get('showRole') == 'true')
                <th>Role</th>
                @endif
            </tr>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td>{!! $loop->iteration !!}</td>
                    <td>{{ $user->namaLengkap }}</td>
                    <td>{{ $user->ni }}</td>
                    <td>{{ \Carbon\Carbon::parse($user->tanggalLahir)->format('d-m-Y') }}</td>
                    <td>{{ $user->jenisKelamin }}</td>
                    @if(request()->get('showRole') == 'true')
                    <td>{{ $user->role }}</td>
                    @endif
                </tr>
                @endforeach
            </tbody>
        </table>
    </table>
</body>

</html>