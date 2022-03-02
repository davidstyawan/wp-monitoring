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
                TAMBAH PENGGUNA
            </div>
            <div class="row">
                <div class="big-card">
                    <div class="centered-wrapper">
                        <h4>Form Pengguna</h4>

                        <form action="<?= base_url('admin/prosestambah') ?>" method="post" required>
                            <input type="text" id="name" name="name" placeholder="Nama" required><br>
                            <input type="hidden" name="token" value="<?= $user['token'] ?>">

                            <input type="text" id="email" name="email" placeholder="E-mail" required value="<?= set_value('email'); ?>"><br>
                            <input type="text" id="password" name="password" placeholder="Password" required>


                            <select id="role_id" name="role_id">
                                <option value="" disabled selected>Role User</option>
                                <option value="admin">Admin</option>
                                <option value="mandor">Mandor</option>
                                <option value="supir">Supir</option>
                            </select> <br><br>

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