<?php

namespace App\Utils;

class Utils {
  
  public static function matrixElementsToObject($matrix) {
    for ($i=0; $i<count($matrix); $i++) {
      $matrix[$i] = self::arrayToObject($matrix[$i]);
    }
    return $matrix;
  }

  public static function arrayToObject($array) { 
    return (object) $array; 
  }
}