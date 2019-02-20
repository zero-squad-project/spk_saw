<header class="header-mobile d-block d-lg-none">
    <div class="header-mobile__bar">
        <div class="container-fluid">
            <div class="header-mobile-inner">
                <a class="logo" href="#">
                    <img src="<?=base_url();?>assets/img/icon/logo.png" alt="CoolAdmin" />
                </a>
                <button class="hamburger hamburger--slider" type="button">
                    <span class="hamburger-box">
                        <span class="hamburger-inner"></span>
                    </span>
                </button>
            </div>
        </div>
    </div>
    <nav class="navbar-mobile">
        <div class="container-fluid">
            <ul class="navbar-mobile__list list-unstyled">
                <li class="has-sub">
                    <a class="js-arrow" href="#">
                        Dashboard</a>
                </li>
            </ul>
        </div>
    </nav>
</header>
<aside class="menu-sidebar d-none d-lg-block">
    <div class="logo">
        <a href="#">
            <img src="<?=base_url();?>assets/img/icon/logo.png" alt="Cool Admin" />
        </a>
    </div>
    <div class="menu-sidebar__content js-scrollbar1">
        <nav class="navbar-sidebar">
            <ul class="list-unstyled navbar__list">
                <?php if($this->session->userdata('level') == "user"){ ?>
                <li class="active">
                    <a href="<?= base_url()?>index.php/admin">
                        <i class="fas fa-tachometer-alt"></i>Beranda</a>
                </li>
                <li>
                    <a href="#">
                        <i class="fas fa-archive"></i>Laporan</a>
                </li>
                <?php } else if($this->session->userdata('level') == "admin") { ?>
                <li class="active">
                <a href="<?= base_url()?>index.php/admin">
                        <i class="fas fa-tachometer-alt"></i>Beranda</a>
                </li>
                <li>
                    <a href="<?= base_url()?>index.php/admin/data_pegawai">
                        <i class="fas fa-table"></i>Pegawai</a>
                    </a>
                </li>
                <li>
                    <a href="<?= base_url()?>index.php/admin/data_penduduk">
                        <i class="fas fa-table"></i>Penduduk</a>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="fas fa-table"></i>Kriteria
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="fas fa-tasks"></i>Penilaian
                    </a>
                </li>
                <li>
                <a href="<?= base_url()?>index.php/admin/laporan_penerima">
                        <i class="fas fa-archive"></i>Laporan Penerima</a>
                    </a>
                </li>
                <?php } ?>
            </ul>
        </nav>
    </div>
</aside>