<?php
class User{
    public function __construct()
    {
        
    }
    public static function getCookie()//метод получения безопасных  Cookie
    {
        $cookie="";
        $str="abcdefgijclm1234567890";
        
        for($i=0;$i<=10;$i++)
        {
            $cookie.=substr($str,rand(0,strlen($str)),1);
        }
        return $cookie;
    }
    public static function checkEmail($email)//проверка валидности email
    {
        if (!(filter_var($email, FILTER_VALIDATE_EMAIL) === false))
        {
           return true; 
        }
        else 
        {
            return false;
        }
    }
    public static function checkName($name)//проверка валидности имени
    {
        if (strlen($name)>2)
        {
           return true; 
        }
        else 
        {
            return false;
        }
    }
    public static function checkPassword($password)//проверка валидности пароля
    {
        if (strlen($password)>6)
        {
           return true; 
        }
        else 
        {
            return false;
        }
    }
    public static function checkEmailExist($email)// проверяем нет ли пользователя с введеннім именем
    {
        $pdo=connection::getConnection();
        $stmt = $pdo->prepare('SELECT * FROM users WHERE email=:email');
        $stmt->execute(array('email'=>$email));
        $result = $stmt->fetch();
        if($result) 
        {
            return true;
        }
        else
        { 
            return false;
        }
       
    }
    public static function autorization($email,$password)//проверка авторизованных данных
    {
        $pdo=connection::getConnection();
        $email=htmlspecialchars($email);
        $cookie=User::getCookie();
        $password=md5($password);
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email=:email");
        $stmt->execute(array('email' => $email));
        $row=$stmt->fetch();
        if($stmt && $row["password"]==$password)
        {
            $update = $pdo->prepare("UPDATE users SET cookie=:cookie WHERE email=:email");
            $update->execute(array('email' => $email,'cookie'=>$cookie));
            setcookie("Cookie",$cookie,time()+3600);
            session_start();
            $_SESSION['name']=$row['name'];
            $_SESSION['id']=$row['id'];
            $_SESSION['email']=$row['email'];
            $_SESSION['password']=$row['password'];
            return $_SESSION['name'];
        }
        else
        {
            return false;
        }
    }
     public static function usersCookie($cookie)//проверка авторизованных данных
    {
        $pdo=connection::getConnection();
        $stmt = $pdo->prepare("SELECT id, name, email,password FROM users WHERE cookie=:cookie");
        $stmt->execute(array('cookie' => $cookie));
        $row=$stmt->fetch();
        session_start();
        $_SESSION['name']=$row['name'];
        $_SESSION['id']=$row['id'];
        $_SESSION['email']=$row['email'];
        $_SESSION['password']=$row['password'];
        return $row;
    }
     public static function register($email,$password,$name)
    {
        $password=md5($password);
        $pdo=connection::getConnection();
        $stmt = $pdo->prepare('INSERT INTO users(id,name,email,password) VALUES(NULL,:name,:email,:password)');
        $stmt->execute(array('name' => $name,'email'=>$email,'password'=>$password));
        return true;
    }
   
}
?>