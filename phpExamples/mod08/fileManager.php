<?php
namespace com\myapp\util\pkg1;

class fileManager {
    static function hello() {
        print '大家好，由fileManager類別的靜態方法hello()送出';
    }
    function helloAgain() {
        print '大家好，由fileManager類別的非靜態方法helloAgain()送出';
    }
}
?>

static : 類別名稱::靜態方式名稱();
例:
fileManager::hello();

non-static : 物件名稱->非靜態方式名稱();
例:
$fm = new fileManager();
$fm->helloAgain();
