<?php

class Main {   
	public function load(){
			return true;
	}

	public function reference1(){
			// Берем файл
	    $text = Core::getFile('data1.txt');

			$bbClass = new Bb();
			$bbClass->__construct($text);
			// Данные bb
			$data_array = $bbClass->parse('data');
			// Описание bb
			$descrition_array = $bbClass->parse('description_elem');

			//Вывод массивов
			Core::preArray($data_array);
			Core::preArray($descrition_array);
	}

	public function reference2(){
			// Берем файл
	    $text = Core::getFile('data2.txt');
	    // Массив ключей
	    $request = array('get','post','url');
	    //Массив на выходе
	    $array = Preg::generateArray($request, $text);
			//Вывод массива
			Core::preArray($array);
	}

	public function reference3(){
			//Запуска дерева страниц
			echo Pages::recursivPages(0);
	}

	public function reference4() {
		
		echo $sql = "SELECT (p1.name) FROM `pages` AS `p1`
		INNER JOIN `pages` AS `p2` ON p1.parent = p2.pid
		INNER JOIN `pages` AS `p3` ON p2.parent = p3.pid
		LEFT JOIN `pages` AS `p4` on p4.parent = p1.pid
		WHERE p3.parent IS NULL AND p4.pid IS NULL";
    $data = DB::parse($sql,true);
    Core::preArray($data);
	}

	public function reference5() {
		echo $sql = "SELECT * FROM `pages` AS `p1` 
		WHERE p1.parent IS NULL AND p1.pid IN (
		    SELECT p2.parent FROM `pages` AS `p2` 
		    WHERE p2.parent IS NOT NULL 
		    GROUP BY p2.parent HAVING COUNT(pid)>=3
		)";
		$data = DB::parse($sql,true);
		Core::preArray($data);
	}
}

?>

