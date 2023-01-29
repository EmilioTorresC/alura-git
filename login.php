<?php

session_start();
//$jeje

require 'config.php';

if (!empty($_POST['usuario']) && !empty($_POST['password'])) {
    $records = $conn->prepare('SELECT id, usuario, password, deletee FROM usuarios WHERE usuario = :usuario');
    $records->bindParam(':usuario', $_POST['usuario']);
    if ($records == TRUE) {
        $records->execute();
        $results = $records->fetch(PDO::FETCH_ASSOC);
        //$r = new PDO($results);
        //$r = count((array)$records);
        //echo $r;
        //  echo $r['deletee'];
        //$mysqli = new mysqli("localhost", "root", "", "sistema");

        //$sql = "SELECT * FROM usuarios";
        //$resultado = $mysqli->query($sql);

        //while ($row = $resultado->fetch_assoc()) {
        //    if ($row['usuario'] == $_POST['usuario']) {
                if ($results > 0 && password_verify($_POST['password'], $results['password']) && $results['deletee'] == 0) {
                    if (($_POST['password'] == "admin") && ($_POST['usuario']) == "admin") {
                        $_SESSION['usuarios_id'] = $results['id'];
                        header("Location: /login/entrada.php");
                    } else {
                        header("Location: /login/entrada.php");
                    }
                } else {
                    echo '<div class="container">
            <div class="col col-lg-5 mt-3  alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Lo siento!</strong> El usuario o contraseña es incorrecta.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
          <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
          </div>';
                }
          //  }
       // }
    } else {
        echo '<div class="container">
        <div class="col col-lg-5 mt-3  alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Lo siento!</strong> El usuario o contraseña es incorrecta.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
      </div>';
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #222;
            background-image: linear-gradient(to right, #434343 0%, black 100%);
        }

        .bg {
            background-image: url(img/fondo3.jpg);
            background-position: center center;
        }
    </style>
</head>

<body>
    <div class="container w-75 bg-primary mt-5 mb-5 rounded shadow">
        <div class="row align-items-stretch">
            <div class="col bg d-none d-lg-block ">
            </div>
            <div class="col bg-white p-4 rounded-end">
                <!--
                <div class="text-end">
                    <img src="img/logo3.png" width="150" alt="">
                </div>
                -->
                <h2 class="fw-bold text-center mt-3 py-4">Inicio de sesión</h2>
                <form method="POST" action="login.php">

                    <div class="mb-4">
                        <!--<label for="inputEmailAddress" class="form-label">Usuario:</label>-->
                        <input class="form-control" id="inputEmailAddress" name="usuario" type="text" placeholder="Ingrese el usuario" />
                    </div>
                    <div class="mb-4">
                        <!--<label for="inputPassword" class="form-label">Contraseña:</label> -->
                        <input class="form-control" id="inputPassword" name="password" type="password" placeholder="Ingrese la contraseña" />
                    </div>
                    <div class="mb-4">
                        <input type="checkbox" name="connected" class="form-check-input">
                        <label for="connected" class="form-check-label">Recuérdame</label>
                    </div>
                    <div class="d-grid mt-4">
                        <button type="submit" class="btn btn-secondary">Iniciar Sesión</button>
                </form>
            </div>
            <div class="my-3">
                <span>¿No tienes cuenta? <a href="registro.php">Regístrate</a></span><br>
            </div>
            <!--
            <div class="container w-100 my-5">
                <div class="row text-center">
                    <div class="col-12">Iniciar Sesión</div>
                </div>
    -->

            <div class="row">
                <div class="col mt-3">
                    <button class="btn btn-outline-primary w-100 my-1">
                        <div class="row align-items-center">
                            <div class="col-2 d-none d-md-block">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-facebook" viewBox="0 0 16 16">
                                    <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z" />
                                </svg>
                            </div>
                            <div class="col-12 col-md-10 text-center">
                                Facebook
                            </div>
                        </div>
                    </button>
                </div>
                <div class="col mt-3">
                    <button class="btn btn-outline-danger w-100 my-1">
                        <div class="row align-items-center">
                            <div class="col-2 d-none d-md-block">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-google" viewBox="0 0 16 16">
                                    <path d="M15.545 6.558a9.42 9.42 0 0 1 .139 1.626c0 2.434-.87 4.492-2.384 5.885h.002C11.978 15.292 10.158 16 8 16A8 8 0 1 1 8 0a7.689 7.689 0 0 1 5.352 2.082l-2.284 2.284A4.347 4.347 0 0 0 8 3.166c-2.087 0-3.86 1.408-4.492 3.304a4.792 4.792 0 0 0 0 3.063h.003c.635 1.893 2.405 3.301 4.492 3.301 1.078 0 2.004-.276 2.722-.764h-.003a3.702 3.702 0 0 0 1.599-2.431H8v-3.08h7.545z" />
                                </svg>
                            </div>
                            <div class="col-12 col-md-10 text-center text-center">
                                Google
                            </div>
                        </div>
                    </button>
                </div>
            </div>
        </div>
    </div>
    </div>
</body>

</html>