<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Rekomendasi Saham</title>
    <!-- Memuat CSS Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* CSS tambahan untuk mengatur tampilan */
        .sidebar {
            height: 100%;
            width: 250px;
            position: fixed;
            top: 0;
            left: -250px; /* Sembunyikan sidebar di sisi kiri */
            background-color: #007bff; /* Warna latar belakang sidebar */
            padding-top: 50px; /* Untuk memberikan ruang bagi judul menu */
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1); /* Efek bayangan pada sidebar */
            z-index: 1000; /* Atur z-index agar sidebar tampil di atas header */
            transition: left 0.3s; /* Animasi saat mengubah posisi sidebar */
        }
        .sidebar h2 {
            color: #fff; /* Warna teks judul sidebar */
            text-align: center; /* Posisi teks judul ke tengah */
            margin-bottom: 20px; /* Jarak antara judul dengan menu */
        }
        .nav-link {
            color: #fff; /* Warna teks menu */
            font-weight: bold; /* Ketebalan teks menu */
            transition: all 0.3s ease; /* Efek transisi saat hover */
        }
        .nav-link:hover {
            background-color: rgba(255, 255, 255, 0.2); /* Warna latar belakang saat hover */
            border-radius: 5px; /* Corner radius saat hover */
        }
        .content {
            margin-left: 0; /* Awalnya konten tidak bergeser */
            padding: 20px;
            margin-top: 100px; /* Tambahkan margin-top agar konten tidak tertutupi oleh header */
            padding-top: 20px; /* Tambahkan padding-top agar tulisan fitur tidak tertutupi */
            transition: margin-left 0.3s; /* Animasi saat mengubah margin kiri konten */
        }
        .header {
            text-align: center;
            padding: 20px 0;
            background-color: #007bff;
            color: #fff;
            width: 100%;
            z-index: 500; /* Atur z-index agar header tampil di bawah sidebar */
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.2);
            position: fixed; /* Atur posisi header agar tetap di bagian atas saat digulir */
            top: 0;
        }
        /* Style untuk tombol open sidebar */
        #openSidebar {
            position: fixed;
            top: 20px;
            left: 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 15px;
            cursor: pointer;
            z-index: 1500; /* Atur z-index agar tombol tampil di atas sidebar */
        }
    </style>
</head>
<body>
    <!-- Tombol open sidebar -->
    <button id="openSidebar">&#9776;</button>

    <!-- Bagian sidebar -->
    <div class="sidebar" id="sidebar">
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

    <!-- Header -->
    <div class="header">
        <h1>Sistem Rekomendasi Saham</h1>
    </div>
    <!-- Bagian konten -->
    <div class="content">
        <h1>Data Awal</h1>
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
    </br>
    <h1>Bobot Nilai</h1>
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
                            if ($evaluasi) {
                                switch ($kriteria->id) {
                                    case 2:
                                        if ($evaluasi->nilai <= 15) {
                                            echo 1;
                                        } elseif ($evaluasi->nilai >= 15 && $evaluasi->nilai <= 20) {
                                            echo 2;
                                        } elseif ($evaluasi->nilai >= 21) {
                                            echo 3;
                                        }
                                        break;
                                    case 3:
                                        if ($evaluasi->nilai <= 500) {
                                            echo 1;
                                        } elseif ($evaluasi->nilai >= 501 && $evaluasi->nilai <= 1000) {
                                            echo 2;
                                        } elseif ($evaluasi->nilai >= 1001) {
                                            echo 3;
                                        }
                                        break;
                                    case 4:
                                        if ($evaluasi->nilai <= 1) {
                                            echo 1;
                                        } elseif ($evaluasi->nilai >= 1. && $evaluasi->nilai <= 2) {
                                            echo 2;
                                        } elseif ($evaluasi->nilai >= 2.01) {
                                            echo 3;
                                        }
                                        break;
                                    case 5:
                                        if ($evaluasi->nilai <= 10) {
                                            echo 1;
                                        } elseif ($evaluasi->nilai >= 11 && $evaluasi->nilai <= 30) {
                                            echo 2;
                                        } elseif ($evaluasi->nilai >= 31) {
                                            echo 3;
                                        }
                                        break;
                                    default:
                                        echo "Tidak tersedia";
                                }
                            } else {
                                echo "Tidak tersedia";
                            }
                        @endphp
                    </td>
                @endforeach
            </tr>
        @endforeach
    </tbody>
</table>
</br>
    <h1>Normalisasi</h1>
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
                                    default:
                                        $nilai = "Tidak tersedia";
                                }
                                // Normalisasi nilai berdasarkan atribut kriteria
                                if ($kriteria->atribut == 'Benefit') {
                                    $nilai = (double)($nilai / 3); // Rumus normalisasi untuk atribut Benefit
                                } elseif ($kriteria->atribut == 'Cost') {
                                    $nilai = (double)(1 / $nilai); // Rumus normalisasi untuk atribut Cost
                                }
                                echo $nilai;
                            } else {
                                echo "Tidak tersedia";
                            }
                        @endphp
                    </td>
                @endforeach
            </tr>
        @endforeach
    </tbody>
</table>
                        </br>
                        <h1>Pengkalian</h1>
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
                                    default:
                                        $nilai = "Tidak tersedia";
                                }
                                // Normalisasi nilai berdasarkan atribut kriteria
                                if ($kriteria->atribut == 'Benefit') {
                                    $nilai = (double)($nilai / 3); // Rumus normalisasi untuk atribut Benefit
                                } elseif ($kriteria->atribut == 'Cost') {
                                    $nilai = (double)(1 / $nilai); // Rumus normalisasi untuk atribut Cost
                                }
                                // Mengalikan nilai normalisasi dengan bobot
                                $nilai *= $kriteria->bobot; // Mengalikan dengan bobot
                                echo $nilai;
                            } else {
                                echo "Tidak tersedia";
                            }
                        @endphp
                    </td>
                @endforeach
            </tr>
        @endforeach
    </tbody>
</table>
                        </br>
                        <h1>Penambahan</h1>
                        <table class="table table-striped">
    <thead>
        <tr>
            <th>Saham</th>
            <th>Nilai</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($sahams as $saham)
            <tr>
                <td>{{ $saham->saham }}</td>
                <td>
                    @php
                        $totalNilai = 0;
                    @endphp
                    @foreach ($kriterias as $kriteria)
                        @php
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
                                    default:
                                        $nilai = "Tidak tersedia";
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
                        @endphp
                    @endforeach
                    {{ number_format($totalNilai, 3, ',', '.') }}
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
</div>
<!-- Memuat JavaScript untuk mengatur perilaku sidebar -->
<script>
        const openSidebarBtn = document.getElementById('openSidebar');
        const sidebar = document.getElementById('sidebar');
        const content = document.querySelector('.content');

        openSidebarBtn.addEventListener('click', () => {
            if (sidebar.style.left === '0px') {
                sidebar.style.left = '-250px'; // Tutup sidebar
                content.style.marginLeft = '0'; // Geser konten ke kiri
            } else {
                sidebar.style.left = '0'; // Buka sidebar
                content.style.marginLeft = '250px'; // Geser konten ke kanan
            }
        });
    </script>
</body>
</html>
