<?
// mysql_connect('localhost','root','');

// mysql_select_db("users");

//  $query = mysql_query("SELECT * FROM users");

    
// $headers = apache_request_headers();

// foreach ($headers as $header => $value) {
//     echo "$header: $value <br />\n";
// }
// setcookie('id','0');
//  	echo isset($_COOKIE['id']);

// $db = new PDO('mysql:host=localhost;dbname=users', 'root', '');


// class Config {
//   private $data;
//   private $filePath; 
 
//   public function __construct($filePath) {    
//     $this->data = parse_ini_file($filePath, true);
//     $this->filePath = $filePath;
//   }
 
//   public function getHostName() {
//     echo $this->data['hostName'];

//   }
 
//   public function getUserName() {
//     echo $this->data['userName'];
//   }
 
//   public function getPassword() {
//     echo $this->data['password'];
//   }
// }

// $data = new Config('config.ini');
// $data -> getUserName();
// $data -> getPassword();
// $data -> getHostName();


/*function inverse($x) {
    if (!$x) {
        throw new Exception('Delenie na 0.');
    }
    return 1/$x;
}

try {
    echo inverse(5) . "\n";
    echo inverse(0) . "\n";
} catch (Exception $e) {
    echo 'Exception: ',  $e->getTraceAsString(), "\n";
}

// Продолжение выполнения
echo "Hello World\n";*/
 



/*class Config {
  private $data;
  private $filePath; 
 
  public function __construct($filePath) {
  if (!@file_exists($filePath)) {
    throw new Exception("File $filePath does not exists");
  }
 
  $data = @parse_ini_file($filePath, true);
 
  if ($data === false) {
    throw new Exception("Incorrect file format");
  }
 
  foreach (array ('hostName', 'userName', 'password') as $el) {
    if (!isset($data[$el])) {
      throw new Exception("$el must be defined");
    }
  }
 
  $this->data = $data;
  print_r($data);
}
}

try {
  $conf = new Config('config.ini');
} catch (Exception $e) {
  echo $e->getMessage();
}
*/

# подключаемся к базе данных  
try {  
  $DBH = new PDO("mysql:host=localhost;dbname=users", 'root', '');  
  $DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );  
  $DBH->prepare('SELECT user_login FROM users')->execute();  
}  
catch(PDOException $e) {  
    echo "Houston, we have a problem.";  
    file_put_contents('PDOErrors.txt', $e->getMessage(), FILE_APPEND);  
}

?>
