<?
    //******************404 Error*****************//
    foreach($path as $url) {
        $uri = explode("/",$_SERVER['REQUEST_URI']);
        $link = explode("/",$url['url']);
        if($uri[1]==$link[1])
            $error = 'no';
    }
    if($error!='no'):
        header("Status: 404 Not Found");
        echo 'Увы, такой страницы нет';
        exit();
    endif;
    //******************404 Error*****************//
?>
