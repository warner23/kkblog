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