<?php


require('src/Proceda.php');
require('src/EDI/Parse.php');
require('src/EDI/Interpreter.php');
require('src/EDI/Skeleton.php');

use PHPProceda\Proceda;

$file = __DIR__.'/MODELO-OCURREN.txt';

$proceda = new Proceda($file);

$datafull = date('dmyHi');
$datames = date('dmHi');
$cnpj = 11724258000157;

$serie  = sprintf("%-3s", 4); //condicional = pode ou não ser preenchido

$nf = sprintf("%08d", 11724258000157);
//$nf = trim($ref);

//$num_romaneio = sprintf("%015d", $content['referencia']);
$num_romaneio = sprintf("%015d",12);

$dataEntregue = date('Y-m-d H:i');
$statusRaw = 20;
$status = sprintf("%02d", 46);
$datahora = date('dmYHm', strtotime($dataEntregue));
$codObs = sprintf("%-2s", null);
$obs = sprintf("%-70s", null);
$filler = sprintf("%-6s", null);
$cnpj = sprintf("%014d", '00004291218818');
$codigo_rota = sprintf("%-7s", null);
$meio_transporte = 1;
$tipo_transporte_carga = 1;
$tipo_carga = 1;
$condicao_frete = 'CIF';

$params = array(
  '000' => array(
    4 => 'NOME DA CAIXA POSTAL DO REMETENTE',
    39 => 'NOME DA CAIXA POSTAL DO DESTINATÁRIO',
    74 => $datafull.'OCO'.$datames."1",
  ),
  340 => 'OCORR'.$datames."1",
  341 => $cnpj."VAIMOTO LTDA",
  342 => array(
    $cnpj.$serie.$nf.$status.$datahora.$codObs.$obs.$filler,
    $cnpj.$serie.$nf.$status.$datahora.$codObs.$obs.$filler
  )
);
$proceda->outputOcurren($file, $params);
