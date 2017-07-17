<?php
class UserController{
    public function __construct()
    {
        
    }
    public function actionRegister()//регистрация пользователя
    {
        $name="";
        $email="";
        $password="";
        $result=false;
        if(isset($_POST['submit']))
        {
        $name=$_POST['username'];
        $email=$_POST['email'];
        $password=$_POST['password'];
        $errors=false;
            if(!User::checkName($name))
            {
                 $errors['name']="Имя должно содержать не менее 2-х символов!";
            }
            if(!User::checkEmail($email))
            {
                $errors['email']="Email не является правильным E-Mail адресом!";
            }
            if(!User::checkPassword($password))
            {
                $errors['password']="Пароль не соответствует системным требования!";
            }
            if(User::checkEmailExist($email))
            {
                 $errors['existemail']="Пользователь с данным email уже зарегистрирован!";
            }
            if($errors==false)
            {
               $result=User::register($email,$password,$name);
            }
        }
        require_once(ROOT.'/View/index.php');  
        return true;       
    }
   
}
?>