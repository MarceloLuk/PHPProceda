# PHPProceda
Ferramenta para parse de informações de EDI Proceda | NOTFIS OCOREN em php

Esta ferramenta tem por intuido facilitar o parse de informações de arquivos de notas fiscais de transporrtadoras
Utilizando o padrao Proceda 3.1 para realizar o parse e a geração do ocoren basta seguir os exemplos informando os diretorios de arquivos.

$file = __DIR__.'/MODELO-NOTFIS.txt';

$proceda = new Proceda($file);

print_R($proceda->parse());exit;
