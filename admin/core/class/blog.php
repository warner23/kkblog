<?php

class blog
{

	function getPublishedPosts()
{
  global $conn;
  //SELECT * FROM posts where published=1; 
  $sql = "SELECT p.*, u.username FROM posts AS p JOIN users AS u ON p.user_id=u.id WHERE p.published=?";
  
  $stmt=executeQuery($sql, ['published' => 1]);
  $records=$stmt->get_result()->fetch_all(MYSQLI_ASSOC);
  return $records;
}


function getPostsByTopicId($topic_id)
{
  global $conn;
  //SELECT * FROM posts where published=1; 
  $sql = "SELECT p.*, u.username FROM posts AS p JOIN users AS u ON p.user_id=u.id WHERE p.published=? AND topic_id=?";
  
  $stmt=executeQuery($sql, ['published' => 1, 'topic_id' => $topic_id]);
  $records=$stmt->get_result()->fetch_all(MYSQLI_ASSOC);
  return $records;
}


function searchPosts($term)
{ 
  $match = '%' . $term . '%';
  global $conn;
  //SELECT * FROM posts where published=1; 
  $sql = "SELECT 
  p.*, u.username 
  FROM posts AS p 
  JOIN users AS u 
  ON p.user_id=u.id 
  WHERE p.published=?
  AND p.title LIKE ? OR p.body LIKE ?";
  
  $stmt=executeQuery($sql, ['published' => 1, 'title' => $match, 'body' => $match]);
  $records=$stmt->get_result()->fetch_all(MYSQLI_ASSOC);
  return $records;
}
	
}

?>