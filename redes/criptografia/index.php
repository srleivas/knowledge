<?php
namespace Criptografia;

require_once('./class/Assimetrica.php');

$Assimetrica = new Assimetrica;

$Assimetrica->gerarChaves();
