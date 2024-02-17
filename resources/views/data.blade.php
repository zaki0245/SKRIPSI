<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Saham</title>
    <!-- Memuat CSS Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* CSS tambahan untuk mengatur tampilan */
        .sidebar {
            height: 100%;
            width: 250px;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #f8f9fa;
            padding-top: 50px; /* Untuk memberikan ruang bagi judul menu */
        }
        .content {
            margin-left: 250px; /* Lebar sidebar */
            padding: 20px;
        }
    </style>
</head>
<body>
    <!-- Bagian sidebar -->
<div class="sidebar">
    <h2>Fitur</h2>
    <ul class="nav flex-column">
        <!-- Tombol Data -->
        <li class="nav-item">
            <a class="nav-link" href="{{ route('data.index') }}">Data</a>
        </li>
        <!-- Tombol Perhitungan -->
        <li class="nav-item">
            <a class="nav-link" href="{{ route('perhitungan') }}">Perhitungan</a>
        </li>
        <!-- Tombol Evaluasi -->
        <li class="nav-item">
            <a class="nav-link" href="{{ route('evaluasi') }}">Evaluasi</a>
        </li>
    </ul>
</div>


    <!-- Bagian konten -->
    <div class="content">
        <h1>Data Aktual</h1>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Saham</th>
                    @foreach ($kriterias as $kriteria)
                        <th>{{ $kriteria->indikator }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach ($sahams as $saham)
                    <tr>
                        <td>{{ $saham->saham }}</td>
                        @foreach ($kriterias as $kriteria)
                            <td>
                                @php
                                    $evaluasi = $saham->evaluasi->where('id_kriteria', $kriteria->id)->first();
                                @endphp
                                @if ($evaluasi)
                                    {{ $evaluasi->nilai }}
                                @else
                                    Tidak tersedia
                                @endif
                            </td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
