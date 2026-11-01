<?php
class AstCommand extends CConsoleCommand {
    public function run($args) {
        if ($ch = @curl_init())  {
            curl_setopt($ch, CURLOPT_URL, "http://mon.ast63.ru/index.php?r=URNYXzC7DM/Ih4vrwLvLdA");

            //return the transfer as a string
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

            // $output contains the output string
            $output = curl_exec($ch);
            //echo $output;

            // close curl resource to free up system resources
            curl_close($ch);              
        }       
        return 0;
    }
}
?>

