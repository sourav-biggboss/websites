<?php
function isValidEmail($email){
   $result=false;
   if(!preg_match('/^[_A-z0-9-]+((\.|\+)[_A-z0-9-]+)*@[A-z0-9-]+(\.[A-z0-9-]+)*(\.[A-z]{2,4})$/',$email))
	   return $result;
	 list($name, $domain)=explode('@',$email);

   if(!checkdnsrr($domain,'MX'))
	  return $result;
   $max_conn_time = 30;
   $sock='';
   $port = 25;
   $max_read_time = 5;
   $users=$name;
   $hosts = array();
   $mxweights = array();
   getmxrr($domain, $hosts, $mxweights);
   $mxs = array_combine($hosts, $mxweights);
   asort($mxs, SORT_NUMERIC);
   $mxs[$domain] = 100;
   $timeout = $max_conn_time / count($mxs);
   while(list($host) = each($mxs)) {
    if($sock = fsockopen($host, $port, $errno, $errstr, (float) $timeout)){
      stream_set_timeout($sock, $max_read_time);
      break;
    }
   }
   if($sock) {
      $reply = fread($sock, 2082);
      preg_match('/^([0-9]{3}) /ims', $reply, $matches);
      $code = isset($matches[1]) ? $matches[1] : '';

      if($code != '220') {
        # MTA gave an error...
        return $result;
      }
      $msg="HELO ".$domain;
      fwrite($sock, $msg."\r\n");
      $reply = fread($sock, 2082);
      $msg="MAIL FROM: <".$name.'@'.$domain.">";
      fwrite($sock, $msg."\r\n");
      $reply = fread($sock, 2082);
      $msg="RCPT TO: <".$name.'@'.$domain.">";
      fwrite($sock, $msg."\r\n");
      $reply = fread($sock, 2082);
      preg_match('/^([0-9]{3}) /ims', $reply, $matches);
      $code = isset($matches[1]) ? $matches[1] : '';

      if($code == '250') {
        $result=true;
      }elseif($code == '451' || $code == '452') {
        $result=true;
      }else{
        $result=false;
      }
      $msg="quit";
      fwrite($sock, $msg."\r\n");
      fclose($sock);

   }
   return $result;
}

function get_spam_score($raw_email)
{
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_URL, 'http://spamcheck.postmarkapp.com/filter');
  curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array('email' => $raw_email,'options'=>'short')));
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
  curl_setopt($ch, CURLOPT_TIMEOUT, 15);

  $response = curl_exec($ch);
  if(empty($response) || curl_error($ch) || curl_getinfo($ch, CURLINFO_HTTP_CODE) !== 200){
      curl_close($ch);
      return FALSE;
  }

  curl_close($ch);

  $score = json_decode($response);

  if ($score->success == TRUE AND is_numeric($score->score))
      return $score->score;
  else
      return FALSE;
}

?>
