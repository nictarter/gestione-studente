<?php

/**
 *  This file is part of Gestione Studente
 *  @author     Nicolò Tarter <nicolo.tarter@gmail.com>
 *  @copyright  (C) 2025 Nicolò Tarter
 *  @license    GPL-3.0+ <https://www.gnu.org/licenses/gpl-3.0.html>
 */

    session_start();
    
    // Check if the user is logged in:
    $_SESSION["role"] = "cici";
    if (!isset($_SESSION["role"])) {
        header("Location: login.php");
    }

    // Set the navbar of the page:
    $pageName = "Moduli e argomenti delle lezioni - Materie";
    require_once "includes/navbar.php";

?>

<body>
    <div class="container">
        <h1 class="text-center mt-5 mb-5">Moduli e argomenti delle lezioni</h1>
        <h3 class="text-center mb-5">Materie</h3>
        <?php
            // Get the subjects from the json file (data.json):
            $json = file_get_contents("data/data.json");
            $data = json_decode($json);
            echo '<div class="row text-center">';
            $i = 0;
            foreach ($data->schoolYear->current->subjects as $subject => $details) {
                echo '<div class="col mb-3">';
                echo '<button type="button" onclick="window.location.href=\'subjectModule.php?subject=' . urlencode($subject) . '\'" class="btn btn-primary btn-lg btn-me w-100 h-100">' . ucfirst($subject) . '</button>';
                echo '</div>';
                
                $i++;
                if ($i == 4) {
                    echo '</div>';
                    echo '<div class="row text-center">';
                    $i = 0;
                }
            }
            echo '</div>';
        ?>
    </div>
</body>