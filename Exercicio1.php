<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "people";

// Criar conexão
$conn = new mysqli($servername, $username, $password);

// Checar conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

// Criar banco de dados 'people' se não existir
$sqlCreateDB = "CREATE DATABASE IF NOT EXISTS $dbname";
if ($conn->query($sqlCreateDB) === false) {
    die("Erro ao criar banco de dados: " . $conn->error);
}

// Selecionar o banco de dados 'people'
$conn->select_db($dbname);

// Verificar conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

// Criação das tabelas
$sqlCreateTables = "
    CREATE TABLE IF NOT EXISTS pessoas (
        id INT NOT NULL AUTO_INCREMENT,
        nome VARCHAR(255) NOT NULL,
        idade INT NOT NULL,
        PRIMARY KEY (id)
    );

    CREATE TABLE IF NOT EXISTS enderecos (
        id INT NOT NULL AUTO_INCREMENT,
        pessoa_id INT NOT NULL,
        rua VARCHAR(255) NOT NULL,
        cidade VARCHAR(255) NOT NULL,
        PRIMARY KEY (id),
        FOREIGN KEY (pessoa_id) REFERENCES pessoas (id)
    );

    CREATE TABLE IF NOT EXISTS telefones (
        id INT NOT NULL AUTO_INCREMENT,
        pessoa_id INT NOT NULL,
        numero VARCHAR(255) NOT NULL,
        PRIMARY KEY (id),
        FOREIGN KEY (pessoa_id) REFERENCES pessoas (id)
    );

    CREATE TABLE IF NOT EXISTS pedidos (
        id INT NOT NULL AUTO_INCREMENT,
        pessoa_id INT NOT NULL,
        valor DECIMAL(10,2) NOT NULL,
        data DATE NOT NULL,
        PRIMARY KEY (id),
        FOREIGN KEY (pessoa_id) REFERENCES pessoas (id)
    );
";

// Executar criação de tabelas
if ($conn->multi_query($sqlCreateTables) === false) {
    die("Erro ao criar tabelas: " . $conn->error);
}

// Fechar conexão para evitar problemas com multi-query
$conn->close();

// Reabrir conexão para inserção de dados
$conn = new mysqli($servername, $username, $password, $dbname);

// Inserção de dados para Vitim e Fabim (em consultas separadas)
$sqlInsertJoãoCarlos = "INSERT INTO pessoas (nome, idade) VALUES ('JoãoCarlos', 18)";
if ($conn->query($sqlInsertJoãoCarlos) === false) {
    die("Erro ao inserir dados de JoãoCarlos: " . $conn->error);
}

$Vitim_id = $conn->insert_id;

$sqlInsertEnderecoJoãoCarlos = "INSERT INTO enderecos (pessoa_id, rua, cidade) VALUES ('$JoãoCarlos_id', 'Felipe Andrade ', 'Uberaba')";
$sqlInsertTelefoneJoãoCarlos = "INSERT INTO telefones (pessoa_id, numero) VALUES ('$JoãoCarlos_id', '8')";
$sqlInsertPedidoJoãoCarlos = "INSERT INTO pedidos (pessoa_id, valor, data) VALUES ('$JoãoCarlos_id', 16.00, CURDATE())";

if ($conn->query($sqlInsertEnderecoJoãoCarlos) === false || $conn->query($sqlInsertTelefoneJoãoCarlos) === false || $conn->query($sqlInsertPedidoJoãoCarlos) === false) {
    die("Erro ao inserir dados de JoãoCarlos: " . $conn->error);
}

$sqlInsertMaxwell = "INSERT INTO pessoas (nome, idade) VALUES ('Maxwell', 17)";
if ($conn->query($sqlInsertMaxwell) === false) {
    die("Erro ao inserir dados de Maxwell: " . $conn->error);
}

$Fabim_id = $conn->insert_id;

$sqlInsertEnderecoMaxwell = "INSERT INTO enderecos (pessoa_id, rua, cidade) VALUES ('$Maxwell_id', 'Ferreira de Faria', 'Uberaba')";
$sqlInsertTelefoneMaxwell = "INSERT INTO telefones (pessoa_id, numero) VALUES ('$Maxwell_id', '345')";
$sqlInsertPedidoMaxwell = "INSERT INTO pedidos (pessoa_id, valor, data) VALUES ('$Maxwell_id', 14.00, CURDATE())";

if ($conn->query($sqlInsertEnderecoMaxwell) === false || $conn->query($sqlInsertTelefoneMaxwell) === false || $conn->query($sqlInsertPedidoMaxwell) === false) {
    die("Erro ao inserir dados de Maxwell: " . $conn->error);
}

$conn->close();
?>