<?php

/**
 *  This file is part of Gestione Studente
 *  @author     Nicolò Tarter <nicolo.tarter@gmail.com>
 *  @copyright  (C) 2025 Nicolò Tarter
 *  @license    GPL-3.0+ <https://www.gnu.org/licenses/gpl-3.0.html>
 */

// Function to display all the current year's communications
// This function is set to work after the decoding of the json file
// The json file's data will be set in the $data variable before calling the function
// The function takes an array as input, set as follows: [isRead, limitResponse]
// While the isRead parameter is necessary, the other can be omitted
function retrieveCommunications($funcVar) {
    global $data;
    $read = $funcVar[0];
    if (isset($funcVar[1])) {
        $limitResponse = $funcVar[1];
        $i = 0;
    }

    if (!isset($data->schoolYear->current->communications->{"1"})) {
        echo '<p class="text-white">Al momento non hai alcuna comunicazione da leggere.</p>';
    } else {
        foreach ($data->schoolYear->current->communications as $communication => $content) {
            // Display the communication div:
            echo '<div class="row">';
            echo '<div class="col border rounded bg-white mx-3 mb-3" style="transform: rotate(0);">';
            echo '<p class="fw-bold mb-2">' . $content->title . ((!$read)?"<span class=\"badge bg-success ms-2\">Novità</span>" : "") . '</p>';
            echo '<p>' . $content->description . '</p>';
            echo '<a class="stretched-link" role="button" data-bs-toggle="modal" data-bs-target="#communication' . $communication . '"></a>';
            echo '</div>';

            // Modal opened when clicking on the communication:
            echo '<div class="modal" tabindex="-1" role="dialog" id="communication' . $communication . '" aria-labelledby="title' . $communication . '" aria-describedby="content' . $communication . '">';
            echo '<div class="modal-dialog" role="document">';
            echo '<div class="modal-content">';
            echo '<div class="modal-header">';
            echo '<h2 class="modal-title h5" id="title' . $communication . '">' . $content->title . '</h2>';
            echo '</div>';
            echo '<div class="modal-body">';
            echo '<p id="content' . $communication . '">' . $content->description . '</p>';
            
            // Check if the communication has any attached file and, in case, insert them:
            if (isset($content->attached_files)) {
                echo '<div class="link-list-wrapper">';
                echo '<ul class="link-list">';
                foreach ($content->attached_files as $attached_file => $fileTitle) {
                    echo '<li>';
                    echo '<a class="list-item icon-left" href="#">';
                    echo '<svg class="icon icon-primary">';
                    echo '<use href="includes/bootstrap-italia/svg/sprites.svg#it-chevron-right"></use>';
                    echo '</svg>';
                    echo '<span class="fw-bold">' . $fileTitle . '</span>';
                    echo '</a>';
                    echo '</li>';
                }
                echo '</ul>';
                echo '</div>';
                echo '</div>';
                echo '<div class="modal-footer">';
                echo '<button type="button" class="btn btn-outline-primary btn-sm" data-bs-dismiss="modal">Chiudi</button>';
                echo '<button type="button" class="btn btn-primary btn-sm">Segna come già letto</button>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
            }

            // Check if the limit of communications has been reached
            // The limit can be specified in the function's argument
            // If not specified there's no limit
            if (isset($limitResponse)) {
                if (++$i === $limitResponse) break;
            }
        }
    }
}