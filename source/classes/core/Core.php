<?php

class Core {

    static function getFile($file, $path="/files/") {
        $filename = $_SERVER['DOCUMENT_ROOT'].$path.$file;
        $handle = fopen($filename, "r");
        $contents = fread($handle, filesize($filename));
        fclose($handle);

        return $contents;
    }

    static function secureStr($text) {
        $text=htmlspecialchars(trim($text),ENT_QUOTES);
        $text = str_replace("\n", "", $text);

        return $text;
    }

    static function preArray($array) {
        echo '<pre>';
        print_r($array);
        echo '</pre>';
    }

    static function uri() {
        $link = explode("/",$_SERVER['REQUEST_URI']);
        return $link;
    }

}

?>
