<?php
//xss対策　ユーザーが入力したデータをechoで表示させるときに使う。
function h($str){
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}