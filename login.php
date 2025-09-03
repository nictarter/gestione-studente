<?php

/**
 *  This file is part of Gestione Studente
 *  @author     Nicolò Tarter <nicolo.tarter@gmail.com>
 *  @copyright  (C) 2025 Nicolò Tarter
 *  @license    GPL-3.0+ <https://www.gnu.org/licenses/gpl-3.0.html>
 */

    session_start();
    
    // Check if the user is already logged in:
    if (isset($_SESSION["role"])) {
        header("Location: index.php");
    }

    // Set the navbar of the page:
    $pageName = "Login";
    require_once "includes/navbar.php";

?>

<body>
    <div class="container">
        <h1 class="text-center mt-5 mb-5">Accedi ora</h1>
        <form action="includes/checkLogin.inc.php" method="post">
            <div class="row justify-content-center">
                <div class="form-group col-4">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" class="form-control" required>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="form-group col-4">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" class="form-control" required>
                </div>
            </div>
            <div class="row">
                <div class="form-group text-center">
                    <button type="button" class="btn btn-outline-primary">Annulla</button>
                    <button type="submit" class="btn btn-primary">Accedi</button>
                </div>
            </div>
        </form>
    </div>
</body>