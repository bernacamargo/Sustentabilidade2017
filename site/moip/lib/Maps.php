<?php
/**
 * Obtendo Latitude e Longitude via Google Maps Api V2
 * @author Roni -  roni@bananadev.com.br
 */
class Maps {
  //chave publica de acesso
  private static $googleKey = 'AIzaSyAilryqB0kQndDIgbYuNo2oXFU826PUh8I';

  static function loadUrl($url){
    try {
        $ch = curl_init($url);

          if (FALSE === $ch)
              throw new Exception('failed to initialize');

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        $content = curl_exec($ch);

        if (FALSE === $content)
          throw new Exception(curl_error($ch), curl_errno($ch));

    } catch(Exception $e) {

        trigger_error(sprintf(
          'Curl failed with error #%d: %s',
          $e->getCode(), $e->getMessage()),
          E_USER_ERROR);

    }

  }
  static function getLocal($address) {
    $url = 'https://maps.googleapis.com/maps/api/geocode/json?address='. urlencode($address) .'&key='.self::$googleKey;    
    $result = self::loadUrl($url);
    $json = json_decode($result);
    if($json->{'status'} == 'OK') {        
      return $json->{'results'}[0]->{'geometry'}->{'location'};  
    }else{
      return false;
    }
    
  }
}