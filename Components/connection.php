<?php
/*----Подключение базы данных-----*/
class connection{
    public static function getConnection()
    {
            $parPath=ROOT."/config/database.php";
            $params=include($parPath);
            $host=$params['host'];
            $db=$params['db'];
            $charset=$params['charset'];
            $password=$params['pass'];
            $user=$params['user'];
                  $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
        $opt = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];
    $pdo = new PDO($dsn,$user,$password, $opt);
        return $pdo;
    }
          
}
?>