<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/knowledge/util/Utils.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/knowledge/db/ConexaoDatabase.php');
require_once(__DIR__ . '/../class/HeuristicaConstrutiva.php');

$db = new DB;
$db->connect();

$result = $db->query("SELECT * FROM information_schema.columns WHERE table_name = 'film'");

// dump($result);

// $HeuristicaConstrutiva = new HeuristicaConstrutiva;
// $HeuristicaConstrutiva->buscarMelhorRota();