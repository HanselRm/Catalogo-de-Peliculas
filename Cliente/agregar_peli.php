<?php
session_start();
if (!isset($_SESSION['idPersona'])) {
    header('Location: Login.php');
}
$url = 'https://localhost:7127/api/Genero/get-All-Generos';
$ch = curl_init($url);

curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);


$response = curl_exec($ch);

if (curl_errno($ch)) {
    error_log(curl_error($ch));
} else {
}
$arreglo = json_decode($response, true);

    if(!empty($_POST['Titulo']) && !empty($_POST['Año']) && !empty($_POST['NombreDirector']) ){
        $mensaje = '';
        $response2 = 'sASDASD';
        

        $titulo = $_POST['Titulo'];
        $año = $_POST['Año'];
        $NombreDirector = $_POST['NombreDirector'];
        $ApellidoDirector = $_POST['ApellidoDirector'];
        $idGenero = $_POST['idGenero'];
        $idPersona = $_SESSION['idPersona'];

        $nombre_archivo = $_FILES['Foto']['name'];
        $tipo_archivo = $_FILES['Foto']['type'];
        $extencion = pathinfo($nombre_archivo, PATHINFO_EXTENSION);
        $imagen = realpath($_FILES['Foto']['tmp_name']);

        $nuevo_nombre_archivo = $nombre_archivo;

        $url = 'https://localhost:7127/api/Pelicula/Post-Pelicula';

        $chh = curl_init($url);

        $array = [
            'Titulo' => $titulo,
            'Año' => $año,
            'NombreDirector' => $NombreDirector,
            'ApellidoDirector' => $ApellidoDirector,
            'IdGenero' => $idGenero,
            'imagen' => new CURLFile($imagen,$nuevo_nombre_archivo, $tipo_archivo),
            'IdPersona' => $idPersona
        ];

        curl_setopt($chh, CURLOPT_POST, true);
        curl_setopt($chh, CURLOPT_POSTFIELDS, $array);
        curl_setopt($chh, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($chh, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($chh);

        if (curl_errno($chh)) {
            echo (curl_error($chh));
        }

        curl_close($chh);
        
    }
    
    
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar_pelicula</title>
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
        <div class="flex flex-grow pl-3">
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


    <!-- Formulario de agregar pelis -->
    <div class="max-w-lg mx-auto my-10 bg-white p-8 rounded-xl shadow shadow-slate-300">
        <h1 class="text-4xl font-medium">Agregar Pelicula</h1>

        <form action="#" class="my-10" method="post" enctype="multipart/form-data">
            <div class="flex flex-col space-y-5">

                <label for="Titulo">
                    <p class="font-medium text-slate-700 pb-2">Titulo</p>
                    <input id="Titulo" name="Titulo" type="text"
                        class="w-full py-3 border border-slate-200 rounded-lg px-3 focus:outline-none focus:border-slate-500 hover:shadow"
                        placeholder="Ingrese el nombre del titulo" required>
                </label>
                <label for="Año">
                    <p class="font-medium text-slate-700 pb-2">Fecha</p>
                    <input id="Año" name="Año" type="date"
                        class="w-full py-3 border border-slate-200 rounded-lg px-3 focus:outline-none focus:border-slate-500 hover:shadow"
                        placeholder="Ingrese la fecha de la pelicula" required>
                </label>
                <label for="NombreDirector">
                    <p class="font-medium text-slate-700 pb-2">Nombre del Director</p>
                    <input id="NombreDirector" name="NombreDirector" type="text"
                        class="w-full py-3 border border-slate-200 rounded-lg px-3 focus:outline-none focus:border-slate-500 hover:shadow"
                        placeholder="Ingrese el nombre del director" required>
                </label>
                <label for="ApellidoDirector">
                    <p class="font-medium text-slate-700 pb-2">Apellido del Director</p>
                    <input id="ApellidoDirector" name="ApellidoDirector" type="text"
                        class="w-full py-3 border border-slate-200 rounded-lg px-3 focus:outline-none focus:border-slate-500 hover:shadow"
                        placeholder="Ingrese el nombre del director" required>
                </label>

                <label for="idGenero" class="font-medium text-slate-700 pb-2">Selecciona un genero</label>
                <select id="idGenero"
                    class="w-full py-3 border border-slate-200 rounded-lg px-3 focus:outline-none focus:border-slate-500 hover:shadow"
                    name="idGenero">
                    <option selected>Selecciona un genero</option>
                    <?php
                    foreach ($arreglo as $genero): ?>
                        <option value="<?= $genero['idGenero'] ?>"> <?= $genero['genero'] ?> </option>
                    <?php endforeach; ?>
                </select>

                <label for="Foto">
                    <p class="font-medium text-slate-700 pb-2">Portada</p>
                    <input id="Foto" name="Foto" type="file" accept="image/*"
                        class="w-full py-3 border border-slate-200 rounded-lg px-3 focus:outline-none focus:border-slate-500 hover:shadow"
                        placeholder="Ingrese la portada" required>
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

    <!-- Footer -->

    <footer class="footer footer-center p-4 bg-gray-800 text-base-content relative bottom-0 w-full">
        <div>
            <p class="text-center text-white">Copyright © 2023 - All right reserved by Hansel Rodriguez Mejia</p>
        </div>

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