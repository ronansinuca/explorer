<?php
 function humansize($bytes, $devider) {
  $type = array('', 'k', 'M', 'G', 'T', 'P', 'E', 'Z', 'Y');
  $i = 0;
  while ($bytes >= $devider) {
   $bytes /= $devider;
   $i++;
  }
  return round($bytes, 2) . ' ' . $type[$i];
 }
?>