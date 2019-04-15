<?php
include('module.php');



$credit = "\033[1;30m[ \033[1;36m Edited By:

 ██▓███   ▄▄▄     ▄▄▄█████▓ ██▀███   ██▓ ▄████▄   ██ ▄█▀
▓██░  ██▒▒████▄   ▓  ██▒ ▓▒▓██ ▒ ██▒▓██▒▒██▀ ▀█   ██▄█▒ 
▓██░ ██▓▒▒██  ▀█▄ ▒ ▓██░ ▒░▓██ ░▄█ ▒▒██▒▒▓█    ▄ ▓███▄░ 
▒██▄█▓▒ ▒░██▄▄▄▄██░ ▓██▓ ░ ▒██▀▀█▄  ░██░▒▓▓▄ ▄██▒▓██ █▄ 
▒██▒ ░  ░ ▓█   ▓██▒ ▒██▒ ░ ░██▓ ▒██▒░██░▒ ▓███▀ ░▒██▒ █▄
▒▓▒░ ░  ░ ▒▒   ▓▒█░ ▒ ░░   ░ ▒▓ ░▒▓░░▓  ░ ░▒ ▒  ░▒ ▒▒ ▓▒
░▒ ░       ▒   ▒▒ ░   ░      ░▒ ░ ▒░ ▒ ░  ░  ▒   ░ ░▒ ▒░
░░         ░   ▒    ░        ░░   ░  ▒ ░░        ░ ░░ ░ 
               ░  ░           ░      ░  ░ ░      ░  ░   
                                        ░
\033[1;33mBot Nuyul APK Bocah Edan";


if (!file_exists('Session')) {
    mkdir('Session', 0777, true);
}
date_default_timezone_set('Asia/Jakarta');
sleep(2);
system("clear");
echo $credit;
sleep(3);
echo "\n\n\033[1;36mMencoba Untuk Masuk";
loginbch($bchindex, $headers, $wallet_bch);
echo "\n\nMengambil Hadiah Harian\n";
bchdialy_claim($headers, $bchajax);
$i = 0;
$a = 0;
echo "\n\n\n\033[1;0m[",date('H:i:s'),"] Claim otomatis.............!\n";
while(True){
     $i++;
     $a++;
     if ($i == 6){
       $i = 1;
     }
     if ($a == 4){
       $a = 1;
     }
     bchclaim($headers, $bchajax, $i);
     bchball($headers, $bchindex);
     if ($ballbch == 0){sleep(1);}
     else{
          echo "\033[1;32mClaim\033[1;0m : ".$ballbch."\033[1;30m ||\033[1;32m BCHEDEN Ballance\033[1;0m       : ".$ballancebch;
     }
}

?>
