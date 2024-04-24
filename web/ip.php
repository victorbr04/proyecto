<?php
// Obtener la dirección IP de la máquina local
$ip = getHostByName(getHostName());

// Mostrar la dirección IP
echo "La dirección IP del servidor es: $ip\n";
?>
