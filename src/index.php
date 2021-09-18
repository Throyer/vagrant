<?php
    echo "Testando conexao <br /> <br />";
    $url = "192.168.1.11:3306";
    $username = "phpuser";
    $password = "pass";

    // Create connection
    $conn = new mysqli($url, $username, $password);

    // Check connection
    if ($conn->connect_error) {
        die("Conexão falhou: " . $conn->connect_error);
    }
    echo "Conectado com sucesso";
?>