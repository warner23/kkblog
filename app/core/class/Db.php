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


	    public function select($sql, $array = array(), $fetchMode = PDO::FETCH_ASSOC)
    {
    	$this->WIdb = self::getInstance();

        $smt = $this->WIdb->prepare($sql);
        foreach ($array as $key => &$value) {
            //echo ":$key", $value;
            $smt->bindParam(":$key", $value, PDO::PARAM_STR);
        }

        
        $smt->execute();

        $result = $smt->fetchAll($fetchMode);

        //$result->closeCursor();

        return $result;

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

	function update($table,$id,$data){
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

	function delete($table,$id){
	  global $conn;
	        //sql="DELETE FROM users WHERE id=?"
	$sql=" DELETE FROM $table WHERE id=? ";

	$stmt=executeQuery($sql,['id'=>$id]);
	return $stmt->affected_rows;

	}
}



?>