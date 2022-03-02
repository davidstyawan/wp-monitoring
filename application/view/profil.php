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
                PROFIL
            </div>
            <div class="row">
                <div class="big-card">
                    <div class="centered-wrapper">
                        <h4>Form Edit Profil</h4>
                        <?php echo $this->session->flashdata('msg') ?>
                        <?php echo form_open_multipart('admin/ubah_profil'); ?>
                        <input type="hidden" id="id" name="id" placeholder="id" value="<?= $user['id']; ?>" required><br>
                        <input type="text" id="email" name="email" placeholder="E-mail" required value="<?= $user['email']; ?>" readonly><br>
                        <input type="text" id="name" name="name" placeholder="Nama" value="<?= $user['name']; ?>" required><br>
                        <label for="image"></label>
                        <input type="file" id="image" name="image">
                        <input type='submit' class="btn btn-submit" value="Submit"></input>
                        <button type="button" class="btn btn-cancel" onclick="window.location.href='<?= base_url(); ?>admin/index'">Cancel</button>
                        <?php echo form_close() ?>

                    </div>
                </div>
            </div>
            <!-- isi form pengguna php -->
        </div>
</body>

</html>