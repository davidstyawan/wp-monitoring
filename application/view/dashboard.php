<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title; ?></title>

    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/style.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/lib/font-awesome/css/font-awesome.min.css">
</head>

<body>
    <div class="wrapper collapse">
        <!-- navbar -->
        <?php $this->load->view("admin/navbar.php") ?>
        <!-- isi index php -->
        <div class="main-container">
            <div class="header-container">
                DASHBOARD
            </div>
            <?php
            $tanggal = date('Y-m-d');

            $token_id = $user['token'];

            $this->load->database();
            $query = $this->db->query("SELECT SUM(nilai) as count, tgl1 FROM datatabel2 AS u INNER JOIN absen2 AS i ON u.tgl = i.tgl INNER JOIN kendaraan AS a ON i.kendaraan = a.kendaraan INNER JOIN data_id AS d ON d.token1 = a.token WHERE token1 = '" . $token_id . "' AND tgl1 = '" . $tanggal . "' GROUP BY DAY (waktu) ORDER BY waktu");

            $click = json_encode(array_column($query->result(), 'count'), JSON_NUMERIC_CHECK);
            ?>

            <div class="row">

                <div class="card">
                    <i class="fa fa-bar-chart fa-5x"></i>
                    <h5>Total Mengantuk</h5>
                    <h5>Hari ini</h5>
                    <p> <?php echo $click; ?></p>
                </div>
            </div>
            <!-- isi index php -->
        </div>
    </div>

</body>

</html>