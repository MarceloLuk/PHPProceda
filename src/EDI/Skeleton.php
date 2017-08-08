<?php

namespace PHPProceda\EDI;

class Skeleton {

  public function mountSkeleton($filepath, $params)
  {
    $fcontent = '000'.$params['000'][4].'                                                                          '."\n";
    $fcontent = substr_replace($fcontent, $params['000'][39], 38, 0);
    $fcontent = substr_replace($fcontent, $params['000'][74], 75, 0);
    $fcontent .= '340'.$params[340]."\n";
    $fcontent .= '341'.$params[341]."\n";

    foreach($params[342] as $line) {
      $fcontent .= '342'.$line."\n";
    }

    if (!file_exists($filepath)) {
      file_put_contents($filepath, $fcontent);
    }
  }
}
