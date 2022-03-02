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

        <!-- isi form pengguna php -->
        <div class="main-container">
            <div class="header-container">
                EDIT KENDARAAN
            </div>
            <div class="row">
                <div class="big-card">
                    <div class="centered-wrapper">
                        <h4>Form Pengguna</h4>

                        <form action="<?= base_url('admin/ubahdata_kamera') ?>" method="post" required>
                            <input type="hidden" name="id_kendaraan" value="<?= $kamera['id_kendaraan'] ?>">
                            <!-- <input type="hidden" name="id" value="<?= $user['data_id'] ?>"> -->
                            <div class="form-group">
                                <input type="text" name="kamera" class="form-control" value="<?= $kamera['kamera'] ?>" id="kamera" placeholder="Nomor Series Kamera" required>
                                <input type="text" name="kendaraan" class="form-control" value="<?= $kamera['kendaraan'] ?>" id="kendaraan" placeholder="Nomor Series Kamera" required>
                            </div>

                            <button type='submit' class="btn btn-submit">Submit</button>
                            <button type="button" class="btn btn-cancel" onclick="window.location.href='<?= base_url(); ?>admin/pengaturan_mobil'">Cancel</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- isi form pengguna php -->
    </div>
</body>

</html>