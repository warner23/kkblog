<?php include('path.php');?>

<?php include(ROOT_PATH . '/app/controllers/posts.php');
usersOnly();

if(isset($_GET['id']))
{
$post = selectOne('posts', ['id' => $_GET['id']]);

}

$topics = selectAll('topics');
$posts =  selectAll('posts', ['published' => 1]);

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

 

  <!-- Custom Styles -->
  <link rel="stylesheet" href="css/style.css">

  <title><?php echo $post['title']; ?> | AwaInspires</title>
</head>

<body>

  

  <!-- header -->
<?php include(ROOT_PATH . "/app/includes/header.php");?> 
  <!-- // header -->

  <!-- Page wrapper -->
      <!-- content -->
   <div class="content clearfix">
      <div class="page-content single">
        <h2 style="text-align: center;"><b><?php echo $post['title']; ?></b></h2>
        <br>
        <?php echo html_entity_decode($post['body']); ?>

      </div>

      <div class="sidebar single">
        <!-- fb page -->
        
        <!-- // fb page -->

        <!-- Popular Posts -->
        <div class="section popular">
          <h2>Popular</h2>
          
          <?php foreach ($posts as $p): ?>
            <div class="post clearfix">
            <img src="<?php echo BASE_URL . '/images/' . $p['image']; ?>">
            <a href=""<?php echo $post['title']; ?> class="title"><?php echo $p['title']; ?></a>
          </div>
          <?php endforeach; ?> 

          
           </div>
        <!-- // Popular Posts -->

        <!-- topics -->
        <div class="section topics">
          <h2>Topics</h2>
          <ul>

            <?php foreach ($topics as $topic): ?>
              
            <li><a href="<?php echo BASE_URL . '/index.php?t_id=' . $topic['id'] . '&name=' . $topic['name'] ?>"><?php echo $topic['name']; ?></a></li>
            
            <?php endforeach; ?>
            
            </ul>
        </div>
        <!-- // topics -->

      </div>
    </div>
    <!-- // content -->

  </div>
  <!-- // page wrapper -->

  <!-- FOOTER -->
 <?php include(ROOT_PATH . "/app/includes/footer.php");?>
  <!-- // FOOTER -->


  

</body>

</html>