<?php

namespace PHPProceda;

use PHPProceda\EDI\Parse;
use PHPProceda\EDI\Skeleton;

class Proceda {

  private $_url;
  private $_padrao;

  public function __construct($url, $padrao = '3.1') {
    $this->_url = $url;
    $this->padrao = $padrao;
  }

  public function parse($type = 'array') {
      $parse = new Parse();
      return $parse->loadFile($this->_url);
  }

  public function outputOcurren($path, $params) {
    $skeleton = new Skeleton();
    $fcontent = $skeleton->mountSkeleton($path, $params);
  }
}
