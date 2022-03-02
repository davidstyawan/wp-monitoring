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
                PENGGUNA
            </div>
            <div class="row">
                <div class="big-card">
                    <h4>Daftar Pengguna</h4>
                    <!-- <button type="button" class="btn btn-add" onclick="window.location.href='pengguna_tambah.php'"> -->
                    <button type="button" class="btn btn-add" onclick="window.location.href='<?= base_url(); ?>admin/tambah_pengguna'"> <i class="fa fa-plus"></i></button>

                    <!-- <i class="fa fa-plus"></i> -->
                    <!-- </button> -->
                    <div class="table-round" style="overflow-x:auto;">

                        <table>
                            <tr>
                                <th>Action</th>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Role</th>
                            </tr>

                            <?php
                            $this->db->select('*');
                            $this->db->from('data_id');
                            $this->db->join('user', 'user.token=data_id.token1');
                            // $this->db->join('user', 'user.token=kendaraan.token');

                            $this->db->where('token1', $user['token']);
                            $sql = $this->db->get();
                            $no = 1;
                            foreach ($sql->result_array() as $u) :
                            ?>
                                <tr>
                                    <td>
                                        <button type="button" class="btn btn-smallred" onclick="window.location.href='#yakin'"><i class="fa fa-trash"></i></button>
                                        <button type="button" class="btn btn-smallblue" onclick="window.location.href='<?= base_url() ?>admin/formedit/<?= $u['id'] ?>'"><i class="fa fa-pencil"></i></button>
                                    </td>

                                    <!-- 

                                        <button type="button" class="btn btn-smallred" onclick="window.location.href='pengguna_delete.php'"><i class="fa fa-trash"></i></button> -->
                                    <td><?php echo $no++ ?></td>
                                    <td><?php echo $u['name'] ?></td>
                                    <td><?php echo $u['email'] ?></td>
                                    <td><?php echo $u['role_id'] ?></td>

                                </tr>
                            <?php endforeach; ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- isi pengguna php -->
    <div id="yakin" class="overlay">
        <div class="popup">
            <h4>Apakah anda yakin?</h4>
            <a class="close" href="#">
                <button type="button" class="btn btn-smallred" onclick="window.location.href='#'"><i class="fa fa-times"></i></button>
            </a>
            <button type="button" class="btn btn-smallred" onclick="window.location.href='<?= base_url() ?>admin/hapus/<?= $u['id'] ?>'"><i class="fa fa-trash"></i></button>
        </div>
    </div>
    <!-- isi order php -->

</body>

</html>