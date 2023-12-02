<?php

if($_SERVER['SERVER_NAME']=="jackandrose.test"){
    // datos de configuracion
    define('DBNAME','jackandrose_db');
    define('DBHOST','localhost');
    define('DBUSER','root');
    define('DBPASS','');
    define('DBDRIVER','');

    define('ROOT','http://jackandrose.test/public/');

    define('DEBUG',true);
}else{
    // datos de configuracion
    define('DBNAME','oop_db');
    define('DBHOST','localhost');
    define('DBUSER','root');
    define('DBPASS','');
    define('DBDRIVER','');

    define('ROOT','https://jackandrose.test/public/');


}

define("APP_NAME",'El matrimonio perfecto');
define("APP_DESC",'El mejor dia de tu vida');