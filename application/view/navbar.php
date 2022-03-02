<!-- navbar -->
<div class="header">
    <div class="header-menu">
        <div class="hamburger hamburger--cancel">
            <div class="hamburger-box">
                <div class="hamburger-inner"></div>
            </div>
        </div>
    </div>
    <div class="title">DETV</div>
</div>

<!-- sidebar -->
<div class="sidebar">
    <div class="sidebar-menu">
        <center class="profile">
            <img src="<?= base_url('assets/img/') . $user['image']; ?>">
            <p><?= $user['name']; ?></p>
            <!-- <?= $user['name']; ?> -->
        </center>
        <li class="item">
            <a href="<?= base_url(); ?>admin/index" class="menu-btn">
                <i class="fa fa-home"></i>
                <span>Dashboard</span>
            </a>

        </li>
        <li class="item">
            <a href="<?= base_url(); ?>admin/tabel2" class="menu-btn"><i class="fa fa-table"></i>
                <span>Data Tabel</span>
            </a>
        </li>
        <li class="item">
            <a href="<?= base_url(); ?>admin/grafik1" class="menu-btn"><i class="fa fa-bar-chart"></i>
                <span>Data Grafik</span>
            </a>
        </li>
        <li class="item">
            <a href="<?= base_url(); ?>admin/pengguna" class="menu-btn">
                <i class="fa fa-user-circle"></i> <span>Pengguna</span>
            </a>
        </li>
        <li class="item">
            <a href="<?= base_url(); ?>admin/absen2" class="menu-btn"><i class="fa fa-list"></i>
                <span>Data Kehadiran</span></a>
        </li>
        <li class="item">
            <a href="<?= base_url(); ?>admin/pengaturan_mobil" class="menu-btn"><i class="fa fa-car"></i>
                <span>Data Kendaran</span></a>
        </li>

        <li class="item" id="pengaturan">
            <a href="#pengaturan" class="menu-btn">
                <i class="fa fa-cog" aria-hidden="true"></i> <span>Pengaturan</span> <i class="fa fa-chevron-down drop-down"> </i>
            </a>
            <div class="sub-menu">
                <a href="<?= base_url(); ?>admin/profil" class="menu-btn">
                    <i class="fa fa-user" aria-hidden="true"></i>
                    <span>Edit Profil</span>
                </a>
                <a href='#yakin-out' class="menu-btn">
                    <i class="fa fa-sign-out"></i>
                    <span>Log Out</span>
                </a>
            </div>
        </li>
        <li class="item">
            <a href="<?= base_url(); ?>admin/about" class="menu-btn"><i class="fa fa-question-circle"></i>
                <span>About</span></a>
        </li>
        <li class="item">
            <a class="menu-btn"></a>
        </li>
    </div>
</div>
<div id="yakin-out" class="overlay">
    <div class="popup">
        <h4>Apakah anda yakin?</h4>
        <a class="close" href="#">
            <button type="button" class="btn btn-smallred" onclick="window.location.href='#'"><i class="fa fa-times"></i></button>
        </a>
        <button type="button" class="btn btn-smallred" onclick="window.location.href='<?= base_url(); ?>auth/logout'"><i class="fa fa-sign-out"></i></button>
    </div>
</div>
<script src="<?= base_url(); ?>assets/lib/jquery/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $(".hamburger").click(function() {
            $(".wrapper").toggleClass("collapse");
        });
    });

    var hamburger = document.querySelector(".hamburger");
    hamburger.addEventListener("click", function() {
        hamburger.classList.toggle("is-active");
    });
</script>