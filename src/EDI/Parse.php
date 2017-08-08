<?php

namespace PHPProceda\EDI;

use PHPProceda\EDI\Interpreter;

class Parse {

  public function loadFile($filepath)
  {
    $result = array();

    if(file_exists($filepath)) {
      $handle = fopen($filepath, 'r');
      if ($handle) {
        $row = 0;
        $res = $_refsOk = [];
        while ( ($line = fgets($handle)) !== false) {
          $_line = $line;
          if ($_line)
          {
            $line = $_line;
            $code = substr($line, 0, 3);
            if ($code == 312) {
              $row++;
            }
            if (in_array($code, ['000', 310, 311])) {
              $result['header'][$code] = $this->parseLine($line);
            } else {
              $result['content'][$row][$code] = $this->parseLine($line);
            }
          }

        }
        fclose($handle);
      }
    }

    return $result;
  }

  public function parseLine($line)
  {
    $interpreter = new Interpreter();
    return $interpreter->processLine($line);
  }
}
