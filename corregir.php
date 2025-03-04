<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Llistat de respostes correctes
    $respostes_correctes = [
        "pregunta1" => "b", 
        "pregunta2" => "a",  
        "pregunta3" => "c", 
        "pregunta4" => "d",  
        "pregunta5" => "b", 
        "pregunta6" => "c",
        "pregunta7" => "a",
        "pregunta8" => "b",
        "pregunta9" => "a",
        "pregunta10" => "a",
        "pregunta11" => "b",
        "pregunta12" => "b",
        "pregunta13" => "d",
        "pregunta14" => "d",
        "pregunta15" => "b",
        "pregunta16" => "c",
    ];

    $nom = $_POST['nombre'];  // agafar nom alumne
    $email = $_POST['email']; // agafar email alumne
    
    $puntInicials = 0;  //puntuatge inicial
    $penalizacion = 1 / 3;  // Penalizació por resposta incorrecta
    $preguntesTotals = count($respostes_correctes); // contar numero de preguntes
    // echo $preguntesTotals;
    $valor_resposta = 10 / $preguntesTotals;  // calcular valor per resposta     
    $numPreguntes_correctes = 0; // contador respostes correctes
    $numPreguntes_incorrectes = 0; // contador respostes incorrectes
    
    foreach ($respostes_correctes as $pregunta => $respuesta_correcta) {
        if (isset($_POST[$pregunta])) {
            if ($_POST[$pregunta] == $respuesta_correcta) {
                // Respuesta correcta: sumamos el valor correspondiente
                $puntInicials += $valor_resposta;
                $numPreguntes_correctes++;  // Aumentamos el contador de respuestas correctas
            } else {
                // Respuesta incorrecta: penalizamos un tercio de punto
                $puntInicials -= $penalizacion;
                $numPreguntes_incorrectes++;  // Aumentamos el contador de respuestas incorrectas
            }
        }
        // Si no se respondió, no hacemos nada (ni penalización ni puntos sumados)
    }

    // Aseguramos que el puntInicials no sea negativo ni mayor a 10
    $puntInicials = max(0, min(10, $puntInicials));
    
    // funcio redondear valor final:
    function obtenerNotaFinal($puntInicials) {
        if ($puntInicials == floor($puntInicials)) {
            return (int)$puntInicials;
        } else {
            return number_format($puntInicials, 2);
        }
    }
    
// Función verificar si aprobar o suspender:
    function verificarAprobacion($puntInicials) {
        $notaFinal = obtenerNotaFinal($puntInicials);
    
        if ($puntInicials >= 5 && $puntInicials <= 10) {
            return "<p class='text-success'> Aprobat </p>";  // Has aprobado
        } else if ($puntInicials >= 0 && $puntInicials < 5) {
            return "<p class='text-danger'> Suspes </p>";  // Has suspendido
        }
    }

    // Mostrar Tabla de resultats
    echo "<!DOCTYPE html>
            <html lang='en'>
            <head>
                <meta charset='UTF-8'>
                <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                <title>Respostes</title>
                <link href='https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css' rel='stylesheet'>
            </head>
            <body>
                <div class='container-sm pt-3'>
                    <h2>Resultat de l'examen:</h2>
                    <table class='table table-hover'>
                        <thead>
                            <tr>
                                <th scope='col'>Estat</th>
                                <th scope='col'>Nº Preguntes</th>
                                <th scope='col'>Respostes correctes</th>
                                <th scope='col'>Respostes incorrectes</th>
                                <th scope='col'>Qualificació / 10</th>
                                <th scope='col'>Resultat</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope='row'>". date('jS F Y h:i:s A'). "</th>
                                <td> $preguntesTotals </td>
                                <td> $numPreguntes_correctes </td>
                                <td> $numPreguntes_incorrectes </td>
                                <td> " . obtenerNotaFinal($puntInicials) . "</td>
                                <td>" . verificarAprobacion($puntInicials) . "</td>
                            </tr>
                        </tbody>
                    </table>
                    <h3>La vostra qualificació final en aquest qüestionari és " . obtenerNotaFinal($puntInicials) . " /10,00.</h2>
                    <a href='index.html'><button type='button' class='mt-3 btn btn-primary'>Volver a las preguntas</button></a>
                </div>
            </body>
            </html>";

} else {
    echo "<h2>Error: No hi ha cap resultat.</h2>";
    echo '<br><a href="index.html"><button type="button" class="mt-3 btn btn-primary">Volver a las preguntas</button></a>';
}
?>
