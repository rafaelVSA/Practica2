<!-- 
    Programacion Web
    Seccion: N-1013
    Rafael V. Sanchez A.
    30.393.016

-->

<?php
session_start();


function matematicaAprobados($alumno) {
    return $alumno['matematica'] > 9.4;
}
function fisicaAprobados($alumno) {
    return $alumno['fisica'] > 9.4;
}
function programacionAprobados($alumno) {
    return $alumno['programacion'] > 9.4;
}



function matematicaReprobados($alumno) {
    return $alumno['matematica'] < 9.5;
}
function fisicaReprobados($alumno) {
    return $alumno['fisica'] < 9.5;
}
function programacionReprobados($alumno) {
    return $alumno['programacion'] < 9.5;
}


function AprobaronTodo($alumno) {
    return $alumno['programacion'] > 9.4 && $alumno['fisica'] > 9.4 && $alumno['matematica'] > 9.4;
}

function SoloUnaMateria($alumno) {
    return ($alumno['programacion'] > 9.4 && $alumno['fisica'] < 9.5 && $alumno['matematica'] < 9.5) || ($alumno['programacion'] < 9.5 && $alumno['fisica'] > 9.4 && $alumno['matematica'] < 9.5) || ($alumno['programacion'] < 9.5 && $alumno['fisica'] < 9.5 && $alumno['matematica'] > 9.4);
}

function DosMateria($alumno) {
    return ($alumno['programacion'] > 9.4 && $alumno['fisica'] > 9.4 && $alumno['matematica'] < 9.5) || ($alumno['programacion'] < 9.5 && $alumno['fisica'] > 9.4 && $alumno['matematica'] > 9.4) || ($alumno['programacion'] > 9.4 && $alumno['fisica'] < 9.5 && $alumno['matematica'] > 9.4);
}



if ($_SESSION['alumnos']) {
   
    
    $alumnos = $_SESSION['alumnos'];
    
    $aprobadosEnMate= count(array_filter($alumnos, 'matematicaAprobados'));
    $aprobadosEnFisi= count(array_filter($alumnos, 'fisicaAprobados'));
    $aprobadosEnProg= count(array_filter($alumnos, 'programacionAprobados'));

    $reprobadosEnMate= count(array_filter($alumnos, 'matematicaReprobados'));
    $reprobadosEnFisi= count(array_filter($alumnos, 'fisicaReprobados'));
    $reprobadosEnProg= count(array_filter($alumnos, 'programacionReprobados'));

    $pasaronTodas= count(array_filter($alumnos, 'AprobaronTodo'));

    $SoloUna= count(array_filter($alumnos, 'SoloUnaMateria'));

    $pasaronDos= count(array_filter($alumnos, 'DosMateria'));

        
}
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Resultados</title>
    <style>
        body{
           /* background: linear-gradient(90deg, rgba(19,15,101,1) 0%, rgb(94, 181, 187) 31%, rgba(0,212,255,1) 100%); */
            background-image: url(img/fondo2.jpg);
        }

        h1{
            font-family: Verdana, Geneva, Tahoma, sans-serif;
            display:table;
            margin:auto;
            margin-bottom: 4%;
            margin-top: 3%;
            color:white;
        }

        body form label{
            font-family: Verdana, Geneva, Tahoma, sans-serif;
            font-size: 20px;
            color:white;
        }

        
        .parrafos{
            display: table !important;
            margin: auto !important;
            margin-bottom: 2% !important;
        }
        

        .botones{
            display: table;
            margin:auto;
            font-size:20px;
            color:black;
            font-family: Verdana;
            
        }

        .quitar{
            text-decoration: none;
            color:black;
            margin-bottom: 10%;
        }
        .parrafos{
            color:white;
        }

        footer{
            
            width: 100% !important;
            height: 100px;
            background-color: gray;
            color: white;
            text-align: center;
            padding-top: 1.5%;
        }

    </style>
</head>
<body>

<br>

    <h1 class="parrafos">Resultados</h1>
    <br><br>

    <?php 

        $PromMate=0;
        foreach($alumnos as $alumno){
            $PromMate= $PromMate + $alumno['matematica'];
        }

        $PromFisi=0;
        foreach($alumnos as $alumno){
            $PromFisi= $PromFisi + $alumno['fisica'];
        }

        $PromProg=0;
        foreach($alumnos as $alumno){
            $PromProg= $PromProg + $alumno['programacion'];
        }

        $MaxMate=0;
        foreach($alumnos as $alumno){

            if($alumno['matematica']>$MaxMate){
                $MaxMate= $alumno['matematica'];
            }
        }

        $MaxFisi=0;
        foreach($alumnos as $alumno){

            if($alumno['fisica']>$MaxFisi){
                $MaxFisi= $alumno['fisica'];
            }
        }

        $MaxProg=0;
        foreach($alumnos as $alumno){

            if($alumno['programacion']>$MaxProg){
                $MaxProg= $alumno['programacion'];
            }
        }
    ?>

    
    <p class="parrafos">Promedio de Matemáticas: <?php echo $PromMate / ($aprobadosEnMate + $reprobadosEnMate); ?></p> 
    <p class="parrafos">Promedio de Física: <?php echo $PromFisi / ($aprobadosEnMate + $reprobadosEnMate); ?></p> 
    <p class="parrafos">Promedio de Programación: <?php echo $PromProg / ($aprobadosEnMate + $reprobadosEnMate); ?></p> 

    <p class="parrafos">Número de alumnos que aprobaron Matemáticas: <?php echo $aprobadosEnMate; ?></p>   
    <p class="parrafos">Número de alumnos que aprobaron Física: <?php echo $aprobadosEnFisi; ?></p>
    <p class="parrafos">Número de alumnos que aprobaron Programación: <?php echo $aprobadosEnProg; ?></p>
    
    <p class="parrafos">Número de alumnos que reprobaron Matemáticas: <?php echo $reprobadosEnMate; ?></p>   
    <p class="parrafos">Número de alumnos que reprobaron Física: <?php echo $reprobadosEnFisi; ?></p>
    <p class="parrafos">Número de alumnos que reprobaron Programación: <?php echo $reprobadosEnProg; ?></p>

    <p class="parrafos">Número de alumnos que pasaron todas las materias: <?php echo $pasaronTodas; ?></p>

    <p class="parrafos">Número de alumnos que pasaron solo una materia: <?php echo $SoloUna; ?></p>

    <p class="parrafos">Número de alumnos que pasaron dos materias: <?php echo $pasaronDos; ?></p>

    <p class="parrafos">Nota máxima de Matemáticas: <?php echo $MaxMate; ?></p> 
    <p class="parrafos">Nota máxima de Física: <?php echo $MaxFisi; ?></p> 
    <p class="parrafos">Nota máxima de Programación: <?php echo $MaxProg; ?></p> 


    <button type="button" class="quitar botones"><a class="quitar" href="index.php">Volver</a></button> 

    <footer>
        &copy; 2023. Todos los derechos reservados. <br> Maracaibo - Zulia <br> Venezuela.
    </footer>

</body>
</html>
