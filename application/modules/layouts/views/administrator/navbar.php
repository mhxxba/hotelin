<?php
    
    $controller = $this->uri->segment(1);
    $function   = $this->uri->segment(2);

?>

<nav class="navbar navbar-expand-lg sticky-top navbar-dark bg-primary">
    <div class="container-fluid">
        <a class="navbar-brand" href="<?= site_url('/') ?>">
            Hotelin
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a
                        href="<?= site_url('administrator/dashboard') ?>"
                        class=
                            "
                                nav-link
                                <?= ($controller == 'administrator' && $function == 'dashboard')  ? 'active' : '' ?>
                            "
                    >
                        Beranda
                    </a>
                </li>

                <li class="nav-item">
                    <a
                        href="<?= site_url('administrator/hotel') ?>"
                        class=
                            "
                                nav-link
                                <?= ($controller == 'administrator' && $function == 'hotel')  ? 'active' : '' ?>
                            "
                    >
                        Data Hotel
                    </a>
                </li>

                <li class="nav-item">
                    <a
                        href="<?= site_url('administrator/user') ?>"
                        class=
                            "
                                nav-link
                                <?= ($controller == 'administrator' && $function == 'user')  ? 'active' : '' ?>
                            "
                    >
                        Data Pengguna
                    </a>
                </li>
                
            </ul>
            <div class="d-flex">
                <?php if($this->auth->is_login()) : ?>

                    <div class="nav-item dropdown">
                        <button
                            type="button"
                            class="btn btn-primary dropdown-toggle"
                            data-bs-toggle="dropdown" aria-expanded="false"
                        >
                            Halo, <?= mb_strimwidth($this->auth->user()->name, 0, 10, '...') ?>
                        </button>

                        <ul class="dropdown-menu">
                            <li>
                                <button
                                    type="button"
                                    class="dropdown-item"
                                    onclick="changePassword()"
                                >
                                    Ganti Password
                                </button>
                            </li>
                            
                            <li><hr class="dropdown-divider"></li>
                            
                            <li>
                                <a href="<?= site_url('auth/signout') ?>" class="dropdown-item text-danger">
                                    Keluar
                                </a>
                            </li>
                        </ul>
                    </div>

                <?php else : ?>
                    <button
                        type="button"
                        class="btn btn-primary"
                        onclick="authentication('signin')"
                    >
                        <i class="fa-solid fa-user me-1"></i>
                        Masuk / Daftar
                    </button>
                <?php endif ?>
            </div>
        </div>
    </div>
</nav>