<?php
    session_start();
    unset($_SESSION["cpf"]);
    unset($_SESSION["name"]);
    unset($_SESSION["tipo"]);
    session_destroy();
    header("Location: index.html");
    exit;