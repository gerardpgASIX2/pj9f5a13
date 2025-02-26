<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

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
    $preguntesTotals = count($respostes_correctes); 
    $valor_resposta = 10 / $preguntesTotals;  // calcular valor per resposta 
    echo "<p> Numero de preguntes </p>". $preguntesTotals;
    
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
    
    // Mostramos el resultado con nombre y correo
    echo "<h2>Resultat de l'examen:</h2>";
    echo "<p><strong>Nom:</strong> " . htmlspecialchars($nom) . "</p>";
    echo "<p><strong>Correu electrònic:</strong> " . htmlspecialchars($email) . "</p>";
    
    // Redondear valores sin decimales:
    if ($puntInicials == floor($puntInicials)) {
        echo "<h2>Tu puntInicials final es: " . (int)$puntInicials . " de 10</h2>";
        
    } else {
        echo "<h2>Tu puntInicials final es: " . number_format($puntInicials, 2) . " de 10</h2>";
    }

    // Mostrar la cantidad de respuestas correctas e incorrectas
    echo "<p><strong>Respuestas correctas:</strong> " . $numPreguntes_correctes . "</p>";
    echo "<p><strong>Respuestas incorrectas:</strong> " . $numPreguntes_incorrectes . "</p>";
    echo "<!DOCTYPE html>
            <html lang='en'>
            <head>
                <meta charset='UTF-8'>
                <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                <title>Respostes</title>
                <link href='https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css' rel='stylesheet'>
            </head>
            <body>
                <div class='container-sm'>
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
                                <td>""</td>
                                <td>nota sobre 10</td>
                            </tr>
                        </tbody>
                    </table>
                    <h3>La vostra qualificació final en aquest qüestionari és (notaFinal) /10,00.</h2>
                </div>
            </body>
            </html>";

    echo '<br><a href="index.html"><button type="button">Volver a las preguntas</button></a>';

} else {
    echo "<h2>Error: No hi ha cap resultat.</h2>";
    echo '<br><a href="index.html"><button type="button">Volver a las preguntas</button></a>';
}
?>
