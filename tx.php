<?php
 require_once('./coinapi.php');
 require_once('./functions.php');
 $tx = getJSONArray('getrawtransaction', array($_GET['id'], '1'))['result'];
 echo '<h1>Transaction details</h2>';
 if (isset($tx['vin'])) {
  echo '<table class="hundred">';
  echo '<tr><td>Transaction ID:</td><td><a href="./?page=tx&amp;id=' . $tx['txid'] . '">' . $tx['txid'] . '</a></td></tr>';
  echo '<tr><td>Time:</td><td>' . date($GLOBALS['timeFormat'], $tx['time']) . '</td></tr>';
  echo '<tr><td>Size:</td><td>' . humansize($tx['size'], 1024) . 'B</td></tr>';
  echo '<tr><td>Confirmations:</td><td>' . $tx['confirmations'] . '</td></tr>';
  echo '</table>';
  echo '<h1>Transaction</h1>';
  echo '<table class="hundred">';
  echo '<tr><th class="fifty">Input</th><th class="fifty">Output</th></tr>';
  echo '<tr class="top"><td class="fifty">';
  foreach ($tx['vin'] as $vin) {
   if (isset($vin['coinbase'])) {
    echo 'COINBASE:<br /><strong>' . $vin['coinbase'] . '</strong><br />';
   } else {
    echo 'TX ID: <a href="./?page=tx&amp;id=' . $vin['txid'] . '">' . substr($vin['txid'], 0, 30) . '...</a><br />';
    echo 'VOUT: ' . $vin['vout'] . '<br />';
   }
   echo '<br />';
   /*
   echo '<pre>';
   print_r($vin);
   echo '</pre>';
   */
  }
  echo '</td><td class="fifty">';
  foreach ($tx['vout'] as $vout) {
   foreach ($vout['scriptPubKey']['addresses'] as $addr) {
    echo '<strong>' . $addr . '</strong><br />';
   }
   echo $vout['value'] . ' ELI<br /><br />';
   /*
   echo '<pre>';
   print_r($vout);
   echo '</pre>';
   */
  }
  echo '</td></tr>';
  echo '</table>';
 } else {
  echo 'Transaction not found.';
 }
?>