<?php
$mensaje = '';
$response = '';
if (!empty($_POST['nombre_registro']) && !empty($_POST['apellido_registro']) && !empty($_POST['correo_registro']) && !empty($_POST['contrasena_registro'])) {
    $mensaje = 'Este correo ya esta registrado';
    $response = 's';

    $nombre = $_POST['nombre_registro'];
    $apellido = $_POST['apellido_registro'];
    $correo = $_POST['correo_registro'];
    $contrasena = $_POST['contrasena_registro'];
    $contrasena2 = $_POST['contrasena_registro2'];


    if ($contrasena == $contrasena2) {

        $url = 'https://localhost:7127/api/Personas/post-Personas';
        $ch = curl_init($url);

        $array = [
            'nombre' => $nombre,
            'apellido' => $apellido,
            'correo' => $correo,
            'contraseña' => $contrasena
        ];

        $json = json_encode($array);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            error_log(curl_error($ch));
        }

        curl_close($ch);

    } else {
        $mensaje = 'Las contraseñas no coinciden';
    }

}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://rsms.me/">
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    <style>
        :root {
            font-family: 'Inter', sans-serif;
        }

        @supports (font-variation-settings: normal) {
            :root {
                font-family: 'Inter var', sans-serif;
            }
        }
    </style>
</head>

<body class="antialiased bg-slate-200">
    <div class="max-w-lg mx-auto my-10 bg-white p-8 rounded-xl shadow shadow-slate-300">
        <h1 class="text-4xl font-medium">Register</h1>

        <form action="#" class="my-3" method="POST" >

            <div class="my-5">
                <label
                    class="w-full text-center py-3 my-3 border flex space-x-2 items-center justify-center border-slate-200 rounded-lg text-slate-700 ">
                    <?php
                    if ($response == 'Este correo ya esta registrado ' or $response == 's'): ?>
                        <span>
                            <?= $mensaje; ?>
                        </span>
                    <?php endif; ?>
                </label>
            </div>

            <div class="flex flex-col space-y-5">
                <label for="nombre">
                    <p class="font-medium text-slate-700 pb-2">Nombre</p>
                    <input id="nombre" name="nombre_registro" type="text"
                        class="w-full py-3 border border-slate-200 rounded-lg px-3 focus:outline-none focus:border-slate-500 hover:shadow"
                        placeholder="Ingrese el nombre" required>
                </label>
                <label for="apellido">
                    <p class="font-medium text-slate-700 pb-2">Apellido</p>
                    <input id="apellido" name="apellido_registro" type="text"
                        class="w-full py-3 border border-slate-200 rounded-lg px-3 focus:outline-none focus:border-slate-500 hover:shadow"
                        placeholder="Ingrese el apellido" required>
                </label>
                <label for="correo">
                    <p class="font-medium text-slate-700 pb-2">Correo</p>
                    <input id="correo" name="correo_registro" type="email"
                        class="w-full py-3 border border-slate-200 rounded-lg px-3 focus:outline-none focus:border-slate-500 hover:shadow"
                        placeholder="Ingrese el correo" required>
                </label>
                <label for="contraseña">
                    <p class="font-medium text-slate-700 pb-2">Contraseña</p>
                    <input id="contraseña" name="contrasena_registro" type="password"
                        class="w-full py-3 border border-slate-200 rounded-lg px-3 focus:outline-none focus:border-slate-500 hover:shadow"
                        placeholder="Ingrese la contraseña" required>
                </label>
                <label for="contraseña2">
                    <p class="font-medium text-slate-700 pb-2">Contraseña</p>
                    <input id="contraseña2" name="contrasena_registro2" type="password"
                        class="w-full py-3 border border-slate-200 rounded-lg px-3 focus:outline-none focus:border-slate-500 hover:shadow"
                        placeholder="Confirme la contraseña" required>
                </label>
                <div class="flex flex-row justify-between">


                </div>
                <button type="submit"
                    class="w-full py-3 font-medium text-white bg-indigo-600 hover:bg-indigo-500 rounded-lg border-indigo-500 hover:shadow inline-flex space-x-2 items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                    </svg>
                    <span>Registrarse</span>
                </button>
                <p class="text-center">Ya tiene una cuenta? <a href="login.php"
                        class="text-indigo-600 font-medium inline-flex space-x-1 items-center"><span>Iniciar Sesion
                        </span><span><svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                            </svg></span></a></p>
            </div>
        </form>
    </div>

</body>

</html>