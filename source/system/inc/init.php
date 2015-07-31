<?

    //connects to the database
    require_once ("source/system/db/conf.php");
    //class to define the function
    require_once ("source/classes/core/Route.php");
    require_once ("source/classes/core/DB.php");
    require_once ("source/classes/core/Core.php");
    require_once ("source/classes/core/Path.php");
    require_once ("source/classes/core/Bb.php");
    require_once ("source/classes/core/Preg.php");
    require_once ("source/classes/core/Pages.php");
    //classes and functions
    require_once ("source/system/inc/route.php");
    require_once ("source/system/inc/route404.php");
    //require_once ("source/system/inc/layout.php");
    //define class
    $RouteClass = new Route();
    //start route
    $RouteClass->load($path);
    //include skeleton
    require_once ("source/system/inc/skeleton.php");
?>
