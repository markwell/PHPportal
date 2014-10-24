<?

// Скрипт проверки


# Соединямся с БД

mysql_connect('localhost','root','');

mysql_select_db("users");


if (isset($_COOKIE['id']) and isset($_COOKIE['hash']))

{   

    $query = mysql_query("SELECT * FROM users WHERE user_id = '".intval($_COOKIE['id'])."' LIMIT 1");

    $userdata = mysql_fetch_assoc($query);
    

    if(($userdata['user_hash'] !== $_COOKIE['hash']) or ($userdata['user_id'] !== $_COOKIE['id']))

    {

        setcookie("id", "", time() - 3600*24*30*12, "/");

        setcookie("hash", "", time() - 3600*24*30*12, "/");

        print "Some error!";

    }

    else

    {

        print "Hello, ".$userdata['user_login'].". All good!";

    }

}

else

{

    print "Please, cookie on!";

}

?>
