<?php
class Route {
    //define in route
	public function load($route){
	    $data['true'] = '1';
	    foreach($route as $route) {
	        $request_uri = $_SERVER['REQUEST_URI'];
          $multiLink = strrpos($route['url'],"*");


            unset($uri);
            unset($link);
            if($multiLink>0) {
	            $uri = explode("/",$_SERVER['REQUEST_URI']);
              $link = explode("/",$route['url']);

                $c_u = count($uri)-1;
                $cou = count($link);
                unset($count);
                foreach ($link as $ur):
                        if($ur=="*"):
                            $num = $count;
                        endif;
                    $count++;
                endforeach;

                for($i=$num;$i<=$c_u;$i++):
                    unset($uri[ $i ]);
                    unset($link[ $i ]);
                endfor;

                $uriR = $uri;
                $linkR = $link;
            }
            else {
                $uriR = $request_uri;
                $linkR = $route['url'];
            }

	        if($uriR==$linkR) {
                if($route['class']) {
	                $inc = explode("::", $route['class']);
	                //learn how to connect the class
	                $class = $inc[0];
	                //learn how to connect the function
	                $function = $inc[1];
	            }

	            //learn how to connect the template
	            $tpl = 'source/templates/'.$route['type'].'/'.$route['tpl'].'.tpl';

	            if(isset($class)):
                    require_once ('source/classes/site/'.$class.'.php');
                    $class = new $class();
                    $data = $class->$function();
                endif;

                if($route['type']=="ajax") {
                    echo $data;
                    exit();
                }
                elseif($route['type']=="csv") {
                    echo $data;
                    exit();
                }
                else {
                    //connect template
                    include_once ($tpl);
                    break;
                }

	        }
	    }
	    return $data;
	}
	//define in zone
	public function layout($zone, $layout){
        foreach($layout as $name) {
            if($name['zone']==$zone) {
                if($name['class']) {
                    $inc = explode("::", $name['class']);
                    //learn how to connect the class
	                $class = $inc[0];
	                //learn how to connect the function
	                $function = $inc[1];

	                //learn how to connect the template
	                $tpl = 'source/templates/'.$name['type'].'/'.$name['tpl'].'.tpl';

                    if($class):
                        require_once ('source/classes/site/'.$class.'.php');
                        $class = new $class();
                        $data = $class->$function();
                    endif;


                    //connect template
                    include_once ($tpl);
                }
            }

        }
        return $data;
	}
}
?>
