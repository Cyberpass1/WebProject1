<?php 

include '../php/registro.php';
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/login.css">
</head>


<body>
    <div class="container-all">
        <div class="ctn-form">
            <img src="" alt="" class="logo">
            <h1 class="title">Registrate</h1>

            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <!-- Campo para el email -->
    <label for="email">Email</label>
    <input type="email" id="email" name="email" value="<?php echo isset($email) ? $email : ''; ?>">
    <?php if (!empty($email_err)) { ?>
        <span class="msg-error"><?php echo $email_err; ?></span>
    <?php } ?>

    <!-- Campo para el nombre de usuario -->
    <label for="userName">Usuario</label>
    <input type="text" id="userName" name="userName" value="<?php echo isset($userName) ? $userName : ''; ?>">
    <?php if (!empty($userName_err)) { ?>
        <span class="msg-error"><?php echo $userName_err; ?></span>
    <?php } ?>

    <!-- Campo para la contraseña -->
    <label for="password">Contraseña</label>
    <input type="password" id="password" name="password" value="">
    <?php if (!empty($password_err)) { ?>
        <span class="msg-error"><?php echo $password_err; ?></span>
    <?php } ?>
    
    <input type="submit" value="Registrarse">
</form>

            <span class="text-footer">¿Ya tienes una cuenta? <a href="Login.php">Incia sesion</a></span> 
        </div>

        <div class="ctn-registro">
            <div class="capa">
                <!-- <h1 class="title-description">Lorem ipsum</h1>
                <p class="text-description">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
                    Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit 
                    in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt 
                    mollit anim id est.
                </p>  -->
            </div>


        </div>




    </div>
</body>



</html>

