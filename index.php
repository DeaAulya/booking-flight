<?php

// Array Bandara Asal
$PilihBandaraAsal = [
  'Soekarno-Hatta (CGK)', 
  'Husein Sastranegara (BDO)', 
  'Abdul Rachman Saleh (MLG)', 
  'Juanda (SUB)'
];

// Array Bandara Tujuan
$PilihBandaraTujuan = [
  'Ngurah Rai (DPS)', 
  'Hasanuddin (UPG)', 
  'Inanwatan (INX)', 
  'Sultan Iskandar Muda (BTJ)'
];

// Fungsi untuk mengurutkan Array Bandara
function sortAirports($airports) {
  sort($airports);
  return $airports;
}

// Mengurutkan Array
$PilihBandaraAsal = sortAirports($PilihBandaraAsal);
$PilihBandaraTujuan = sortAirports($PilihBandaraTujuan);

//Harga Bandara asal
$pajak_asal = [
  'Soekarno-Hatta (CGK)' => 65000,
  'Husein Sastranegara (BDO)' => 50000,
  'Abdul Rachman Saleh (MLG)' => 40000,
  'Juanda (SUB)' => 30000
];

//Harga Bandara Tujuan
$pajak_tujuan = [
  'Ngurah Rai (DPS)' => 85000,
  'Hasanuddin (UPG)' => 70000,
  'Inanwatan (INX)' => 90000,
  'Sultan Iskandar Muda (BTJ)' => 60000
];

// check request
if ($_POST) {

  //Deklarasi variabel untuk setiap input
  $NamaMaskapai = $_POST['namaMaskapai'];
  $BandaraAsal = $_POST['bAsal'];
  $BandaraTujuan = $_POST['bTujuan'];
  $waktu_pesan = time();

  //Harga pajak untuk setiap penerbangan bandara
  $pajak_BandaraAsal = $pajak_asal[$BandaraAsal];
  $pajak_BandaraTujuan = $pajak_tujuan[$BandaraTujuan];

  // Total perhitungan
  $TotalPajak = $pajak_BandaraAsal + $pajak_BandaraTujuan;
  $harga_tiket = isset($_POST['harga_tiket']) ? ($_POST['harga_tiket'] != '' ? $_POST['harga_tiket'] : 0) : 0;
  $total_harga_tiket = $harga_tiket + $TotalPajak;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- link bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <title>Tiket Penerbangan</title>
  <style>
    body {
      background-image: url(bandara.png);
      background-size: cover;
    }
  </style>
</head>

<body>
  <div class="container">
    <header id="header" class="jumbotron">

    <div class="container py-5">
      <h1 class="text-center" style="color: white;">SkyTravel</h1>
      <h5 class="text-center fst-italic " style="color: white;">Pesawat Terbaik Untuk Perjalanan Terbaik</h5>

        <section id="tiket" class="tiket">
          
          <div class="row">
            <div class="col-md-6 mt-5">
              <div class="card opacity-75 h-100">
                <div class="card-body">
                  <form method="POST">
                  <h3 class="text-center" style="color: black;">Formulir Pemesanan</h3>

                    <!-- Pilih Maskapai -->
                        <div class="mb-3 text-start">
                          <label for="namaMaskapai" class="form-label">Nama Maskapai</label>
                          <input class="form-control" list="datalistOptions" id="namaMaskapai" 
                          placeholder="Masukkan Nama Maskapai" name="namaMaskapai" required>
                          <datalist id="datalistOptions">
                            <option value="Air Asia">
                            <option value="Batik Air">
                            <option value="Garuda Indonesia">
                            <option value="Lion Air">
                          </datalist>
                        </div>

                    <!-- Pilih Bandara Asal -->
                        <div class="mb-3 text-start">
                          <label for="bandaraAsal" class="form-label">Bandara Asal</label>
                            <select class="form-select" id="bAsal" name="bAsal" required>
                              <option value="" selected disabled>Pilih Bandara Asal</option>
                                  <?php foreach ($PilihBandaraAsal as $bandara) : ?>
                                      <option value="<?= $bandara; ?>">
                                          <?= $bandara; ?>
                                      </option>
                                  <?php endforeach; ?>
                              </select>
                          </div>

                    <!-- Pilih Bandara Tujuan -->
                        <div class="mb-3 text-start">
                            <label for="bandarTujuan" class="form-label">Bandara Tujuan</label>
                              <select class="form-select" id="bTujuan" name="bTujuan" required>
                                  <option value="" selected disabled>Pilih Bandara Tujuan</option>
                                  <?php foreach ($PilihBandaraTujuan as $bandara) : ?>
                                      <option value="<?= $bandara; ?>">
                                          <?= $bandara; ?>
                                      </option>
                                  <?php endforeach; ?>
                              </select>
                          </div>

                    <!-- Pilih Kelas Penerbangan -->
                        <div class="mb-3 text-start">
                          <label for="hargaTiket" class="form-label">Harga Tiket (Minimal 100000)</label>
                          <input type="text" class="form-control" id="hargaTiket" name="harga_tiket" pattern="[1-9]\d{5,}" 
                          title="Masukkan angka" placeholder="Masukkan Harga Tiket" required>
                        </div>

                        <button class="btn btn-primary w-100">Pesan</button>
                  </form>
                </div>
              </div> 
            </div>
            
            <!-- Bukti Pemesanan -->
            <div class="col-md-6 mt-5">
              <div class="card opacity-75 h-100">
                <div class="card-body">
                  <h3 class="text-center" style="color: black;">Bukti Pemesanan</h3>
                  <table class="table table-borderless table-hover my-5">
                    <tbody>
                        <tr>
                          <th scope="row">Nomor Pemesanan</th>
                          <td>:</td>
                          <td><?= isset($waktu_pesan) ? rand(1, 1000000) : '-'; ?></td>
                        </tr>
                        <tr>
                          <th scope="row">Tanggal Pemesanan</th>
                          <td>:</td>
                          <td><?= isset($waktu_pesan) ? date('d-m-Y', $waktu_pesan) : '-'; ?></td>
                        </tr>
                        <tr>
                          <th scope="row">Nama Maskapai</th>
                          <td>:</td>
                          <td><?= isset($NamaMaskapai) ? $NamaMaskapai : '-'; ?></td>
                        </tr>
                        <tr>
                          <th scope="row">Bandara Asal</th>
                          <td>:</td>
                          <td><?= isset($BandaraAsal) ? $BandaraAsal : '-'; ?></td>
                        </tr>
                        <tr>
                          <th scope="row">Bandara Tujuan</th>
                          <td>:</td>
                          <td><?= isset($BandaraTujuan) ? $BandaraTujuan : '-'; ?></td>
                        </tr>
                        <tr>
                          <th scope="row">Harga Tiket</th>
                          <td>:</td>
                          <td><?= isset($harga_tiket) ? 'Rp ' . number_format($harga_tiket) . ',-' : '-'; ?></td>
                        </tr>
                        <tr>
                          <th scope="row">Pajak</th>
                          <td>:</td>
                          <td><?= isset($TotalPajak) ? 'Rp ' . number_format($TotalPajak) . ',-' : '-'; ?></td>
                        </tr>
                        <tr class="table-primary">
                          <th scope="row">Total Harga Tiket</th>
                          <td>:</td>
                          <td><?= isset($total_harga_tiket) ? 'Rp ' . number_format($total_harga_tiket) . ',-' : '-'; ?></td>
                        </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
    </div>
</body>
</html>
