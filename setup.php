<?php
include 'config.php';

$conn = new mysqli($servername, $username, $password, $dbname);

if($conn->connect_error) {
	die("Conexão falhou" . $conn->connect_error);
}

$sql = "CREATE TABLE IF NOT EXISTS users (
	cpf VARCHAR(11) PRIMARY KEY,
	cash INT,
	name VARCHAR(100),
	fone VARCHAR(20),
	senha VARCHAR(100),
	tipo CHAR(1),
	data_cadastro DATETIME NOT NULL,
	data_nascimento DATETIME NOT NULL
)";

$sql2 = "CREATE TABLE IF NOT EXISTS logs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    datahora DATETIME NOT NULL,
    cpf VARCHAR(11) NOT NULL,
	name VARCHAR(100) NOT NULL,
    operacao VARCHAR(50) NOT NULL,
    quantidade INT NOT NULL,
    cash INT NOT NULL,
	descricao VARCHAR(100) NOT NULL,
	usuario VARCHAR(100) NOT NULL
)";

$sql3 = "CREATE TABLE IF NOT EXISTS operacoes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100),
    operador ENUM('adicionar', 'remover'),
    quantidade INT,
    descricao VARCHAR(100),
    ativo BOOLEAN
)";

if ($conn->query($sql) === TRUE) {
	echo "Tabela users criada com sucesso!<br>";
} else {
	echo "Erro ao criar tabela users: " . $conn->error;
}

if ($conn->query($sql2) === TRUE) {
	echo "Tabela logs criada com sucesso!<br>";
} else {
	echo "Erro ao criar tabela: " . $conn->error;
}

if ($conn->query($sql3) === TRUE) {
	echo "Tabela operacoes criada com sucesso!<br>";
} else {
	echo "Erro ao criar tabela: " . $conn->error;
}

$conn->close();
?>