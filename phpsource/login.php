<?php

include 'database.php';

$email = $_POST['email'];
$pass = $_POST['pass'];

//Consultar en la base de datos!
$stmt = mysqli_prepare($conexion, "SELECT * FROM madrid WHERE email = ?");
mysqli_stmt_bind_param($stmt, "s", $email);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$user = mysqli_fetch_assoc($result);

if ($user) {
    //verificar la contraseña hash
    if (password_verify($pass, $user['pass'])) {
        session_start();
        $_SESSION['user'] = $user['email'];
        $_SESSION['id'] = $user['id'];

        header("Location: ../index.php");
        exit();
    } else {
        echo "
            <script>
                alert('Contraseña incorrecta!'); window.location.href='../login.html';
            </script>
            exit(
        ";
        exit();
    }

} else {
    echo "
            <script>
                alert('User no encontrado!'); window.location.href='../login.html';
            </script>
        ";
        exit();
}

mysqli_close($conexion);

