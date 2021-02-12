<?php


class TodoList {

    
    private $todolistName;
    private $myTodoList;
    private $db;

    public function __construct(string $todoListName) 
                                                      
    {
        $this->todolistName = $todoListName; 

        $conf = new DbConfig($todoListName); 

        $this->db = $conf->getDbFile(); 
                                        
    }
      public function getTodos() : array { 
        $this->myTodoList = json_decode(file_get_contents($this->db)); 
        return $this->myTodoList;
       
    }

    private function create(){

    }
    public function add(){ 
        $task = $_POST['mytodo'];
        if (!empty($task)){
            $this->myTodoList[] = $task;
            $this->save();
        }
    }

    
    public function delete(int $id){ 
        $id--; 
        unset($this->myTodoList[$id]); 
        $this->myTodoList = array_values( $this->myTodoList );
        $this->save();
    }
    public function update(int $id){
        $id--;
        $task = $_GET['guncel'];  
        if (!empty($task)){
        $this->myTodoList[$id] = $task;
        $this->myTodoList = array_values( $this->myTodoList );
        $this->save();
       }

    }
    public function statusChange(){

    }
    public function save(){ 
    file_put_contents($this->db, json_encode($this->myTodoList)); 
    }

}