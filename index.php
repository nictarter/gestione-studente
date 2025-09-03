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
    $pageName = "Homepage";
    require_once "includes/navbar.php";

?>

<body>
    <div class="container">
        <?php
            echo '<h1 class="text-center mt-5 mb-5">Bentornato, ' . implode($_SESSION["name"]) . '!</h1>';
        ?>
        <div class="row">
            <?php
                // Retrieve data from the json file:
                $json = file_get_contents("data/data.json");
                $data = json_decode($json);

                // Check any changes to the normal week's timetable through the database:
                include_once "includes/databaseConnection.inc.php";
                $timetable = db("SELECT * FROM lessons WHERE day ='" . date("d/m/Y") . "';", []);
                $differences = [];
                while ($lesson = $timetable->fetch(PDO::FETCH_OBJ)) {
                    // Check if any of today's lessons are different from the usual timetable:
                    if ($lesson->subject !== $data->schoolYear->current->timetable->week->{strtolower(date("l"))}->timetable->{$lesson->startHour}) {
                        $differences[] = [$lesson->startHour, $lesson->endHour, $data->schoolYear->current->timetable->week->{strtolower(date("l"))}->timetable->{$lesson->startHour}, $lesson->subject];
                    }
                }

                // Depending on the result of the check upon, display an alert:
                // (Regular timetable, changes in the timetable, --- NOTE: NOT YET AVAILABLE | event during the day | NOTE: NOT YET AVAILABLE---)
                // Start by checking if there are NO differences between the expected and actual timetable
                // $differences is an array containing the differences: if there are none it returns False
                if (!$differences) {
                    echo '<div class="alert alert-success">';
                    echo 'Il tuo orario è regolare. Nulla è cambiato dalla tua scorsa visita.';
                    echo '</div>';
                } else {
                    echo '<div class="alert alert-warning">';
                    echo 'Ti informiamo che sono state effettuate le seguenti modifiche all\'orario di oggi:';
                    echo '<br>';
                    echo '<b>Ore coinvolte:</b>';
                    echo '<ul class="mb-0">';
                    foreach ($differences as $changes) {
                        echo '<li><s><i>' . ucfirst($changes[2]) . ' (' . $changes[0] . ' - ' . $changes[1] . ')</i></s> -> ' . ucfirst($changes[3]) . ' (' . $changes[0] . ' - ' . $changes[1] . ')</li>';
                    }
                    echo '</ul>';
                    echo '</div>';
                }
            ?>
        </div>
        <div class="row mb-2">
            <?php
                // Check if any lesson needs to be saved:
                $lessonsToCheck = db("SELECT * FROM lessons WHERE description = '';", []);
                echo '<div class="col border rounded bg-' . (($lessonsToCheck->rowCount() === 0)? "success" : "warning") . ' pt-2">';
            ?>
                <h3 class="text-white">Lezioni</h3>
                <?php
                    // Display all (if any) of the lessons that need to be saved:
                    if ($lessonsToCheck->rowCount() === 0) {
                        echo '<p class="text-white">Al momento tutte le lezioni risultano salvate correttamente.</p>';
                    } else {
                        while ($lessonToCheck = $lessonsToCheck->fetch(PDO::FETCH_OBJ)) {
                            echo '<div class="row">';
                            echo '<div class="col-3 border rounded bg-white mx-3 mb-3 p-2">';
                            echo '<p class="fw-bold mb-2">' . ucfirst($lessonToCheck->subject) . '</p>';
                            echo '<p>Docente : ' . ucwords($lessonToCheck->teacher) . '</p>';
                            echo '<p>Orario : ' . $lessonToCheck->startHour . ' - ' . $lessonToCheck->endHour . '</p>';
                            echo '<button class="btn btn-success">Convalida</button>';
                            echo '<button class="btn btn-warning">Sostituzione</button>';
                            echo '</div>';
                            echo '</div>';
                        }
                    }
                ?>
            </div>
        </div>
        <div class="row">
            <div class="col border rounded bg-primary pt-2">
                <h3 class="text-white">Comunicazioni</h3>
                <?php
                    // Retrieve data from the json file:
                    $json = file_get_contents("data/data.json");
                    $data = json_decode($json);

                    // Import the function to retrieve the communications:
                    include_once "includes/func.inc.php";
                    retrieveCommunications([False, 5]);
                ?>
            </div>
        </div>
    </div>
</body>