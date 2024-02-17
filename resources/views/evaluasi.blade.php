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
        <h1>Perangkingan</h1>
        @php
    // Array untuk menyimpan total nilai setiap saham
    $totalNilaiPerSaham = [];

    // Menghitung total nilai untuk setiap saham
    foreach ($sahams as $saham) {
        $totalNilai = 0;
        foreach ($kriterias as $kriteria) {
            $evaluasi = $saham->evaluasi->where('id_kriteria', $kriteria->id)->first();
            if ($evaluasi) {
                $nilai = $evaluasi->nilai;
                // Logika untuk menentukan bobot berdasarkan nilai evaluasi
                switch ($kriteria->id) {
                    case 2:
                        if ($nilai <= 15) {
                            $nilai = 1.0;
                        } elseif ($nilai >= 15.01 && $nilai <= 20) {
                            $nilai = 2.0;
                        } elseif ($nilai >= 21) {
                            $nilai = 3.0;
                        }
                        break;
                    case 3:
                        if ($nilai <= 500) {
                            $nilai = 1.0;
                        } elseif ($nilai >= 501 && $nilai <= 1000) {
                            $nilai = 2.0;
                        } elseif ($nilai >= 1001) {
                            $nilai = 3.0;
                        }
                        break;
                    case 4:
                        if ($nilai <= 1) {
                            $nilai = 1.0;
                        } elseif ($nilai >= 1.01 && $nilai <= 2) {
                            $nilai = 2.0;
                        } elseif ($nilai >= 2.01) {
                            $nilai = 3.0;
                        }
                        break;
                    case 5:
                        if ($nilai <= 10) {
                            $nilai = 1.0;
                        } elseif ($nilai >= 11 && $nilai <= 30) {
                            $nilai = 2.0;
                        } elseif ($nilai >= 31) {
                            $nilai = 3.0;
                        }
                        break;
                }
                // Normalisasi nilai berdasarkan atribut kriteria
                if ($kriteria->atribut == 'Benefit') {
                    $nilai = (double)($nilai / 3); // Rumus normalisasi untuk atribut Benefit
                } elseif ($kriteria->atribut == 'Cost') {
                    $nilai = (double)(1 / $nilai); // Rumus normalisasi untuk atribut Cost
                }
                // Mengalikan nilai normalisasi dengan bobot
                $nilai *= $kriteria->bobot; // Mengalikan dengan bobot
                $totalNilai += $nilai;
            }
        }
        // Menambahkan total nilai ke dalam array
        $totalNilaiPerSaham[$saham->saham] = $totalNilai;
    }

    // Mengurutkan array total nilai secara descending
    arsort($totalNilaiPerSaham);

    // Inisialisasi variabel untuk nomor ranking
    $ranking = 1;
@endphp
<table class="table table-striped">
    <thead>
        <tr>
            <th>Ranking</th>
            <th>Saham</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($totalNilaiPerSaham as $saham => $totalNilai)
            <tr>
                <td>{{ $ranking++ }}</td>
                <td>{{ $saham }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
    </div>
</body>
</html>
