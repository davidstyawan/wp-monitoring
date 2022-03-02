<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detv</title>

    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/style.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/lib/font-awesome/css/font-awesome.min.css">
</head>

<body>
    <div class="wrapper collapse">
        <!-- navbar -->
        <?php $this->load->view("admin/navbar.php") ?>

        <!-- isi pengguna php -->
        <div class="main-container">
            <div class="header-container">
                DATA KEHADIRAN
            </div>
            <div class="row">
                <div> <br>
                    <form method="get">
                        <span> Pilih Tanggal</span>
                        <input type="date" name="tanggal">
                        <input type="date" name="tanggal1">
                        <input type="submit" class="btn-filter" value="FILTER">
                    </form>

                </div>
                <div class="big-card">
                    <h4>Daftar Kehadiran <?php
                                            $no = 1;
                                            if (isset($_GET['tanggal'])) {
                                                $tgl = $_GET['tanggal'];
                                                $tgl1 = $_GET['tanggal1'];
                                            ?>
                            <?php echo $tgl ?> Sampai <?php echo $tgl1 ?>
                        <?php

                                            } else {
                                                unset($_GET['tanggal']);
                                            }
                        ?></h4>

                    <div class="table-round" style="overflow-x:auto;">

                        <table>
                            <tr>
                                <th>Action</th>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Role</th>
                                <th>Tanggal Masuk</th>
                                <th>Waktu Masuk</th>
                                <th>Kendaraan</th>
                            </tr>

                            <?php

                            if (isset($_GET['tanggal']) and ($_GET['tanggal1'])) {
                                $tgl = $_GET['tanggal'];
                                $tgl1 = $_GET['tanggal1'];
                                $this->db->select('*');
                                $this->db->from('absen2');
                                $this->db->join('kendaraan', 'kendaraan.kendaraan=absen2.kendaraan');
                                $this->db->join('data_id', 'data_id.token1=kendaraan.token');

                                // $this->db->join('user', 'user.token=kendaraan.token');
                                $this->db->where("tgl1 BETWEEN '$tgl' AND '$tgl1'");
                                $this->db->where('token1', $user['token']);
                                $sql = $this->db->get();

                                $no = 1;

                                foreach ($sql->result_array() as $u) :
                            ?>
                                    <tr>
                                        <td>
                                            <button type="button" class="btn btn-smallred" onclick="window.location.href='#yakin-absen'"><i class="fa fa-trash"></i></button>
                                        <td><?php echo $no++ ?></td>
                                        <td><?php echo $u['nama'] ?></td>
                                        <td><?php echo $u['role'] ?></td>
                                        <td><?php echo $u['tgl'] ?></td>
                                        <td><?php echo $u['masuk'] ?></td>
                                        <td><?php echo $u['kendaraan'] ?></td>

                                    </tr>
                                <?php endforeach; ?>
                            <?php


                            } else {
                                unset($_GET['tanggal']);
                            }
                            ?>
                        </table>
                    </div>

                </div>
            </div>
        </div>
        <!-- isi pengguna php -->
    </div>
    <div id="yakin-absen" class="overlay">
        <div class="popup">
            <h4>Apakah anda yakin?</h4>
            <a class="close" href="#">
                <button type="button" class="btn btn-smallred" onclick="window.location.href='#'"><i class="fa fa-times"></i></button>
            </a>
            <button type="button" class="btn btn-smallred" onclick="window.location.href='<?= base_url() ?>admin/hapusabsen/<?= $u['id_absen'] ?>'"><i class="fa fa-trash"></i></button>
        </div>
    </div>

</body>