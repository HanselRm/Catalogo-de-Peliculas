<?php

$mensaje = '';
$response= '';
session_start();

if(isset($_SESSION['idPersona'])){
    header('Location: home.php');
    die();
     }

if(!empty($_GET['correo']) && !empty($_GET['contrasena'])){
    
    $correo = $_GET['correo'];
    $contrasena = $_GET['contrasena'];

    $url = 'https://localhost:7127/api/Personas/Get-Por-Correo?correo=' . $correo.'&contra=' . $contrasena;

    $ch = curl_init($url);

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);


    $response = curl_exec($ch);

    if(curl_errno($ch)){
        error_log(curl_error($ch)); 
    }
    else{}
    $arreglo = json_decode($response, true);
    
    
    if($response == 'Este usuario no existe'){
       
    }
    elseif($response == ''){

    }
    else{
        $_SESSION['idPersona'] = $arreglo[0]['idPersona'];
        header('Location: home.php');
        die();
        
    }

    curl_close($ch);

    if(isset($_SESSION['idPersona'])){
   header('Location: home.php');
   die();
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
        <h1 class="text-4xl font-medium">Iniciar Sesion</h1>


        <div class="my-5">
            <button
                class="w-full text-center py-3 my-3 border flex space-x-2 items-center justify-center border-slate-200 rounded-lg text-slate-700 hover:border-slate-400 hover:text-slate-900 hover:shadow transition duration-150">
                <img src="https://www.svgrepo.com/show/355037/google.svg" class="w-6 h-6" alt=""> <span>Iniciar Sesion con
                    Google</span>
            </button>

            <div class="my-5">
            <label class="w-full text-center py-3 my-3 border flex space-x-2 items-center justify-center border-slate-200 rounded-lg text-slate-700 hover:border-slate-400 hover:text-slate-900 hover:shadow transition duration-150">
                <?php
                if ($response == 'Este usuario no existe'): ?>
                <span> <?= $mensaje = 'Correo o contraseña Incorrecto'?> </span>
                <?php endif; ?>
            </label>
        </div>
        </div>

        
        <form action="Login.php" class="my-10" method="get">
            <div class="flex flex-col space-y-5">
                <label for="email">
                    <p class="font-medium text-slate-700 pb-2">Email</p>
                    <input id="email" name="correo" type="email"
                        class="w-full py-3 border border-slate-200 rounded-lg px-3 focus:outline-none focus:border-slate-500 hover:shadow"
                        placeholder="Ingrese el correo" required>
                </label>
                <label for="password">
                    <p class="font-medium text-slate-700 pb-2">Contraseña</p>
                    <input id="password" name="contrasena" type="password"
                        class="w-full py-3 border border-slate-200 rounded-lg px-3 focus:outline-none focus:border-slate-500 hover:shadow"
                        placeholder="Ingrese la contraseña" required>
                </label>
                <div class="flex flex-row justify-between">


                </div>
                <button ty
                    class="w-full py-3 font-medium text-white bg-indigo-600 hover:bg-indigo-500 rounded-lg border-indigo-500 hover:shadow inline-flex space-x-2 items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                    </svg>
                    <span>Login</span>
                </button>
                <p class="text-center">Not registered yet? <a href="register.php"
                        class="text-indigo-600 font-medium inline-flex space-x-1 items-center"><span>Register now
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