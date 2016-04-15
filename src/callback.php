<?php
require_once './config.php';
require_once './Bot_Class.php';

// インスタンス生成
$line_bot = new Bot_Class($channel_id, $channel_secret, $mid);

// log出力
output_log($line_bot->text);

$line_bot->post_request('なるほど。「%s」と言っておきます。');

// ログ出力
function output_log($log, $name = "text")
{
   if (!is_dir(LOG_PATH)) {
      mkdir(LOG_PATH, 0777);
   }

   $date = date("Ymd");
   $time_stamp = date("Y-m-d H:i:s");
   $output = print_r($log, true);
   error_log("[{$time_stamp}] ".$output.PHP_EOL, 3, LOG_PATH."{$date}_{$name}.log");
}
