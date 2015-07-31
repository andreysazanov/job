<?php 

class Preg {

    /**
     * Генерация массив по ключам
     * @param array $request имя необходимого значения
     * @param string $str строка из файла
     * @return array
     */
    public function generateArray($request, $str){
        $text = Core::secureStr($str);

        foreach ($request as $key => $value):
            preg_match('/'.$value.':(.*)/i', $text, $matches);
            $array[$value] = $matches[1];
        endforeach;

        return $array;
    }
}

?>