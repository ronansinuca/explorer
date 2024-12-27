<?php
 require_once('./coinapi.php');
 $_GET['id'] = trim($_GET['id']);
 echo '<h1>Search result:</h1>';
 echo 'Searching for: <a href="./?page=search&amp;id=' . $_GET['id'] . '">' . $_GET['id'] . '</a><br />';
 echo '<h2>Block ID:</h2>';
 $request = getJSONArray('getblockhash', array($_GET['id']))['result'];
 if (isset($request)) {
  echo '<table class="hundred"><tr><td><a href="./?page=block&amp;hash=' . $request . '">' . $request . '</td></tr></table>';
 } else echo 'Found no results.';
 echo '<h2>Block hash:</h2>';
 $request = getJSONArray('getblock', array($_GET['id']))['result'];
 if (isset($request)) {
  echo '<table class="hundred"><tr><td><a href="./?page=block&amp;hash=' . $request['hash'] . '">' . $request['hash'] . '</td></tr></table>';
  /*
  echo '<pre>';
  print_r($request);
  echo '</pre>';
  */
 } else echo 'Found no results.';
 echo '<h2>Transactions:</h2>';
 $request = getJSONArray('getrawtransaction', array($_GET['id'], 1))['result'];
 if (isset($request)) {
  echo '<table class="hundred"><tr><td><a href="./?page=tx&amp;id=' . $request['hash'] . '">' . $request['hash'] . '</td></tr></table>';
  /*
  echo '<pre>';
  print_r($request);
  echo '</pre>';
  */
 } else echo 'Found no results.';
?>