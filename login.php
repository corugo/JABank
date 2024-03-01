<?php
    session_start();

    if(empty($_POST) or (empty($_POST["usuario"]) or(empty($_POST["senha"])))){
        print"<script>location.href='index.html';</script>";
    }

    include('config.php');

    $conn = new mysqli($servername, $username, $password, $dbname);

    $usuario = $_POST["usuario"];
    $senha = $_POST["senha"];

    $sql = "SELECT * FROM users
            WHERE cpf = '{$usuario}'
            AND senha = '{$senha}'";
    $res = $conn->query($sql) or die($conn->error);

    $row = $res->fetch_object();
    $qtd = $res->num_rows;

    if($qtd > 0){
        $_SESSION["cpf"] = $usuario;
        $_SESSION["name"] = $row->name;
        $_SESSION["tipo"] = $row->tipo;
        print "<script>location.href='ranking.php';</script>";
    } else {
        print "<script>alert('Usuário e/ou senha incorreto');</script>";
        print "<script>location.href='index.html';</script>";

    }
?>