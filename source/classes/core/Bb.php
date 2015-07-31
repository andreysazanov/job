<?php 

class Bb{
    /**
     * Сonstruct
     */
    public function __construct($text = null) {        
        $this->text = $text;
    }

    /**
     * Парсим и создаем массивы
     * @param string $text файл с данными
     * @return array
     */
    public function getTags($text) {
        preg_match_all('|\[\/(.*?)\]|i', $text, $m);

        return $m[1];
    }

    /**
     * Парсим и создаем массивы
     * @param string $elem имя необходимого значения
     * @return array
     */
    public function parse($elem="data"){
        $text = Core::secureStr($this->text);
        $bbcode = bb::getTags($text);

        //Массив данных
        foreach ($bbcode as $key => $value):
            preg_match('|\['.$value.'(.*?)\](.*?)\[\/'.$value.'\]|i', $text, $t);
            
            if(!empty($t[1][0]))
                $str['description_elem'][$value] = substr($t[1], 1);

            if(!empty($t[2][0]))
                $str['data'][$value] = $t[2];
            
        endforeach;

        return $str[ $elem ];
    }
}

?>