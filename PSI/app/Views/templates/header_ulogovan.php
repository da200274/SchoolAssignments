
    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark static-top">
        <div class="container">
            <a class="navbar-brand" href="<?= site_url("$controller")?>">
                <img src="/assets/img/logo-removebg-preview.png" alt="..." height="36">Virtual Zoo
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="<?= site_url("$controller")?>">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= site_url("Korisnik/about")?>">About</a>
                    </li>
                    <?php if ($role == 'admin'): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= site_url("Admin/admin")?>">Inbox</a>
                        </li>
                    <?php elseif ($role == 'moderator'): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= site_url("Moderator/moderator")?>">Inbox</a>
                        </li>
                    <?php endif; ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= site_url("Korisnik/log_out")?>">Log out</a>
                    </li>
                    <a class="navbar-brand" href="<?= site_url("Korisnik/profile")?>">
                        <img src="/assets/img/korisnik.png" alt="..." height="36">
                    </a>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Navbar End -->