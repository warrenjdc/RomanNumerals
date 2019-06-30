<?php

namespace Larowlan\RomanNumeral;

/**
 * Defines a class for generating roman numerals from integers.
 */
class RomanNumeralGenerator {

  /**
   * Generates a roman numeral from an integer.
   *
   * @param int $number
   *   Integer to convert.
   * @param bool $lowerCase
   *   (optional) Pass TRUE to convert to lowercase. Defaults to FALSE.
   *
   * @return string
   *   Roman numeral representing the passed integer.
   */
  public function generate(int $number, bool $lowerCase = FALSE) : string {
    //echo "hello";
    $Moffset = 6;
    if ($number == 0) return "0";
    $r = "IVXLCDM"; // Roman symbols
    if ($lowerCase) $r = strtolower($r);
    $i = abs($number);
    //echo "xx".$number."yy";
    $s = "";

    for ($p = 1; $p <= 5; $p+=2) {
      $d = $i % 10;
      //echo "d=".$d.";";
      $i = floor($i / 10);
      //echo "i=".$i.";";

      switch ($d) {
        case 0:
        case 1:
        case 2:
        case 3:
            //echo '*0-3*;';
            $s = str_pad($s,$d + strlen($s), substr($r, $p-1, 1), STR_PAD_LEFT);
            break;
        case 4:
            //echo '*4*;';
            $s = substr($r, $p-1, 2) . $s;
            break;
        case 5:
        case 6:
        case 7:
        case 8:
            //echo '*5-8*;';
            $s = substr($r, $p, 1) . str_pad($s,$d - 5 + strlen($s), substr($r, $p-1, 1), STR_PAD_LEFT);
            break;
        case 9:
            //echo '*9*;';
            $s = substr($r, $p-1, 1) . substr($r, $p+1, 1) . $s;
            break;
      }
    }

    $s = str_pad($s, $i + strlen($s), substr($r, $Moffset, 1) , STR_PAD_LEFT); // format thousands "M"
    if ($number < 0) $s = "-" . $s; // insert sign if negative (non-standard)
    return $s;
    //return "I";
    //return "Not implemented";
  }

}
