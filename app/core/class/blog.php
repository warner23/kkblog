<?php

class blog
{


     function __construct() 
     {
        //connect to database
        $this->db = Db::getInstance();
    }

  function BlogPosts()
  {
    $results = $this->db->select("SELECT * FROM `posts`");

    foreach ($results as $key => $post){
        echo '<div class="post clearfix">
          <img src="'.BASE_URL . '/images/' . $post['image'].'" class="post-image" alt="">
          <div class="post-content">
            <h2 class="post-title"><a href="single.php?id='.$post['id'].'">'.$post['title'].'</a></h2>
            <div class="post-info">
              <i class="fa fa-user-o">'.$post['username'].'</i>
              &nbsp;
              <i class="fa fa-calendar">'.date('F j. Y',strtotime($post['created_at'])).'</i>
            </div>
            <p class="post-body">'. html_entity_decode(substr($post['body'], 0, 150) . '...').'
            </p>
            <a href="single.php?id='.$post['id'].'" class="read-more">Read More</a>
          </div>
        </div>';
      }

  }


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