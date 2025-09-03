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
    $pageName = "Orario";
    require_once "includes/navbar.php";

?>

<body>
    <div class="container">
        <div class="row">
            <h1 class="text-center mt-5 mb-5">Orario</h1>
            <div class="alert alert-success">
                Il tuo orario è regolare. Nulla è cambiato dalla tua scorsa visita.
            </div>
            <div class="alert alert-warning">
                Ti informiamo che è stata effettuata la seguente modifica all'orario:<br>
                <b>Ore coinvolte:</b>
                <ul class="mb-0">
                    <li>ORA VECCHIA (orario) -> ORA NUOVA (orario)</li>
                </ul>
            </div>
            <div class="alert alert-info">
                Ti informiamo che la tua classe parteciperà al seguente evento in questa data:
                <ul class="mb-0">
                    <li>EVENTO (orario)
                </ul>
            </div>
        </div>
        <div class="row">
            <h3 class="text-center mb-3">Giorno X Mese Anno</h3>
            <table class="table table-hover">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">Orario</th>
                        <th scope="col">Materia</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>ORARIO1</td>
                        <td>MATERIA1</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>