<?php

require 'database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $pass = $_POST['pass'];


    if (empty($name) || empty($email) || empty($pass)) {
        die('Por favor rellene todos los campos!');
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die('Correo no valido!');
    }

    //HASH DEL PASSWORD
    $hashPassword = password_hash($pass, PASSWORD_DEFAULT);

    $sql = 'INSERT INTO madrid (name, email, pass) VALUES (?, ?, ?)';
    $stmt = $conexion->prepare($sql);

    if ($stmt === false) {
        die('Datos no se insertaron!' . htmlspecialchars($conexion->error));
    }

    $stmt->bind_param('sss', $name, $email, $hashPassword);

    if ($stmt->execute()) {
        //header('Location: ../login.html');
        
        echo "
            <script>
                alert('Registro exitoso'); window.location.href='../login.html';
            </script>
        ";
    } else {
        echo ('Error: ' . htmlspecialchars($stmt->error));
    }

    $stmt->close();
}

$conexion->close();
