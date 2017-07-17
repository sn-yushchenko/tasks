 <?php
class ShowController{
     public function __construct()
    {
                
    }
    public function actionIndex()//вход на сайт
    {
        if(isset($_COOKIE["Cookie"]))
            {
                $user=User::usersCookie($_COOKIE["Cookie"]);
                $user_name=$user['name'];
                $user_id=$user['id'];
                $check=0;
                require_once(ROOT.'/View/index.php');
            }
            else
            {
                $user_name="Гость";
                $user_id="";
                $check=1;
                require_once(ROOT.'/View/index.php');
            }
          
        return true;
    }
    public function actionTask()//подключение вида добавления задач
    { 
         session_start();
         if(isset($_SESSION["name"]))
            {
                $name=$_SESSION["name"];
                $email=$_SESSION["email"];
                require_once(ROOT.'/View/addtask.php');
            }
            else
            {
                header("Location: http://localhost/beejee/");
            }
          
        return true;
    }
    public function actionAdmin()//админка
    { 
        $arr=Tasks::allTasks();
        session_start();
        if($_SESSION["name"]=="admin" && $_SESSION["password"]==md5("123"))
        {
            require_once(ROOT.'/View/admin.php');
        }
        else
        {
            header("Location: http://localhost/beejee/"); 
        }
        return true;
    }
     public function actionAll()//просмотр всех задач
    { 
         session_start();
         if(isset($_SESSION["name"]))
         {
             $count=3;
             $countPage=ceil(Tasks::Count()/3);
             $countrecord=Tasks::Count();

             if(!isset($_POST['search']))
             { 
                 if(empty($_GET))
                 {
                     $item=0;
                     $arr=Tasks::Pagination($item,$count);
                     require_once(ROOT.'/View/alltask.php');
                 }
                 else
                 {
                     $item=$_GET['page']*$count-$count;
                     $arr=Tasks::Pagination($item,$count);
                     require_once(ROOT.'/View/alltask.php');
                 }
             }
             else
             {
                 require_once(ROOT.'/View/alltask.php');
             }
         }
         else
             {
                 header("Location: http://localhost/beejee/");
             }
        
         return true;
    }
}
?>