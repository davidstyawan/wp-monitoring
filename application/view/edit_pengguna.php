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
                EDIT PENGGUNA
            </div>
            <div class="row">
                <div class="big-card">
                    <div class="centered-wrapper">
                        <h4>Form Pengguna</h4>

                        <form action="<?= base_url('admin/ubahdata') ?>" method="post" required>
                            <input type="hidden" name="id" value="<?= $user['id'] ?>">
                            <div class="form-group">
                                <input type="text" name="name" class="form-control" value="<?= $user['name'] ?>" id="exampleInputUsername" placeholder="Enter username" required>
                            </div>
                            <div class="form-group">
                                <input type="email" name="email" class="form-control" value="<?= $user['email'] ?>" id="exampleInputEmail" placeholder="Enter email" required>
                            </div>
                            <div class="form-group">
                                <input type="password" name="password" class="form-control" value="<?= $user['password'] ?>" id="exampleInputPassword" placeholder="Password" required>
                            </div>
                            <div>
                                <select id="role_id" name="role_id" required>
                                    <option value="" disabled selected>Role User</option>
                                    <option value="admin">Admin</option>
                                    <option value="mandor">Mandor</option>
                                    <option value="supir">Supir</option>
                                </select>
                            </div>


                            <br><br>

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