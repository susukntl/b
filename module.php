<?php

include('config.php');

$bchindex = "http://affi.cryptoplanets.org/bcheden/index.php";
$bchajax = "http://affi.cryptoplanets.org/bcheden/ajax.php";

$headers = array();
$headers[] = $User_Agent;


function loginbch($bchindex, $headers, $wallet_bch){
         $ch = curl_init();
         curl_setopt($ch, CURLOPT_URL, $bchindex);
         curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
         curl_setopt($ch, CURLOPT_MAXREDIRS, 5);
         curl_setopt($ch, CURLOPT_POST, 1);
         curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
         curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
         $data = "wallet=".$wallet_bch."&refby=&botprotection=im not&submit=Login&submit_address=1";
         curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
         curl_setopt($ch, CURLOPT_COOKIEJAR, 'Session/session_bch.txt');
         curl_setopt($ch, CURLOPT_COOKIEFILE, 'Session/session_bch.txt');
         $result = curl_exec($ch);
         $info = curl_getinfo($ch);
         curl_close($ch);
         $info_code = $info["http_code"];
         if ($info_code == 200){
                 if (strpos($result,"If you need a new BCHEDEN Address you can generate your own there")){
                        echo "\n\033[1;31mLogin ERROr\n";
                        sleep(4);
                        exit();
                }
                else{
                        $one = explode('<div class="widget-int num-count"><font size="6" color="#fffd9e">', $result);
                        $two = explode('</font></div>', $one[1]);
                        $pr = "$two[0]";
                        sleep(2);
                        echo "\033[1;32m\nBCHEDEN Ballance\033[1;0m       : ".$pr;
                }
        }
        else{
                loginbch($bchindex, $headers, $wallet_bch);
        }
}


function bchreset_dialy($headers, $bchajax){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $bchajax);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_MAXREDIRS, 5);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $data['reset_daily_bonus_button'] = '1';
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_COOKIEFILE, 'Session/session_bch.txt');
        curl_exec($ch);
        curl_close($ch);
}
function bchdialy_claim($headers, $bchajax){
        bchreset_dialy($headers, $bchajax);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $bchajax);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_MAXREDIRS, 5);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $data['confirm_exploaration_dailybonus_claim'] = '1';
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_COOKIEFILE, 'Session/session_bch.txt');
        $result = curl_exec($ch);
        $info = curl_getinfo($ch);
        curl_close($ch);
        $info_code = $info["http_code"];
        if ($info_code == 200){
                echo "\033[1;32mDialy Claim \033[1;0m: ".$result."\n";
        }
        else{
                bchdialy_claim($headers, $bchajax);
       }
}

function bchclaim($headers, $bchajax, $i){
        bchreset_claim($headers, $bchajax, $i);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $bchajax);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_MAXREDIRS, 5);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $data['confirm_exploaration_point_claim'] = $i;
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_COOKIEFILE, 'Session/session_bch.txt');
        $result = curl_exec($ch);
        $info = curl_getinfo($ch);
        curl_close($ch);
        $info_code = $info["http_code"];
        if ($info_code == 200){
                global $ballbch;
                $ballbch = $result;
        }

}
function bchreset_claim($headers, $bchajax, $i){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $bchajax);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_MAXREDIRS, 5);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $data['reset_contest_button'] = $i;
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_COOKIEFILE, 'Session/session_bch.txt');
        curl_exec($ch);
        curl_close($ch);
}
function bchball($headers, $bchindex){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $bchindex);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_MAXREDIRS, 5);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_COOKIEFILE, 'Session/session_bch.txt');
        $result = curl_exec($ch);
        curl_close($ch);
        $one = explode('<div class="widget-int num-count"><font size="6" color="#fffd9e">', $result);
        $two = explode('</font></div>', $one[1]);
        global $ballancebch;
        $pr = "$two[0]\n";
        $ballancebch = $pr;
}

?>
