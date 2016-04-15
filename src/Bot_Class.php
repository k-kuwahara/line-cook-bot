<?php

class Bot_Class
{
   const API_URL    = 'https://trialbot-api.line.me/v1/events';
   const TO_CHANNEL = '1383378250';
   const EVENT_TYPE = '138311608800106203';

   public $res_channel_id;
   public $res_channel_secret;
   public $res_mid;
   public $headers;
   public $text;
   public $from;

   public function __construct($channel_id = '', $channel_secret = '', $mid = '')
   {
      $this->res_channel_id     = $channel_id;
      $this->res_channel_secret = $channel_secret;
      $this->res_mid            = $mid;

      $this->headers = array(
         'Content-Type: application/json; charset=UTF-8',
         'X-Line-ChannelID: '. $this->res_channel_id,
         'X-Line-ChannelSecret: ' . $this->res_channel_secret,
         'X-Line-Trusted-User-With-ACL: ' . $this->res_mid
      );

      $contents   = $this->get_contents();
      $this->text = $contents->text;
      $this->from = $contents->from;
  }

   public function get_contents()
   {
      $json = json_decode(file_get_contents('php://input'));
      $ret_contents = $json->result{0}->content;

      return $ret_contents;
   }

   public function post_request($message = '')
   {
      if ($message !== '') {
         $text = sprintf($message, $this->text);
      } else {
         $text = $this->text;
      }

      $content = array(
         'contentType' => 1,
         'toType'      => 1,
         'text'        => $text
      );

      $post_data = array(
         'to'        => array($this->from),
         'toChannel' => self::TO_CHANNEL,
         'eventType' => self::EVENT_TYPE,
         'content'   => $content
     );

      $this->send_message($post_data);
   }

   public function send_message($post_data)
   {
      $curl = curl_init(self::API_URL);
      curl_setopt($curl, CURLOPT_POST, true);
      curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($post_data));
      curl_setopt($curl, CURLOPT_HTTPHEADER, $this->headers);
      $result = curl_exec($curl);
      curl_close($curl);

      return $result;
   }
}
