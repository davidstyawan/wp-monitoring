<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Tabel Dua</title>

    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/style.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/lib/font-awesome/css/font-awesome.min.css">
</head>

<body>
    <div class="wrapper collapse">
        <?php $this->load->view("admin/navbar.php") ?>
        <div class="main-container">
            <div class="header-container">
                DATA GRAFIK
            </div>
            <div class="row">
                <div> <br>
                    <!-- <form method="get">
                        <span> Pilih Tanggal</span>
                        <input type="date" name="tanggal">
                        <input type="date" name="tanggal1">
                        <input type="submit" class="btn-filter" value="FILTER">
                    </form> -->

                </div>

                <div class="big-card">
                    <?php
                    if (isset($_GET['tanggal']) and ($_GET['tanggal1'])) {
                        $tgl_awal = $_GET['tanggal'];
                        $tgl_akhir = $_GET['tanggal1'];

                        $token_id = $user['token'];

                        $this->load->database();
                        $query = $this->db->query("SELECT SUM(nilai) as count, tgl1 FROM datatabel2 AS u INNER JOIN absen2 AS i ON u.tgl = i.tgl 
                    INNER JOIN kendaraan AS a ON i.kendaraan = a.kendaraan 
                    INNER JOIN data_id AS d ON d.token1 = a.token WHERE token1 = '" . $token_id . "' AND (tgl1 BETWEEN '" . $tgl_awal . "' AND '" . $tgl_akhir . "')
                    GROUP BY DAY (waktu) ORDER BY waktu");

                        $click = json_encode(array_column($query->result(), 'count'), JSON_NUMERIC_CHECK);
                        $tgl = json_encode(array_column($query->result(), 'tgl1'), JSON_NUMERIC_CHECK);

                    ?>
                        <script type="text/javascript">
                            $(function() {

                                var data_click = <?php echo $click; ?>;

                                $('#container').highcharts({
                                    chart: {
                                        type: 'line'
                                    },

                                    xAxis: {
                                        type: 'date',
                                        categories: <?php echo $tgl; ?>
                                    },


                                    yAxis: {
                                        title: {
                                            text: 'Terdeteksi'
                                        }
                                    },
                                    series: [{
                                        name: 'Banyak Terdeteksi',
                                        data: data_click
                                    }]
                                });
                            });
                        </script>
                    <?php


                    } else {
                        unset($_GET['tanggal']);
                    }
                    ?>
                    <div>
                        <br />
                        <div class="panel-heading"><?php
                                                    $no = 1;
                                                    if (isset($_GET['tanggal'])) {
                                                        $tgl = $_GET['tanggal'];
                                                        $tgl1 = $_GET['tanggal1'];
                                                    ?>
                                Data Terdeteksi Dari <?php echo $tgl ?> Sampai <?php echo $tgl1 ?>
                            <?php

                                                    } else {
                                                        unset($_GET['tanggal']);
                                                    }
                            ?>
                        </div>

                        <div id="container"></div>



                    </div>

                </div>
            </div>
        </div>
        <!-- isi pengguna php -->
    </div>

</body>

</html>
<!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.js"></script> -->
<script src="<?= base_url(); ?>assets/grafik/chart.js"></script>