<?php
    session_start();
    if(!isset($_SESSION['idPersona'])){
    header('Location: Login.php');
       
    }
    $mensaje = '';
    $response= '';

    if(!empty($_POST['Genero'])){
        $mensaje = 'Este genero ya esta registrado';

        $Genero = $_POST['Genero'];

        $url = 'https://localhost:7127/api/Genero/Post-Genero';

        $ch = curl_init($url);

        $array = [
            'genero' => $Genero
        ];

        $json = json_encode($array);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);

        if(curl_errno($ch)){
            error_log(curl_error($ch));
        }
        
        curl_close($ch);

        if($response == 'Este genero ya esta registrado'){
           
            $mensaje = 'Este genero ya esta registrado';
        }

    }else{
        $mensaje = 'No se pudo registrar el genero';
    }
    
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar_genero</title>
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

<body class="antialiased bg-blue-900">

    <nav class="bg-gray-800 py-6 relative">
        <div class="container mx-auto flex px-8 xl:px-0">
        <div class="flex flex-grow pl-1">
                <a href="home.php" class="text-white text-2xl font-bold">Peliculas</a>
            </div>
            <div class="flex lg:hidden">
                <img src="menu.svg" class="w-6" onclick="openMenu();">
            </div>

            <div id="menu"
                class="lg:flex hidden flex-grow justify-between absolute lg:relative lg:top-0 top-20 left-0 bg-gray-800 lg:w-auto w-full  py-14 lg:py-0 px-8">
                <div class="flex flex-col lg:flex-row mb-8 lg:mb-0">
                    <a href="home.php" class="text-white lg:mr-7 mb-8 lg:mb-0 lg:text-lg">Inicio</a>
                    <a href="agregar_genero.php" class="text-white lg:mr-7 mb-8 lg:mb-0 lg:text-lg">Agregar Genero</a>
                    <a href="agregar_peli.php" class="text-white lg:mr-7 mb-8 lg:mb-0 lg:text-lg">Agregar Peliculas</a>
                </div>
                <div class="flex flex-col lg:flex-row text-center">
                    <a href="Cerrar.php"
                        class="py-2.5 px-5 rounded-md text-white bg-indigo-600 hover:bg-indigo-500 rounded-lg border-indigo-500 hover:shadow lg:mr-7 mb-8 lg:mb-0">Cerrar
                        sesion</a>

                </div>
            </div>
        </div>

    </nav>

    <div class="max-w-lg mx-auto my-10 bg-white p-8 rounded-xl shadow shadow-slate-300">
        <h1 class="text-4xl font-medium">Agregar Genero</h1>

        <form action="#" class="my-10" method="POST">
            <div class="my-5">
            <label class="w-full text-center py-3 my-3 border flex space-x-2 items-center justify-center border-slate-200 rounded-lg text-slate-700 hover:border-slate-400 hover:text-slate-900 hover:shadow transition duration-150">
                <?php
                
                if(trim($response) == 'Este genero ya esta registrado'){
                    echo $mensaje;
                }
                
                ?>
              
            </label>
            </div>
            <div class="flex flex-col space-y-5">
                <label for="Genero">
                    <p class="font-medium text-slate-700 pb-2">Nombre</p>
                    <input id="Genero" name="Genero" type="Genero"
                        class="w-full py-3 border border-slate-200 rounded-lg px-3 focus:outline-none focus:border-slate-500 hover:shadow"
                        placeholder="Ingrese el nombre del genero" required>
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
                    <span>Agregar</span>
                </button>

            </div>
        </form>
    </div>





    <div class="pb-20">
        <footer class="footer footer-center p-4 bg-gray-800 text-base-content fixed bottom-0 w-full">
            <div>
                <p class="text-center text-white">Copyright © 2023 - All right reserved by Hansel Rodriguez Mejia</p>
            </div>
        </footer>
    </div>


    <script>
        function openMenu() {
            let menu = document.getElementById("menu");

            if (menu.classList.contains("hidden")) {
                menu.classList.remove("hidden");
            } else {
                menu.classList.add("hidden");
            }
        }
    </script>
</body>

</html>