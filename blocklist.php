<?php
 require_once('./coinapi.php');
 require_once('./functions.php');
 $listCount = 20;
 $pgid = (isset($_GET['id']) ? $_GET['id'] : 1);
 echo '<h2>Network info</h2>';
 $miningInfo = getJSONArray('getmininginfo', '')['result'];
 $totalCoins = getJSONArray('gettxoutsetinfo', '')['result']['total_amount'];
 echo '<table>';
 echo '<tr><td>Difficulty:</td><td>' . round($miningInfo['difficulty'], 5) . '</td></tr>';
 echo '<tr><td>Network hashrate:</td><td>' . humansize($miningInfo['networkhashps'], 1000) . 'H/s</td></tr>';
 echo '<tr><td>Total mined coins:</td><td>' . round($totalCoins) . '</td></tr>';
 echo '</table>';
 echo '<h2>Last mined blocks</h2>';
 $blockCount = getJSONArray('getblockcount', '')['result'];
 $j = $blockCount - (($pgid - 1) * $listCount);
 $k = $j - $listCount + 1;
 if ($j < $blockCount) echo '<span><a href="./?id=' . ($pgid - 1) . '">Newer</a></span>';
 if ($k > 0) echo '<span class="right"><a href="./?id=' . ($pgid + 1) . '">Older</a></span>';
 echo '<br /><br />';
 echo '<table style="width: 100%">';
 echo '<tr><th>Number</th><th>Mined</th><th>Transactions</th><th>Size</th></tr>';
 for ($i = $j; $i >= $k && $i >= 0; $i--) {
  if ($i <= $blockCount) {
   $blockHash = getJSONArray('getblockhash', array($i))['result'];
   $blockData = getJSONArray('getblock', array($blockHash))['result'];
   echo '<tr class="center"><td><a href="./?page=block&hash=' . $blockHash . '">' . $i . '</a></td><td>' . date($GLOBALS['timeFormat'], $blockData['time']) . '</td><td>' . count($blockData['tx']) . '</td><td>' . humansize($blockData['size'], 1024) . 'B</td></tr>';
  }
 }
 echo '</table>';
 echo '<br />';
 if ($j < $blockCount) echo '<span><a href="./?id=' . ($pgid - 1) . '">Newer</a></span>';
 if ($k > 0) echo '<span class="right"><a href="./?id=' . ($pgid + 1) . '">Older</a></span>';
 echo '<br />';
?>