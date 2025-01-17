<?php

/**
* Database Class
* Created by Warner Infinity
* Author Jules Warner
*/

class Db extends PDO
{
	private static $_instance;
	
	public function __construct($DB_TYPE, $DB_HOST, $DB_NAME, $DB_USER, $DB_PASS)
    {
        try {
            parent::__construct($DB_TYPE.':host='.$DB_HOST.';dbname='.$DB_NAME.';charset=utf8', $DB_USER, $DB_PASS);
            $this->exec('SET CHARACTER SET utf8');
            // comment this line if you don't want error reporting
          $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

        } catch (PDOException $e) {
            die ( 'Connection failed: ' . $e->getMessage() );
        }
    }

    // this function creates an instance of  db
    public static function getInstance() {
        // create instance if doesn't exist
        if ( self::$_instance === null )
            self::$_instance = new self(DB_TYPE, DB_HOST, DB_NAME, DB_USER, DB_PASS);

        return self::$_instance;
    }


     public function select($sql, $array = array(), $fetchMode = PDO::FETCH_ASSOC)
    {
        $this->db = self::getInstance();

        $smt = $this->db->prepare($sql);
        //print_r($smt);
        foreach ($array as $key => &$value) {
            //echo ":$key", $value;
            $smt->bindParam(":$key", $value, PDO::PARAM_STR);
        }

        $smt->execute();
        $result = $smt->fetchAll($fetchMode);        

        $smt->closeCursor();

        if($result > 0){
            return $result;
        }else{
            echo "null";
        }

    }

    public function selectwithOptions($sql, $array = array(), $fetchMode = PDO::FETCH_ASSOC)
    {
        $this->db = self::getInstance();
        $smt = $this->db->prepare($sql);
        foreach ($array as $key => &$value) {
            //echo ":$key", $value;
            $smt->bindParam(':$key', $value, PDO::PARAM_STR);
        }

        $smt->execute();
        $result = $smt->fetchAll($fetchMode);        

        $smt->closeCursor();

        if($result > 0){
            return $result;
        }else{
            echo "null";
        }

    }

        public function Selected($sql, $array = array(), $fetchMode = PDO::FETCH_ASSOC, $while)
    {
        $this->db = self::getInstance();

        $smt = $this->db->prepare($sql);
        foreach ($array as $key => &$value) {
            //echo ":$key", $value;
            $smt->bindParam(":$key", $value, PDO::PARAM_STR);
        }

        $smt->execute();

        while ($result = $smt) {
            echo $while;
        }
        $smt->closeCursor();

        return $query;

    }

        public function selectColumn($sql, $array = array(), $column, $fetchMode = PDO::FETCH_ASSOC)
    {
        $db = self::getInstance();

        $sth = $db->prepare($sql);
        foreach ($array as $key => &$value) {
            $sth->bindParam(":$key", $value);
        }

        
        $sth->execute();

        $result = $sth->fetch($fetchMode);
        //echo $result[$column];
        $sth->closeCursor();

        //echo "chat_id" . $result[$column];
        return $result[$column];
    }

     public function blindFreeColumn($sql, $column, $fetchMode = PDO::FETCH_ASSOC)
    {
        $db = self::getInstance();

        $sth = $db->prepare($sql);
        $sth->execute();

        $result = $sth->fetch($fetchMode);
        $sth->closeCursor();
       // return $result[$column];
    }

        public function bindfree($query)
    {
        $this->db = self::getInstance();

        $smt = $this->db->prepare($query);
        $smt->execute();
        $smt->closeCursor();

        return $query;

    }
    
    public function insert($table, $data)
    {
        ksort($data);

        $fieldNames = implode('`, `', array_keys($data));
        $fieldValues = ':' . implode(', :', array_keys($data));

        $sth = $this->prepare("INSERT INTO $table (`$fieldNames`) VALUES ($fieldValues)");

        foreach ($data as $key => &$value) {
            $sth->bindParam(":$key", $value, PDO::PARAM_STR);
        }

        $sth->execute();
    
    }

     public function Arrayinsert($table, $data)
    {
        ksort($data);

        $fieldNames = implode('`, `', array_keys($data));
        var_dump($fieldNames);
        $fieldValues = ':' . implode(', :', array_keys($data));
        var_dump($fieldValues);
        $sth = $this->prepare("INSERT INTO $table (`$fieldNames`) VALUES ($fieldValues)");

        foreach ($data as $key => &$value) {
            $sth->bindParam(":$key", $value, PDO::PARAM_STR);
        }

        $sth->execute();
    
    }
    


    public function update($table, $data, $where, $whereBindArray = array())
    {
        $this->db = self::getInstance();

        ksort($data);
        //var_dump($data);
        $fieldDetails = NULL;
        
        foreach($data as $key => &$value) {
            $fieldDetails .= "`$key`=:$key,";
        }
        $fieldDetails = rtrim($fieldDetails, ',');
        //var_dump($fieldDetails);
        $smt = $this->db->prepare("UPDATE $table SET $fieldDetails WHERE $where");
        
        //var_dump($smt);
        foreach ($data as $key => &$value) {
          //echo ":$key", $value;
            $smt->bindParam(":$key", $value, PDO::PARAM_STR);
            //var_dump($value);
        }
        
        foreach ($whereBindArray as $key => &$value) {
           //echo ":$key", $value;
            $smt->bindParam(":$key", $value, PDO::PARAM_STR);
            //var_dump($value);
        }
        
        //var_dump($smt);
        
        $smt->execute();

        $smt->closeCursor();
    }
    

    public function delete($table, $where, $bind = array(), $limit = 1)
    {
        $this->WIdb = self::getInstance();

        $smt = $this->WIdb->prepare("DELETE FROM $table WHERE $where LIMIT $limit");
        
        foreach ($bind as $key => &$value) {
            $smt->bindParam(":$key", $value);
        }
        
        $smt->execute();

        $smt->closeCursor();
    }

    function dd($value) //to be deleted
	{
	echo"<pre>",print_r($value,true), "<pre>";
	die();
	}


	function executeQuery($sql,$data)
	{
	   global $conn;
	  $stmt=$conn->prepare($sql);
	  $values=array_values($data);
	  $types= str_repeat('s',count($values));
	  $stmt->bind_param($types,...$values);
	  $stmt->execute();
	  return $stmt;
	}




	function selectAll($table,$conditions=[])
	{
	global $conn;
	$sql="SELECT *FROM $table";
	  if(empty($conditions)){
	                $stmt=$conn->prepare($sql);
	                $stmt->execute();
	                $records=$stmt->get_result()->fetch_all(MYSQLI_ASSOC);
	                return $records;
	} else{
	   //$sql="SELECT * FROM $table WHERE username='Adarsh' AND admin=1";
	   $i=0;
	    foreach($conditions as $key => $value){
	    if($i===0){
	     $sql= $sql . " WHERE $key=?";
	   }else{
	     $sql=$sql . " AND $key=?";
	 }
	  $i++;
	 }
	 
	                $stmt=executeQuery($sql,$conditions);
	                $records=$stmt->get_result()->fetch_all(MYSQLI_ASSOC);
	                return $records;
	 }

	 }

	function selectOne($table,$conditions)
	{
	global $conn;
	$sql="SELECT *FROM $table";
	  
	  
	   $i=0;
	    foreach($conditions as $key => $value){
	    if($i===0){
	     $sql= $sql . " WHERE $key=?";
	   }else{
	     $sql=$sql . " AND $key=?";
	 }
	  $i++;
	 }
	     //$sql="SELECT * FROM users WHERE admin=0 AND username='Adarsh' LIMIT 1";
	    $sql= $sql . " LIMIT 1 ";
	    $stmt=executeQuery($sql,$conditions);
	    $records=$stmt->get_result()->fetch_assoc();
	    return $records;
	 

	 }

	function create($table,$data){
	  global $conn;
	        //sql="INSERT INTO users SET username=?,admin=?,email=?,password=?"
	$sql=" INSERT INTO $table SET ";

	$i=0;
	    foreach($data as $key => $value){
	    if($i===0){
	     $sql= $sql . " $key=?";
	   }else{
	     $sql=$sql . ", $key=?";
	 }
	  $i++;
	 }
	 
	$stmt=executeQuery($sql,$data);
	$id=$stmt->insert_id;
	return $id;

	}

	function updateDetails($table,$id,$data){
	  global $conn;
	        //sql="UPDATE users SET username=?,admin=?,email=?,password=? WHERE id=?"
	$sql=" UPDATE $table SET ";

	$i=0;
	    foreach($data as $key => $value){
	    if($i===0){
	     $sql= $sql . " $key=?";
	   }else{
	     $sql=$sql . ", $key=?";
	 }
	  $i++;
	 }
	 
	$sql=$sql . " WHERE id=? ";
	$data['id']=$id;
	$stmt=executeQuery($sql,$data);

	return $stmt->affected_rows;

	}

	function deleteFromTable($table,$id){
	  global $conn;
	        //sql="DELETE FROM users WHERE id=?"
	$sql=" DELETE FROM $table WHERE id=? ";

	$stmt=executeQuery($sql,['id'=>$id]);
	return $stmt->affected_rows;

	}
}



?>