<?php
/**
 * Author: James Ritter
 * Date: $(DATE)
 * File: $(FILE_NAME)
 * Description:
 **/
?>

<?php
    //Start new session
    if (session_status() == PHP_SESSION_NONE){
        session_start();
    }
    
    //Create 3 variables for login, username, and role
    $login = "";
    $name = "";
    $role = "";
    
    //If the user has logged in: retrieve login, name, and role
    if (isset($_SESSION["login"]) AND isset($_SESSION["name"]) AND isset($_SESSION["role"])){
        $login = $_SESSION["login"];
        $name = $_SESSION["name"];
        $role = $_SESSION["role"];
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title><?php $title; ?></title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="style.css">
    </head>