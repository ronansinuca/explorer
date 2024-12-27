<?php
 function getJSONArray($method, $params) {
  return json_decode(getJSON($method, $params), true);
 }
 function getJSON($method, $params) {
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, 'http://' . $GLOBALS['ip'] . ':' . $GLOBALS['port']);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  $paramString = '';
  if ($params != '') {
   foreach ($params as $v) {
    $paramString .= (is_numeric($v) || $v == '' || $v == null ? $v : '"' . $v . '"') . ', ';
   }
   $paramString = substr($paramString, 0, strlen($paramString) - 2);
  }
  $post = '{"jsonrpc":"1.0", "id":"' . $method  . '", "method":"' . $method  . '", "params":[' . $paramString . '] }';
  //echo $post;
  curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
  curl_setopt($ch, CURLOPT_POST, 1);
  curl_setopt($ch, CURLOPT_USERPWD, $GLOBALS['user'] . ':' . $GLOBALS['pass']);
  $headers = array();
  $headers[] = 'Content-Type: text/plain';
  curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
  $result = curl_exec($ch);
  if (curl_errno($ch)) return 'Error:' . curl_error($ch);
  curl_close ($ch);
  return $result;
 }
?>