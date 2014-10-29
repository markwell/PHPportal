<?

// Страница авторизации



# Функция для генерации случайной строки
$error = "";
function generateCode($length=6) {

    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIFJKLMNOPRQSTUVWXYZ0123456789";

    $code = "";

    $clen = strlen($chars) - 1;  
    while (strlen($code) < $length) {

            $code .= $chars[mt_rand(0,$clen)];  
    }

    return $code;

}



# Соединямся с БД

try {  
  $DBH = new PDO("mysql:host=localhost;dbname=users", 'root', '');  
  $DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );  
  // $DBH->prepare('SELECT user_login FROM users')->execute();  
}  
catch(PDOException $e) {  
    echo "Houston, we have a problem.";  
    file_put_contents('PDOErrors.txt', $e->getMessage(), FILE_APPEND);  
}


if(isset($_POST['submit']))

{

    # Вытаскиваем из БД запись, у которой логин равняеться введенному

    $query = mysql_query("SELECT user_id, user_password FROM users WHERE user_login='".$_POST['login']."' LIMIT 1");

    $data = mysql_fetch_assoc($query);

    

    # Соавниваем пароли

    if($data['user_password'] === md5(md5($_POST['password'])))

    {

        # Генерируем случайное число и шифруем его

        $hash = md5(generateCode(10));

        

        # Записываем в БД новый хеш авторизации 

        mysql_query("UPDATE users SET user_hash='".$hash."' WHERE user_id='".$data['user_id']."'");

        

        # Ставим куки

        setcookie("id", $data['user_id'], time()+60*60*24*30);

        setcookie("hash", $hash, time()+60*60*24*30);

        

        # Переадресовываем браузер на страницу проверки нашего скрипта

        header("Location: check.php"); 
        exit();

    }

    else

    {
        $error = "Неправильный пароль";

    }

}
        include "login.html";
?>