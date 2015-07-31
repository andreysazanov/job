<?php 

class Pages {

    /**
     * Постороение дерева
     * @param float $parent id родителя
     * @return array
     */
    public function recursivPages($parent) {
        if($parent==0):
            $where = 'IS NULL';
        else:
            $where = '= '.$parent;
            $this->tab .= '--';
        endif;

        $sql = "SELECT * FROM `pages` WHERE `parent` $where";
        $pages = DB::parse($sql,true);

        if(isset($pages)):
            foreach ($pages as $key => $value):
                    if($parent==0)
                        $this->tab = '';

                    $listPages .= $this->tab.$value['name'].'<br>';
                    $num = Pages::checkPages($value['pid']);
                    if($num>0):
                        $listPages .= Pages::recursivPages($value['pid']);
                    endif;
            endforeach;
        endif;

        $this->tab = substr($this->tab, 2);

        return $listPages;
    }

    /**
     * Проверка на вложенность
     * @param float $parent id родителя
     * @return array
     */
    public function checkPages($parent) {
        $sql = "SELECT COUNT(pid) FROM `pages` WHERE `parent` = $parent";
        $num = DB::parse($sql,false);
        return $num[0];
    }
}

?>