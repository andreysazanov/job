<?php

class DB
{

    public static function select($sql,$st,$page)
    {
        if($page!=0):
            //если существует пагинация
            $num = '5';
            $ro = mysql_query($sql);
            $posts = mysql_num_rows($ro);
            $total = (($posts - 1) / $num) + 1;
            $total =  intval($total);
            $page = intval($page);
            //if(empty($page) or $page < 0) $page = 1;
            if($page > $total) $page = $total;
            $start = $page * $num - $num;
            $sql = $sql." LIMIT $start, $num";

            $result = mysql_query($sql);
            $myrow = mysql_fetch_array($result);

            do {
                if($st==false):
                    $data['bd'][] = $myrow;
                    break;
                else:
                    $data['bd'][] = $myrow;
                endif;
            }
            while($myrow = mysql_fetch_array($result));

            $link = explode("page/", $_SERVER['REQUEST_URI']);
            $alias = $link[0];

            if ($page != 1) $pervpage = '<a href='.$alias.'page/1/><span>Первая</span></a><a href='.$alias.'page/'. ($page - 1) .'/><span>Предыдущая</span></a>';
            if ($page != $total) $nextpage = '<a href='.$alias.'page/'. ($page + 1) .'/><span>Следующая</span></a><a href='.$alias.'page/' .$total. '/><span>Последняя</span></a>';


            for($i=5;  $i>=1; $i--):
                if($page - $i > 0) $pageleft .= '<a href='.$alias.'page/'. ($page - $i) .'/><span>'. ($page - $i) .'</span></a>';
            endfor;

            for($i=1;  $i<=5; $i++):
                if($page + $i <= $total) $pageright .= '<a href='.$alias.'page/'. ($page + $i) .'/><span>'. ($page + $i) .'</span></a>';
            endfor;

            if ($total > 1):
                $data['pagination'] = $pervpage.$pageleft.'<strong><span>'.$page.'</span></strong>'.$pageright.$nextpage;
            endif;

        else:
            $result = mysql_query($sql);
            $myrow = mysql_fetch_array($result);

            do {
                if($st==false):
                    $data = $myrow;
                    break;
                else:
                    $data[] = $myrow;
                endif;
            }
            while($myrow = mysql_fetch_array($result));
        endif;

        return $data;
    }

    public static function count($sql)
    {
        $result = mysql_query($sql);
        $myrow = mysql_fetch_array($result);

        $data = $myrow[0];
        return $data;
    }

    public static function update($sql)
    {
        $data = mysql_query($sql);

        return $data;
    }

    public function parse($sql,$st,$page)
    {
        preg_match("/^SELECT|^SHOW|^SELECT COUNT|^DESCRIBE|^EXPLAIN|^DELETE|^INSERT|^REPLACE|^UPDATE/",strtoupper(substr(ltrim($sql),0,10)),$a);

        if($a[0]=="SELECT")
            return self::select($sql,$st,$page);
        if($a[0]=="UPDATE" OR $a[0]=="INSERT" OR $a[0]=="DELETE")
            return self::update($sql);

    }

}

?>
