<?php

// Страница регситрации нового пользователя


# Соединямся с БД

mysql_connect('localhost','root','');

mysql_select_db("users");


if(isset($_POST['submit'])) 

{
    $err = array();


    if(!preg_match("/^[a-zA-Z0-9]+$/",$_POST['login']))

    {

        $err[] = "Username can only consist of letters of the alphabet and numbers";

    }

    

    if(strlen($_POST['login']) < 3 or strlen($_POST['login']) > 30)

    {

        $err[] = "Username must be at least 3 characters and no more than 30";

    }

    

    # проверяем, не сущестует ли пользователя с таким именем

    $query = mysql_query("SELECT COUNT(user_id) FROM users WHERE user_login='".mysql_real_escape_string($_POST['login'])."'");

    if(mysql_result($query, 0) > 0)

    {

        $err[] = "A user with this username already exists in the database";

    }

    $password = md5($_POST['password']);
    $repeat = md5($_POST['repass']);
    if($password != $repeat)
    {

        $err[] = "Passwords do not match! Please try again!";

    }
    

    # Если нет ошибок, то добавляем в БД нового пользователя

    if(count($err) == 0)

    {

        
        $login = $_POST['login'];

        

        # Убераем лишние пробелы и делаем двойное шифрование

        $password = md5(md5(trim($_POST['password'])));

        

        mysql_query("INSERT INTO users SET user_login='".$login."', user_password='".$password."'");

        header("Location: login.html"); exit();

    }

    else

    {

        print "<b>When registering the following errors occurred:</b><br>";

        foreach($err AS $error)

        {

            print $error."<br>";

        }

    }

}
?>