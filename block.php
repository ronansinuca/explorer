<?php
 require_once('./coinapi.php');
 require_once('./functions.php');
 $blockInfo = getJSONArray('getblock', array($_GET['hash']))['result'];
 echo '<h1>Block info</h1>';
 echo '<table class="hundred">';
 echo '<tr><td><strong>Block number:</strong></td><td>' . $blockInfo['height'] . '</td></tr>';
 echo '<tr><td><strong>Hash:</strong></td><td><a href="./?page=block&amp;hash=' . $blockInfo['hash'] . '">' . $blockInfo['hash'] . '</td></tr>';
 echo '<tr><td><strong>Time:</strong></td><td>' . date($GLOBALS['timeFormat'], $blockInfo['time']) . '</td></tr>';
 echo '<tr><td><strong>Size:</strong></td><td>' . humansize($blockInfo['size'], 1024) . 'B</td></tr>';
 echo '<tr><td><strong>Number of confirmations:</strong></td><td>' . $blockInfo['confirmations'] . '</td></tr>';
 echo '<tr><td><strong>Number of transactions:</strong></td><td>' . count($blockInfo['tx']) . '</td></tr>';
 echo '<tr><td><strong>Difficulty:</strong></td><td>' . $blockInfo['difficulty'] . '</td></tr>';
 echo '<tr><td><strong>Nonce:</strong></td><td>' . $blockInfo['nonce'] . '</td></tr>';
 echo '<tr><td><strong>Chainwork:</strong></td><td>' . $blockInfo['chainwork'] . '</td></tr>';
 if (isset($blockInfo['previousblockhash'])) echo '<tr><td><strong>Previous block hash:</strong></td><td><a href="./?page=block&amp;hash=' . $blockInfo['previousblockhash'] . '">' . $blockInfo['previousblockhash'] . '</td></tr>';
 if (isset($blockInfo['nextblockhash'])) echo '<tr><td><strong>Next block hash:</strong></td><td><a href="./?page=block&amp;hash=' . $blockInfo['nextblockhash'] . '">' . $blockInfo['nextblockhash'] . '</td></tr>';
 echo '</table>';
 echo '<h1>Transactions</h1>';
 echo '<table class="hundred">';
 foreach ($blockInfo['tx'] as $tx) {
  echo '<tr><td><a href="./?page=tx&amp;id=' . $tx . '">' . $tx . '</a></td></tr>';
 }
 echo '</table>';
?>