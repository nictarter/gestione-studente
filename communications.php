<?php

/**
 *  This file is part of Gestione Studente
 *  @author     Nicolò Tarter <nicolo.tarter@gmail.com>
 *  @copyright  (C) 2025 Nicolò Tarter
 *  @license    GPL-3.0+ <https://www.gnu.org/licenses/gpl-3.0.html>
 */

    // Check if the user is logged in
    session_start();
    $_SESSION["role"] = "cici";
    if (!isset($_SESSION["role"])) {
        header("Location: login.php");
    }

    // Set the navbar of the page:
    $pageName = "Comunicazioni";
    require_once "includes/navbar.php";

?>

<body>
    <div class="container">
        <h1 class="text-center mt-5 mb-5">Comunicazioni</h1>
        <div class="row">
            <div class="col border rounded bg-primary pt-2 mb-2">
                <p class="text-white fw-bold">Le tue comunicazioni:</p>
                <?php
                    // Retrieve data from the json file:
                    $json = file_get_contents("data/data.json");
                    $data = json_decode($json);

                    // Import the function to retrieve the communications:
                    include_once "includes/func.inc.php";
                    retrieveCommunications([False]);
                ?>
            </div>
        </div>
    </div>
</body>