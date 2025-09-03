<?php

/**
 *  This file is part of Gestione Studente
 *  @author     Nicolò Tarter <nicolo.tarter@gmail.com>
 *  @copyright  (C) 2025 Nicolò Tarter
 *  @license    GPL-3.0+ <https://www.gnu.org/licenses/gpl-3.0.html>
 */

?>

<?php
    echo '<head>';

    // Variable set in each page that will store the page's name:
    $pageName;
    echo '<title>' . $pageName . '</title>';

    echo '<link rel="stylesheet" href="includes/bootstrap-italia/css/bootstrap-italia.min.css">';
    echo '<script src="includes/bootstrap-italia/js/bootstrap-italia.bundle.min.js"></script>';
    echo '</head>';
?>

<body>
    <div class="it-header-slim-wrapper">
        <div class="container-xxl">
            <div class="row">
            <div class="col-12">
                <div class="it-header-slim-wrapper-content">
                <a class="d-none d-lg-block navbar-brand" href="https://github.com/nictarter/Gestione-Studente.git">Gestione Studente</a>
                <div class="nav-mobile">
                    <nav aria-label="Navigazione accessoria">
                    <a class="it-opener d-lg-none" data-bs-toggle="collapse" href="#menu1a" role="button" aria-expanded="false" aria-controls="menu4">
                        <span>Gestione Studente</span>
                        <svg class="icon" aria-hidden="true"><use href="includes/bootstrap-italia/svg/sprites.svg#it-expand"></use></svg>
                    </a>
                    <div class="link-list-wrapper collapse" id="menu1a">
                        <ul class="link-list">
                        <li><a class="list-item" href="index.php">Homepage</a></li>
                        <li><a class="list-item" href="modules.php">Moduli e argomenti</a></li>
                        <li><a class="list-item" href="timetable.php">Orario</a></li>
                        <li><a class="list-item" href="communications.php">Comunicazioni</a></li>
                        </ul>
                    </div>
                    </nav>
                </div>
                <div class="it-header-slim-right-zone">
                    <div class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <span class="visually-hidden">Selezione lingua: lingua selezionata</span>
                        <span>ITA</span>
                        <svg class="icon d-none d-lg-block"><use href="includes/bootstrap-italia/svg/sprites.svg#it-expand"></use></svg>
                    </a>
                    <div class="dropdown-menu">
                        <div class="row">
                        <div class="col-12">
                            <div class="link-list-wrapper">
                            <ul class="link-list">
                                <li><a class="dropdown-item list-item" href="#"><span>ITA <span class="visually-hidden">selezionata</span></span></a></li>
                                <li><a class="dropdown-item list-item" href="#"><span>ENG</span></a></li>
                            </ul>
                            </div>
                        </div>
                        </div>
                    </div>
                    </div>
                    <div class="it-access-top-wrapper">
                    <a class="btn btn-primary btn-sm" href="login.php">Accedi</a>
                    </div>
                </div>
                </div>
            </div>
            </div>
        </div>
    </div>
</body>