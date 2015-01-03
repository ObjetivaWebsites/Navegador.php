Navegador.php
=============

Encontra Navegador, versão, sistema operacional, se é mobile ou tablet.

<?php
$navegador = new Plugins_Navegador;
$navegador->detectaSo();
$navegador->detectaNavegador();
echo '<pre>';
print_r($navegador->so);
print_r($navegador->navegador);
print_r($navegador->user_agent);
?>
