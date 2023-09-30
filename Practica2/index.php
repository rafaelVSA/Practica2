<!-- 
    Programacion Web
    Seccion: N-1013
    Rafael V. Sanchez A.
    30.393.016

-->


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Alumnos</title>
    
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

        
        .formulario{
            display: table !important;
            margin: auto !important;
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
    
       
    <h1>Alumnos</h1>
        <div class="formulario">

            <form action="" method="post">

                <label  for="cedula">Cédula:</label>
                <input type="text" name="cedula" required pattern=".{7,8}" title="La cédula debe contener entre 7 y 8 caracteres" onkeypress="return event.charCode >= 48 && event.charCode <= 57"><br><br><br>

                <label  for="nombre">Nombre:</label>
                <input type="text" name="nombre"  onkeypress="return soloLetras(event)" required><br><br><br>

                <script>
                    function soloLetras(e){
                        key = e.keyCode || e.which
                        tecla = String.fromCharCode(key).toString()
                        letras = "qwertyuiopasdfghjklñzxcvbnmQWERTYUIOPASDFGHJKLÑZXCVBNMáéíóúÁÉÍÚÓüÜ-'"
                        especiales = [8,13]
                        tecla_especial=false
                        for(var i in especiales){
                            if(key == especiales[i]){
                                tecla_especial=true
                                break
                            }
                        }

                        if(letras.indexOf(tecla) == -1 && !tecla_especial){
                            return false
                        }
                    }
                </script>

                <label  for="matematica">Matemática:</label>
                <input type="number" name="matematica" required min="1" max="20"><br><br><br>

                <label  for="fisica">Física:</label>
                <input type="number" name="fisica" required min="1" max="20"><br><br><br>

                <label  for="programacion">Programación:</label>
                <input type="number" name="programacion" required min="1" max="20"><br><br><br>

                    <input class="botones" type="submit" value="Registrar"><br>
            </form>
                
            <button type="button" class="btn btn-info botones"><a class="quitar" href="consultar.php">Consultar</a></button> <br><br>

        </div>
                
        <footer>
            &copy; 2023. Todos los derechos reservados. <br> Maracaibo - Zulia <br> Venezuela.
        </footer>

</body>

</html>



<?php


session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    


    if(isset($_POST['cedula']) && isset($_POST['nombre'])  && isset($_POST['matematica'])  && isset($_POST['fisica'])  
    && isset($_POST['programacion'])){

        if(!empty($_POST['cedula']) && !empty($_POST['nombre']) && !empty($_POST['matematica'])  && !empty($_POST['fisica'])  
        && !empty($_POST['programacion'])){

            $alumno = [
                'cedula' => $_POST['cedula'],
                'nombre' => $_POST['nombre'],
                'matematica' => (int)$_POST['matematica'],
                'fisica' => (int)$_POST['fisica'],
                'programacion' => (int)$_POST['programacion'],
            ];
            // Almacenar el alumno en un array de alumnos
            $_SESSION['alumnos'][] = $alumno;   

        }
        else{
            $result='Datos vacios';
        }
    }
    else{
        $result='No se enviaron los datos';
    }

    

}

function promedioMate($alumnos) {
    $SumaMate = array_reduce($alumnos, function($aux, $alumno){
        return $aux + $alumno['matematica'];
    }, 0);
    
    return $SumaMate / count($alumnos);
}


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

?>