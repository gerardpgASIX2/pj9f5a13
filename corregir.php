<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  
    $respuestas_correctas = [
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
    
    $puntaje = 10; 
    $total_preguntas = count($respuestas_correctas); 
    $penalizacion = 1 / 3; 
    $respuestas_incorrectas = 0; 
    
    foreach ($respuestas_correctas as $pregunta => $respuesta_correcta) {
        if (isset($_POST[$pregunta])) {
            if ($_POST[$pregunta] != $respuesta_correcta) {
                $respuestas_incorrectas++;
            }
        }    
    }
    
    $penalizacion_total = $respuestas_incorrectas * $penalizacion;
    $puntaje -= $penalizacion_total;    
    $puntaje = max(0, $puntaje);
    
    echo "<h2>Tu puntaje final es: " . number_format($puntaje, 2) . " de 10</h2>";
} else {
    echo "<h2>Error: No hi ha cap resultat.</h2>";
}
?>
