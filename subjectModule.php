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

    // Check if the subject exists (set by GET redirection):
    $json = file_get_contents("data/data.json");
    $data = json_decode($json);
    if (!isset($data->schoolYear->current->subjects->{$_GET["subject"]})) {
        header("Location: index.php");
        die();
    }

    // Set the navbar of the page:
    $pageName = ucfirst($_GET["subject"]) . " - Moduli e argomenti delle lezioni";
    require_once "includes/navbar.php";
?>

<body>
    <div class="container">
        <?php
            // Set subject as title of the page:
            echo '<h1 class="text-center mt-5 mb-5">' . ucfirst($_GET["subject"]) . '</h1>';
        ?>
        <h3 class="text-center mb-5">Moduli e argomenti delle lezioni</h3>
        <?php
            // Check for the modules of the subject:
            if (!isset($data->schoolYear->current->subjects->{$_GET["subject"]}->modules->{1})) {
                echo '<div class="row">';
                echo '<p class="text-center">Non risulta ancora inserito alcun modulo o argomento per questa materia.</p>';
                echo '</div>';
            } else {
                // Create the accordion that will contain all the modules of the subject:
                echo '<div class="accordion accordion-background-active" id="modules' . ucfirst($_GET["subject"]) . '">';

                // For each of the modules, create an accordion item:
                foreach ($data->schoolYear->current->subjects->{$_GET["subject"]}->modules as $module => $content) {
                    echo '<div class="accordion-item">';
                    echo '<h2 class="accordion-header" id="module' . $module . '">';
                    echo '<button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#module' . $module . 'content" aria-expanded="false" aria-controls="module' . $module . 'content">';
                    echo 'Modulo ' . $module . ': ' . $content->title;
                    echo '</button>';
                    echo '</h2>';
                    echo '<div id="module' . $module . 'content" class="accordion-collapse collapse" data-bs-parent="#modules' . ucfirst($_GET["subject"]) . '" role="region" aria-labelledby="module' . $module . '">';
                    echo '<div class="accordion-body">';
                    echo '<p>' . $content->description . '</p>';

                    // For each of the submodules, create a subaccordion item:
                    foreach ($content->submodules as $submodule => $submoduleContent) {
                        echo '<div class="accordion" id="submodule' . $submodule . '">';
                        echo '<div class="accordion-item">';
                        echo '<h3 class="accordion-header" id="' . $submoduleContent->title . '">';
                        echo '<button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#submodule' . $submodule . 'content" aria-expanded="false" aria-controls="submodule' . $submodule . 'content">';
                        echo $submoduleContent->title;
                        echo '</button>';
                        echo '</h3>';
                        echo '<div id="submodule' . $submodule . 'content" class="accordion-collapse collapse" data-bs-parent="submodule' . $submodule . '" role="region" aira-labelledby="' . $submoduleContent->title . '">';
                        echo '<div class="accordion-body">';
                        echo $submoduleContent->description;
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                    }
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                }
                echo '</div>';
            }
        ?>
    </div>
</body>