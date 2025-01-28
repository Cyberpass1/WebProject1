<?php
// Incluir el archivo de conexión
require_once 'conexion.php'; // Asegúrate de que la ruta sea correcta

// Procesar el formulario cuando se envíe
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Inicializar errores
    $userName_err = $email_err = $password_err = "";

    // Validación del campo 'userName'
    if (empty(trim($_POST["userName"]))) {
        $userName_err = "DEBE INGRESAR EL NOMBRE DE USUARIO";
    } else {
        // Preparar consulta SQL para verificar si el usuario ya existe
        $sql = "SELECT id_login FROM login WHERE log_user=?";

        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind de parámetros
            $param_username = trim($_POST["userName"]);
            mysqli_stmt_bind_param($stmt, "s", $param_username);

            // Ejecutar la consulta
            if (mysqli_stmt_execute($stmt)) {
                // Almacenar el resultado
                mysqli_stmt_store_result($stmt);

                // Verificar si el usuario ya existe
                if (mysqli_stmt_num_rows($stmt) == 1) {
                    $userName_err = "ESTE USUARIO YA SE ENCUENTRA REGISTRADO";
                } else {
                    $userName = trim($_POST["userName"]); // Asegúrate de asignar el valor de usuario aquí
                }
            } else {
                echo "Error al ejecutar la consulta: " . mysqli_error($link);
            }

            // Cerrar la sentencia
            mysqli_stmt_close($stmt);
        } else {
            echo "Error al preparar la consulta para el usuario: " . mysqli_error($link);
        }
    }

    // Validación del campo 'email'
    if (empty(trim($_POST["email"]))) {
        $email_err = "DEBE INGRESAR UN EMAIL";
    } else {
        // Preparar consulta SQL para verificar si el email ya está registrado
        $sql = "SELECT id_login FROM login WHERE log_email=?";

        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind de parámetros
            $param_email = trim($_POST["email"]);
            mysqli_stmt_bind_param($stmt, "s", $param_email);

            // Ejecutar la consulta
            if (mysqli_stmt_execute($stmt)) {
                // Almacenar el resultado
                mysqli_stmt_store_result($stmt);

                // Verificar si el email ya está registrado
                if (mysqli_stmt_num_rows($stmt) == 1) {
                    $email_err = "ESTE EMAIL YA SE ENCUENTRA REGISTRADO";
                } else {
                    $email = trim($_POST["email"]); // Asegúrate de asignar el valor de email aquí
                }
            } else {
                echo "Error al ejecutar la consulta: " . mysqli_error($link);
            }

            // Cerrar la sentencia
            mysqli_stmt_close($stmt);
        } else {
            echo "Error al preparar la consulta para el email: " . mysqli_error($link);
        }
    }

    // Validación del campo 'password'
    if (empty(trim($_POST["password"]))) {
        $password_err = "DEBE INGRESAR UNA CONTRASEÑA";
    } else if (strlen(trim($_POST["password"])) < 4) {
        $password_err = "DEBE INTRODUCIR UNA PASSWORD MAYOR A 4 CARACTERES";
    } else {
        $password = trim($_POST["password"]); // Asigna el valor de la contraseña aquí
    }

    // Si no hay errores, proceder con la inserción en la base de datos
    if (empty($userName_err) && empty($email_err) && empty($password_err)) {
        // Consulta para insertar el nuevo usuario
        $sql = "INSERT INTO login (log_user, log_password, log_email) VALUES (?, ?, ?)";

        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind de parámetros
            mysqli_stmt_bind_param($stmt, "sss", $param_username, $param_password, $param_email);

            // Asignar valores a los parámetros
            $param_username = $userName;
            $param_email = $email;
            $param_password = password_hash($password, PASSWORD_DEFAULT);
     //        $param_state = 1; Asumiendo que el estado es '1' para usuarios activos

            // Ejecutar la consulta
            if (mysqli_stmt_execute($stmt)) {
                // Redirigir a la página de login después de un registro exitoso
                echo "REGISTRO EXITOSO, BIENVENIDO!";
                header("location: login.php");
            } else {
                echo "Algo salió mal al registrar el usuario.";
            }

            // Cerrar la sentencia
            mysqli_stmt_close($stmt);
        } else {
            echo "Error al preparar la consulta para la inserción: " . mysqli_error($link);
        }
    }
}
?>