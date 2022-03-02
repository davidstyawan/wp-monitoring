<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detv</title>

    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/style.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/lib/font-awesome/css/font-awesome.min.css">
</head>

<body>
    <div class="wrapper collapse">
        <?php $this->load->view("admin/navbar.php") ?>
        <div class="main-container">
            <div class="header-container">
                About
            </div>
            <div class="row">
                <div class="big-card">
                    <h4>DETV</h4> <br>

                    <H5>DETV merupakan sebuah alat yang dapat mendeteksi kantuk untuk kendaraan berat</H5>
                    <br><br>
                    <h5>Penggoprasian website DETV membutuhkan perlakuan khusus agar website DETV dapat berkerja secara baik.</h5>
                    <br>
                    <h5>1. Admin melakukan input data kendaraan pada halaman data kendaraan dengan mengeklik tombol tambah kendaraan. Informasi yang dibutuhkan adalah nama kendaraan dan series kamera yang digunakan.</h5><br>
                    <h5>2. Admin melakukan penambahan pengguna pada halaman pengguna. Pengguna yang dapat ditambahakan memiliki tiga role yaitu Admin, Mandor dan Supir.</h5><br>
                    <h5>3. Setiap supir harus melakukan presensi pada halaman presensi, dengan memilih kendaraan yang digunakan.</h5>
                </div>

            </div>
        </div>

    </div>

</body>

</html>