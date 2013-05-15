<?php
error_reporting(0);
// A SCRIPT PROVIDED BY CSL////
$ones = array(
 "",
 " One",
 " Two",
 " Three",
 " Four",
 " Five",
 " Six",
 " Seven",
 " Eight",
 " Nine",
 " Ten",
 " Eleven",
 " Twelve",
 " Thirteen",
 " Fourteen",
 " Fifteen",
 " Sixteen",
 " Seventeen",
 " Eighteen",
 " Nineteen"
);
$tens = array(
 "",
 "",
 " Twenty",
 " Thirty",
 " Forty",
 " Fifty",
 " Sixty",
 " Seventy",
 " Eighty",
 " Ninety"
);
$triplets = array(
 "",
 " Thousand",
 " Million",
 " Billion",
 " Trillion",
 " Quadrillion",
 " Quintillion",
 " Sextillion",
 " Septillion",
 " Octillion",
 " Nonillion"
);
 // recursive fn, converts three digits per pass
 function convertTri($num, $tri) {
  global $ones, $tens, $triplets;
  // chunk the number, ...rxyy
  $r = (int) ($num / 1000);
  $x = ($num / 100) % 10;
  $y = $num % 100;
  // init the output string
  $str = "";
  // do hundreds
  if ($x > 0)
   $str = $ones[$x] . " hundred";
  // do ones and tens
  if ($y < 20)
   $str .= $ones[$y];
  else
   $str .= $tens[(int) ($y / 10)] . $ones[$y % 10];
  // add triplet modifier only if there
  // is some output to be modified...
  if ($str != "")
   $str .= $triplets[$tri];
  // continue recursing?
  if ($r > 0)
   return convertTri($r, $tri+1).$str;
  else
   return $str;
 }
// returns the number as an anglicized string
function convertNum($num) {
 $num = (int) $num;    // make sure it's an integer
 if ($num < 0)
  return "negative".convertTri(-$num, 0);
 if ($num == 0)
  return "zero";
 return convertTri($num, 0);
}
?>
<?php
  function randThousand() {
   return mt_rand(0,999);
  }
 // Returns an integer in -10^9 .. 10^9
 // with log distribution
 function makeLogRand() {
  $sign = mt_rand(0,1)*2 - 1;
  $val = randThousand() * 1000000
   + randThousand() * 1000
   + randThousand();
  $scale = mt_rand(-9,0);
  return $sign * (int) ($val * pow(10.0, $scale));
 }
// example of usage
for ($i = 0; $i < 20; $i++) {
 $num = makeLogRand();
 //echo "<br>$num: ".convertNum($num);
}
?>