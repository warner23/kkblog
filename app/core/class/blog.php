<?php

class Blog
{


     function __construct() 
     {
        //connect to database
        $this->db = Db::getInstance();
        $this->Comment = new Comment();
    }

  function BlogPosts()
  {
    $results = $this->db->select("SELECT * FROM `posts`");

    foreach ($results as $key => $post){
        echo '<div class="post clearfix">
          <img src="'.BASE_URL . '/resources/images/' . $post['image'].'" class="post-image" alt="">
          <div class="post-content">
            <h2 class="post-title"><a href="javascript:void(0);" onclick="post.single('.$post['id'].')">'.$post['title'].'</a></h2>
            <div class="post-info">
              <i class="fa fa-user-o">'.self::postUsername($post['user_id']).'</i>
              &nbsp;
              <i class="fa fa-calendar">'.date('F j. Y',strtotime($post['created_at'])).'</i>
            </div>
            <p class="post-body">'. html_entity_decode(substr($post['body'], 0, 150) . '...').'
            </p>

            <div id="user_interact">
            <ul>
              <li onclick="post.thumbsUp(`'.$post['id'].'`);">
              <span>';
              $utustatus = self::likingChecker($post['id'], "thumbs_up");
              if($utustatus == "true"){
                echo '<img id="tus" src="'.BASE_URL . '/resources/images/tu_clicked.png" style="width:16px;height:16px;">';
              }else{
                echo '<img id="tus" src="'.BASE_URL . '/resources/images/tu_unclicked.png" style="width:16px;height:16px;">';
              }
              echo '</span>Thumbs Up</li>

              <li onclick="post.thumbsDown(`'.$post['id'].'`);">
              <span>';
              $utdstatus = self::likingChecker($post['id'], "thumbs_down");
              if($utdstatus == "true"){
                echo '<img id="tds" src="'.BASE_URL . '/resources/images/td_clicked.png" style="width:16px;height:16px;">';
              }else{
                echo '<img id="tds" src="'.BASE_URL . '/resources/images/td_unclicked.png" style="width:16px;height:16px;">';
              }
              echo '</span>Thumbs Down</li>
            </ul>
            </div>

            <a href="javascript:void(0);" class="read-more" onclick="post.single('.$post['id'].')">Read More</a>
          </div>
        </div>';
      }

  }

  function postId($id)
  {
    Session::set("postId", $id);
      echo json_encode("success");
      

  }

    function postload()
  {
     $id = Session::get("postId");
     //echo $id;
    $results = $this->db->select("SELECT * FROM `posts` WHERE `id`=:id", array("id" => $id));

    $resCount = count($results);
    if($resCount > 0){

      $div = '<div class="post clearfix">
          <div class="blog-post-content">
            <h2 class="post-title">'.$results[0]['title'].'</h2>
            <div class="post-info">
              <i class="fa fa-user-o">'.self::postUsername($results[0]['id']).'</i>
              &nbsp;
              <i class="fa fa-calendar">'.date('F j. Y',strtotime($results[0]['created_at'])).'</i>
            </div>
            <img src="'.BASE_URL . '/resources/images/' . $results[0]['image'].'" class="blog-post-image" alt="">
            <p class="post-body">'. $results[0]['body'].'
            </p>
            <div class="comments-comments">';
              $comments = $this->Comment->getBlogComments($results[0]['id']);
              foreach ($comments as $c) {
               $div .= '<blockquote>' . $c['comment'] . '
                <small>' . $c['posted_by_name'] . ' <em>at ' . $c['postTime'] . '</em></small>
                </backquote>';
              }
              $div .= '</div>   

         <textarea class="form-control" name="comment" rows="3" id="comment-text-'.$results[0]['id'].'"></textarea> 

          <div class="form-group">
                    <button class="btn btn-primary" id="btn-comment-'.$results[0]['id'].'" onclick="comment.newCommment(`'.$results[0]['id'].'`)" type="submit">
                        <i class="fa fa-comment"></i>
                        comment
                    </button>
                </div>  
          </div>
        </div>';

        $res = array(
          "status" => "success",
          "div"   => $div
        );
      echo json_encode($res);
    }
      
  }

  public function thumbUp($id)
  {
    $user_id = Session::get('user_id');
    if($user_id == "null" || !$user_id  > "0"){
      $res = array(
          "status" => "failed",
          "tdstatus"   => "login"
        );
      echo json_encode($res);
    }else{
    $tustatus = $this->db->select("SELECT * FROM `user_interact` WHERE `user_id`=:user_id AND `blog_id`=:blog_id", array("user_id" => $user_id, "blog_id" => $id));

    $count = count($tustatus);
    //echo $count;
    if($count > 0){

      $status = $tustatus[0]['thumbs_up'];
      $cid    = $tustatus[0]['id'];
      //echo $status;
    if($status == "true"){
      $s = "false";
      $this->db->update(
                    "user_interact", 
                    array(
                      "thumbs_up" => $s
                    ), 
                    "`id`=:id",
                    array( "id" => $cid )
               );

      $res = array(
          "status" => "success",
          "tustatus"   => "false",
          "src"   => BASE_URL . "/resources/images/tu_unclicked.png"
        );
      echo json_encode($res);

    }else{
       $s = "true";
      $this->db->update(
                    "user_interact", 
                    array(
                      "thumbs_up" => $s
                    ), 
                    "`id`=:id",
                    array( "id" => $cid )
               );

      $res = array(
          "status" => "success",
          "tustatus"   => "true",
          "src"   => BASE_URL . "/resources/images/tu_clicked.png"
        );
      echo json_encode($res);

    }

    }else{
       $this->db->insert('user_interact', array(
            "user_id"  => $user_id,
            "blog_id"  => $id,
            "thumbs_up" => "true"
          )); 
    }
  }
    

  }

  public function thumbDown($id)
  {
        $user_id = Session::get('user_id');

    $tustatus = $this->db->select("SELECT * FROM `user_interact` WHERE `user_id`=:user_id AND `blog_id`=:blog_id", array("user_id" => $user_id, "blog_id" => $id));

    $count = count($tustatus);

    if($count > 0){

    $status = $tustatus[0]['thumbs_down'];
    $cid    = $tustatus[0]['id'];

    if($status == "true"){
      $this->db->update(
                    "user_interact", 
                    array(
                      "thumbs_down" => "false")
                    , 
                    "`id` =:id",
                    array( "id" => $cid )
               );
      $res = array(
          "status" => "success",
          "tdstatus"   => "false",
          "src"   => BASE_URL . "/resources/images/td_unclicked.png"
        );
      echo json_encode($res);

    }else{
      $this->db->update(
                    "user_interact", 
                    array(
                      "thumbs_down" => "true"
                    ), 
                    "`id` =:id",
                    array( "id" => $cid )
               );
      $res = array(
          "status" => "success",
          "tdstatus"   => "true",
          "src"   => BASE_URL . "/resources/images/td_clicked.png"
        );
      echo json_encode($res);

    }
  }else{
     $this->db->insert('user_interact', array(
            "user_id"     => $user_id,
            "blog_id"  => $id,
            "thumbs_down" => "true"
          )); 
  }

  } 

  public function likingChecker($id, $like)
  {
    $user_id = Session::get('user_id');

    $tustatus = $this->db->select("SELECT * FROM `user_interact` WHERE `user_id`=:user_id AND `blog_id`=:blog_id", array("user_id" => $user_id, "blog_id" => $id));
   
   $count = count($tustatus);
   if($count > 0){
    $status = $tustatus[0][$like];
   return $status;

   }else{
    $status = "false";
    return $status;
   }
   


  }

   function postUsername($id)
  {
    //echo $id;
    $results = $this->db->select("SELECT * FROM `users` WHERE `id`=:id", array("id" => $id));
    //var_dump($results);
    $resCount = count($results);
    if($resCount > 0){
      $username = $results[0]['username'];
      return $username;

    }else{
      return "Unknown";
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