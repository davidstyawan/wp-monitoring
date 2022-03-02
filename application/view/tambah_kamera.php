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
                TAMBAH KENDARAAN
            </div>
            <div class="row">
                <div class="big-card">
                    <div class="centered-wrapper">
                        <h4>Form Kendaraan</h4>

                        <form action="<?= base_url('admin/prosestambah_kamera') ?>" method="post" required>
                            <input type="hidden" name="token" value="<?= $user['token'] ?>">
                            <input type="text" id="kamera" name="kamera" placeholder="Nomor Series Kamera" required><br>
                            <input type="text" id="kendaraan" name="kendaraan" placeholder="Nama Kendaraan" required>
                            <button type='submit' class="btn btn-submit">Submit</button>
                            <button type="button" class="btn btn-cancel" onclick="window.location.href='<?= base_url(); ?>admin/pengguna'">Cancel</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- isi form pengguna php -->
    </div>
</body>

</html>