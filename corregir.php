<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  
    $respuestas_correctas = [
        "pregunta1" => "b", 
        "pregunta2" => "b",  
        "pregunta3" => "b", 
        "pregunta4" => "b",  
        "pregunta5" => "b"   
    ];
    
    $puntaje = 0;
    
    foreach ($respuestas_correctas as $pregunta => $respuesta_correcta) {
        if (isset($_POST[$pregunta])) {
            if ($_POST[$pregunta] == $respuesta_correcta) {
                $puntaje += 1; 
            } else {
                $puntaje -= 1/3; 
            }
        }    
    }
    $puntaje = max(0, $puntaje);
    
    echo "<h2>Tu puntaje final es: " . number_format($puntaje, 2) . " de 5</h2>";
} else {
    echo "<h2>Error: No se recibieron respuestas.</h2>";
}
?>
