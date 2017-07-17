 <?php
class AjaxController{
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
                        echo "200";
                    }
                    else
                    {
                        $err=json_encode($errors);
                        echo $err;
                    }
            }
       return true;       
    }
        public function actionAutorization()//авторизация пользователя
    {
        $email=$_POST['email'];
        $password=$_POST['password'];
        $name=User::autorization($email,$password);
        if($name)
        {
            echo $name;
        }
        else
        {
            echo 401;
        }
        return true;       
    }
    public function actionTask()
    {
        
        session_start();
        $user_id=$_SESSION["id"];
        $task=$_POST['textarea'];
        $status=0;
        if(!empty($_POST) || !empty($_FILES))
        {
            $width=320;
            $height=240;
            $tmpName=$_FILES["photo"]["tmp_name"];
            $type=$_FILES["photo"]["type"];
            $fileName=trim(mb_strtolower($_FILES["photo"]["name"]));
            $path="/beejee/image/$fileName";
            File::sizeFileRecord($width,$height,$tmpName,$type,$fileName); 
            
        }
        echo Tasks::addTask($task,$status,$user_id,$path);
        return true;
    }
     public function actionStatus()//изменение статуса
    {
         $id=$_POST['id'];
         $status=$_POST['status'];
         Tasks::changeStatus($status,$id);
         var_dump($_POST);
         return true;
    }
    public function actionEdit()//редактирование задачи
    {
        $id=$_POST['id'];
        $tasks=$_POST['text'];
        Tasks::changeText($tasks,$id);
        return true;
    }
    public function actionSearch()//поиск задачи по имени и статусу выполнения
    {
        if(isset($_POST['search'])){
            $search=$_POST['search'];
            $status=$_POST['status'];
            $arr=Tasks::searchTasks($search,$status);
            $count=3;
            foreach($arr as $key=>$value){
                 $countPage=ceil($value['count']/3);
                 $string=' <div class="one">
                    <div class="col-sm-3"><img src="'.$value["path"].'" alt="нет изображения"></div>
                    <div class="col-sm-8">
                        <div class="user"><small class="text-muted">'.$value["name"].'</small></div>
                        <div class="text">
                            '.$value["tasks"].'
                        </div>
                    </div>';
                    if($value["status"]==1){
                        $string.='<div class="col-sm-1">
                            <input type="checkbox" checked disabled>
                        </div>';
                    }
                    else
                    {
                        $string.='<div class="col-sm-1">
                                <input type="checkbox"  disabled>
                            </div>';
                    }
                    $string.='<br>
                        <br>
                        <div class=" col-sm-12">
                            <hr>
                        </div>
                    </div>';          
                  echo $string; 
            }
            
        }
        return true;
    }
     public function actionExit()//Выход пользователя с приложения
    {
        if(isset($_POST["exit"]))
        {
            session_start();
            session_destroy();
            setcookie("Cookie",$cookie,time()-3600);
            echo true;
        }
        return true;       
    }
}
?>