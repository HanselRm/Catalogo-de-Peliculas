<?php
session_start();
$arreglo = '';
if (!isset($_SESSION['idPersona'])) {
    header('Location: Login.php');
}
    $url = 'https://localhost:7127/api/Pelicula/get-one-pelicula?id=' . $_SESSION['idPersona'];

    $ch = curl_init($url);

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);


    $response = curl_exec($ch);
    if (curl_errno($ch)) {
        error_log(curl_error($ch));
    }

    $arreglo = json_decode($response, true);

    if(!empty($_GET['buscar'])){
        if($_GET['filtro'] == 1){
        
            $url = 'https://localhost:7127/api/Pelicula/get-Titulo?titulo='. $_GET['buscar'] .'&id=' . $_SESSION['idPersona'];
            $ch = curl_init($url);
    
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        
        
            $response = curl_exec($ch);
            
            if (curl_errno($ch)) {
                error_log(curl_error($ch));
            }
        
            $arreglo = json_decode($response, true);   
        }
        if($_GET['filtro'] == 2){
        
            $url = 'https://localhost:7127/api/Pelicula/get-ano?fecha='. $_GET['buscar'] .'&id=' . $_SESSION['idPersona'];
            $ch = curl_init($url);
    
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        
        
            $response = curl_exec($ch);
            
            if (curl_errno($ch)) {
                error_log(curl_error($ch));
            }
        
            $arreglo = json_decode($response, true);
        }
        if($_GET['filtro'] == 3){
        
            $url = 'https://localhost:7127/api/Pelicula/get-Director?nombre='. $_GET['buscar'] .'&id=' . $_SESSION['idPersona'];
            $ch = curl_init($url);
    
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        
        
            $response = curl_exec($ch);
            
            if (curl_errno($ch)) {
                error_log(curl_error($ch));
            }
        
            $arreglo = json_decode($response, true);
        }
        if($_GET['filtro'] == 4){
        
            $url = 'https://localhost:7127/api/Pelicula/get-Genero?genero='. $_GET['buscar'] .'&id=' . $_SESSION['idPersona'];
            $ch = curl_init($url);
    
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        
        
            $response = curl_exec($ch);
            
            if (curl_errno($ch)) {
                error_log(curl_error($ch));
            }
        
            $arreglo = json_decode($response, true);
        }
    }

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
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

<body class="antialiased bg-blue-900 ">
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

    <!-- Pagina principal -->
    <div class="con">
        <div id="container" class=" flex flex-col w-11/12 antialiased  py-5 mx-auto justify-center bg-blue-900">

            <form action="#" class="flex " method="GET">
                <select name="filtro"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-1/20 pl-2 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option selected>Filtro</option>
                    <option value="1">Titulo</option>
                    <option value="2">Año</option>
                    <option value="3">Director</option>
                    <option value="4">Genero</option>
                </select>



                <label for="simple-search" class="sr-only">Search</label>
                <div class="relative w-full">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor"
                            viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <input type="text" name="buscar" id="simple-search"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Buscar por genero, Titulo, Director..." required>
                </div>
                <button type="submit"
                    class="p-2.5 ml-2 text-sm font-medium text-white bg-blue-700 rounded-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    <span class="sr-only">Search</span>
                </button>

            </form>

        </div>
    </div>

    <!-- Body -->

    <div class="flex min-h-screen  py-4 w-full justify-center" >
              <div
                class="w-fit h-screen grid grid-cols-1 md:grid-cols-2 md:gap-5 lg:grid-cols-3 xl:grid-cols-6 gap-16">
                <?php  foreach ($arreglo as $pelicula){ 
                    $url = 'imagenes/'.$pelicula['imagen']['nombre']; ?>
                    
                <div id="card" class="group h-80 w-52 [perspective:1000px]">
                    <div
                        class="relative h-full w-full rounded-xl shadow-xl transition-all duration-500  [transform-style:preserve-3d] group-hover:[transform:rotateY(180deg)]">
                        <div class="absolute inset-0">
                            <img class="h-full w-full rounded-xl object-cover shadow-xl object-cover" src="<?php echo $url; ?>" alt="">
                        </div>
                        <div
                            class="absolute inset-0 h-full w-full rounded-xl bg-black/60 px-12 text-center text-white [transform:rotateY(180deg)] [backface-visibility:hidden]">
                            <div class="flex h-full flex-col items-center justify-center">
                                <h1 class="text-3x1 font-bold"><?php echo $pelicula['titulo'] ?></h1>
                                <p class="text-lg"><?php echo date("Y-m-d", strtotime($pelicula['año'])); ?></p>
                                <p class="text-base"><?php echo $pelicula['genero']['genero'] ?></p>
                                <p class="text-base"><?php echo $pelicula['nombreDirector'] .' '. $pelicula['apellidoDirector'] ?></p>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
        
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