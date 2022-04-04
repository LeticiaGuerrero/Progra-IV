<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" 
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-lg navbar-light bg-success mb-3">
            <div class="container-fluid">
                <a class="navbar-brand  text-light" href="#">::.. SISTENA ACADEMICO -- UGB ..::</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse  text-light" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link  text-light" href="#">Inicio</a>
                        </li>
                        <li class="nav-item">
                            <a @click="abrirForm('alumno')" class="nav-link  text-light" href="#">Alumnos</a>
                        </li>
                        <li class="nav-item">
                            <a @click="abrirForm('docente')" class="nav-link  text-light" href="#">Docentes</a>
                        </li>
                        <li class="nav-item">
                            <a @click="abrirForm('materia')" class="nav-link  text-light" href="#">Materias</a>
                        </li>
                        <li class="nav-item">
                            <a @click="abrirForm('matricula')" class="nav-link  text-light" href="#">Matricula</a>
                        </li>
                        <li class="nav-item">
                            <a @click="abrirForm('inscripcion')" class="nav-link  text-light" href="#">Inscripcion</a>
                        </li>
                        <li class="nav-item">
                            <a @click="abrirForm('nota')" class="nav-link  text-light" href="#">Notas</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <h4 class="text-secondary text-center mt-2">Leticia Raquel Lopez Guerrero <span class="btn btn-outline-success">USIS028420</span></h4>
        <h4 class="text-secondary text-center mt-2">Gisella Merary Lopez Guerrero <span class="btn btn-outline-success">USIS06418</span></h4>
        <h4 class="text-secondary text-center mt-2">Elmer Antonio Angel Reyes <span class="btn btn-outline-success">USIS008520</span></h4>

        <alumno-component v-bind:form="forms" ref="alumno" v-show="forms['alumno'].mostrar" class="m-4"></alumno-component>
    </div>
    <script src="{{ asset('js/app.js') }}"></script>
</body>

</html>