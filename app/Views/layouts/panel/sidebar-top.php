<ul class="app-menu list-unstyled accordion" id="menu-accordion">
    <li class="nav-item">
        <a class="nav-link" data-pagenav="dashboard" href="<?= route_to('/') ?>">
            <span class="nav-icon">
                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-house-door" fill="currentColor"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M7.646 1.146a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 .146.354v7a.5.5 0 0 1-.5.5H9.5a.5.5 0 0 1-.5-.5v-4H7v4a.5.5 0 0 1-.5.5H2a.5.5 0 0 1-.5-.5v-7a.5.5 0 0 1 .146-.354l6-6zM2.5 7.707V14H6v-4a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 .5.5v4h3.5V7.707L8 2.207l-5.5 5.5z" />
                    <path fill-rule="evenodd" d="M13 2.5V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z" />
                </svg>
            </span>
            <span class="nav-link-text">Dashboard</span>
        </a>
    </li>
    <li class="nav-item has-submenu">
        <a class="nav-link submenu-toggle" href="#" data-bs-toggle="collapse" data-bs-target="#submenu-1"
            aria-expanded="false" aria-controls="submenu-1">
            <span class="nav-icon">
                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-files" fill="currentColor"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M4 2h7a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2zm0 1a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h7a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1H4z" />
                    <path
                        d="M6 0h7a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2v-1a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H6a1 1 0 0 0-1 1H4a2 2 0 0 1 2-2z" />
                </svg>
            </span>
            <span class="nav-link-text">Master Data</span>
            <span class="submenu-arrow">
                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-chevron-down" fill="currentColor"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z" />
                </svg>
            </span>
        </a>
        <div id="submenu-1" class="collapse submenu submenu-1" data-bs-parent="#menu-accordion">
            <ul class="submenu-list list-unstyled">
                <li class="submenu-item"><a class="submenu-link" data-pagenav="puskesmas" href="<?= route_to('puskesmas') ?>">Puskesmas</a></li>
                <li class="submenu-item"><a class="submenu-link" data-pagenav="pasien" href="<?= route_to('pasien') ?>">Pasien</a>
                </li>
            </ul>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-pagenav="perpuskesmas" href="<?= base_url('perpuskesmas') ?>">
            <span class="nav-icon">
                <i class="fa-solid fa-hand-holding-heart"></i>
            </span>
            <span class="nav-link-text">Data Gizi Perpuskesmas</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-pagenav="klasterisasi" href="<?= base_url('klasterisasi') ?>">
            <span class="nav-icon">
                <i class="fa-solid fa-layer-group"></i>
            </span>
            <span class="nav-link-text">Klasterisasi Pasien</span>
        </a>
    </li>
</ul>