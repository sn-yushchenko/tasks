<?php
class Tasks{
    public function __construct()
    {
        
    } 
    public static function addTask($task,$status,$user_id,$path)
    {
        $pdo=connection::getConnection();
        $stmt = $pdo->prepare('INSERT INTO tasks(id,user_id,tasks,status,path) VALUES(NULL,:user_id,:task,:status,:path)');
        $stmt->execute(array('user_id' => $user_id,'task'=>$task,'status'=>$status,'path'=>$path));
        return true;
    }
    public static function allTasks()
    {
        $pdo=connection::getConnection();
        $stmt = $pdo->prepare('SELECT tasks.id,tasks.tasks,tasks.status,tasks.path,users.name,users.email FROM tasks LEFT JOIN users ON users.id=tasks.user_id');
        $stmt->execute();
        $tasks=array();
        while ($row = $stmt->fetch())
        {
            $tasks[]=$row;
        }
        return $tasks;
    }
    public static function changeStatus($status,$id)
    {
        $pdo=connection::getConnection();
        $stmt = $pdo->prepare('UPDATE tasks SET status=:status WHERE id =:id');
        $stmt->execute(array('status' => $status,'id'=>$id));
    }
    public static function changeText($tasks,$id)
    {
        $pdo=connection::getConnection();
        $stmt = $pdo->prepare('UPDATE tasks SET tasks=:tasks WHERE id =:id');
        $stmt->execute(array('tasks' => $tasks,'id'=>$id));
    }
    public static function Pagination($item,$count)
    {
        $pdo=connection::getConnection();
        $stmt = $pdo->prepare('SELECT tasks.id,tasks.tasks,tasks.status,tasks.path,users.name FROM tasks LEFT JOIN users ON users.id=tasks.user_id ORDER BY id DESC LIMIT :item,:count');
        $stmt->execute(array('item' => $item,'count'=>$count));  
        $tasks=array();
        while ($row = $stmt->fetch())
        {
            $tasks[]=$row;
        }
        return $tasks;
        
    }
     public static function Count()
    {
        $count="";
        $pdo=connection::getConnection();
        $smt = $pdo->query('SELECT COUNT(*) AS count FROM tasks');
        while ($row = $smt->fetch())
        {
            $count=$row["count"];
        }
        return $count;
    }
    static public function searchTasks($search,$status)
    {
        $pdo=connection::getConnection();
        if($status==1)
        {
            $stmt = $pdo->prepare('SELECT (SELECT COUNT(*) FROM tasks LEFT JOIN users ON users.id=tasks.user_id WHERE name LIKE CONCAT(:search1,"%") AND status=1) AS count,tasks.id,tasks.tasks,tasks.status,tasks.path,users.name,users.email FROM tasks LEFT JOIN users ON users.id=tasks.user_id WHERE name LIKE CONCAT(:search,"%") AND status=1');
            $stmt->bindValue(":search", $search);
            $stmt->bindValue(":search1", $search);
            $stmt->execute();
            $tasks=array();
            while ($row = $stmt->fetch())
            {
                $tasks[]=$row;
            }
           
        }
         else
         {
            $stmt = $pdo->prepare('SELECT (SELECT COUNT(*) FROM tasks LEFT JOIN users ON users.id=tasks.user_id WHERE name LIKE CONCAT(:search1,"%")) AS count,tasks.id,tasks.tasks,tasks.status,tasks.path,users.name,users.email FROM tasks LEFT JOIN users ON users.id=tasks.user_id WHERE name LIKE CONCAT(:search,"%")');
            $stmt->bindValue(":search", $search);
            $stmt->bindValue(":search1", $search);
            $stmt->execute();
            $tasks=array();
            while ($row = $stmt->fetch())
            {
                $tasks[]=$row;
            }
         }
        return $tasks;
    }
}
?>