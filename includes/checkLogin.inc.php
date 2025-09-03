<?php

/**
 *  This file is part of Gestione Studente
 *  @author     Nicolò Tarter <nicolo.tarter@gmail.com>
 *  @copyright  (C) 2025 Nicolò Tarter
 *  @license    GPL-3.0+ <https://www.gnu.org/licenses/gpl-3.0.html>
 */

session_start();

// Check if the user arrived here automatically or by manually typing the address:
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: ../index.php");
}

// Retrieve access data from the form:
$username = $_POST["username"];
$password = $_POST["password"];

// Check if the user exists in the database:
try {
    include_once "databaseConnection.inc.php";
    $user = db("SELECT name FROM users WHERE username = ? AND password = ?;", [$username, $password]);
    // If the user has logged in correctly:
    if ($user->fetch(PDO::FETCH_ASSOC)) {
        $_SESSION["role"] = "user";
        $_SESSION["name"] = $user;
        header("Location: ../index.php");
    } else {
        header("Location: ../login.php");
    }
} catch(PDOException $e) {
    die("La richiesta dei dati al database è fallita: " . $e);
}