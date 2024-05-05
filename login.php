<?php
    session_start();

    if(empty($_POST) or (empty($_POST["usuario"]) or(empty($_POST["senha"])))){
        print"<script>location.href='admin.php';</script>";
    }

    include('config.php');

    $conn = new mysqli($servername, $username, $password, $dbname);
    
    // Verifica a conexão
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $usuario = $_POST["usuario"];
    $senha = $_POST["senha"];

    // Prepara a consulta SQL com uma declaração preparada
    $sql = "SELECT * FROM users WHERE cpf = ? AND senha = ?";
    $stmt = $conn->prepare($sql);

    // Vincula parâmetros
    $stmt->bind_param("ss", $usuario, $senha);

    // Executa a consulta
    $stmt->execute();

    // Obtém os resultados
    $res = $stmt->get_result();
    $row = $res->fetch_object();
    $qtd = $res->num_rows;

    if($qtd > 0){
        $_SESSION["cpf"] = $usuario;
        $_SESSION["name"] = $row->name;
        $_SESSION["tipo"] = $row->tipo;
        print "<script>location.href='ranking.php';</script>";
    } else {
        print "<script>alert('Usuário e/ou senha incorreto');</script>";
        print "<script>location.href='admin.php';</script>";

    }
?>