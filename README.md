Navegador.php
=============

Encontra navegador, versão, sistema operacional e se é mobile.
```
<?php
$navegador = new Plugins_Navegador;
$navegador->detectaSo();
$navegador->detectaNavegador();
echo '<pre>';
print_r($navegador->so);
print_r($navegador->navegador);
print_r($navegador->user_agent);
?>
```
