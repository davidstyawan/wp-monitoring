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
                DATA TABEL MENGANTUK
            </div>
            <div class="row">
                <!-- <div> <br>
                    <form method="get">
                        <span> Pilih Tanggal</span>
                        <input type="date" name="tanggal">
                        <input type="date" name="tanggal1">
                        <input type="submit" class="btn-filter" value="FILTER">
                    </form>

                </div> -->


                <div class="big-card">
                    <br>
                    <!-- <form action="<?= base_url('admin/export_excel') ?>" method="post" required>
                        <input type="hidden" type="date" name="tanggal">
                        <input type="hidden" type="date" name="tanggal1">
                        <input type="hidden" name="token" value="<?= $user['token'] ?>">
                        <button type='submit' class="btn-baru">Export Excel</button>
                    </form> -->
                    <h4>Daftar Terdeksi Mengantuk
                        <?php
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
                        ?></h4> <br>
                    <div class="table-round" style="overflow-x:auto;">

                        <table>
                            <tr>
                                <th>Nomor</th>
                                <th>Nama</th>
                                <th>Role</th>
                                <th>Jenis Kendaraan</th>
                                <th>Waktu Terdeteksi</th>
                                <th>Gambar</th>

                            </tr>
                            <?php
                            $no = 1;
                            if (isset($_GET['tanggal'])) {
                                $tgl = $_GET['tanggal'];
                                $tgl1 = $_GET['tanggal1'];
                                $this->db->select('*');
                                $this->db->from('absen2');
                                $this->db->join('datatabel2', 'datatabel2.tgl=absen2.tgl');
                                $this->db->join('kendaraan', 'kendaraan.kendaraan=absen2.kendaraan');
                                $this->db->join('data_id', 'data_id.token1=kendaraan.token');
                                // $this->db->join('user', 'user.token=kendaraan.token');

                                $this->db->where('token1', $user['token']);
                                $this->db->where("tgl1 BETWEEN '$tgl' AND '$tgl1'");
                                $sql = $this->db->get();

                                // // return $sql->result();

                                foreach ($sql->result_array() as $u) {

                                    // foreach($data = mysqli_fetch_assoc($sql)) {
                            ?>
                                    <tr>
                                        <td><?php echo $no++; ?></td>
                                        <td><?php echo $u['nama'] ?></>
                                        <td><?php echo $u['role'] ?></td>
                                        <td><?php echo $u['kendaraan'] ?></td>
                                        <td><?php echo $u['waktu'] ?></td>
                                        <td><?php echo '<img src="data:image/jpg;base64,' . $u['gambar'] . '"/>'; ?></td>
                                    </tr>
                            <?php

                                }
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

</body>

</html>