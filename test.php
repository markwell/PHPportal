<?
mysql_connect('localhost','root','');

mysql_select_db("users");

 $query = mysql_query("SELECT * FROM users");

    
    echo $query;

?>
