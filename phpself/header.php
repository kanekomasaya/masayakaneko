<?php
 require_once('config/config.php');
 require_once('model/User.php');
 ?>
 <script src="https://code.jquery.com/jquery-2.2.4.js" integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI=" crossorigin="anonymous"></script>
   <script>
   $(function() {
      const hum = $('#hamburger, .close')
      const nav = $('.sp-nav')
      hum.on('click', function(){
         nav.toggleClass('toggle');
      });
   });
   </script>
<header>
 <div class="header_name">
   <p><a href="toppage.php"><i class="fas fa-fish fish fa-rotate-180"></i>Fishing Board</a></p>
 </div>
 <div class="header_contents" id="Header_Nav">
   <p><a href="favorite.php" class="nav-list"><i class="fas fa-thumbs-up thumbs"></i>お気に入り</a></p>
   <p><a href="mypost.php" class="nav-list"><i class="fas fa-th-list"></i>マイポスト</a></p>
   <p><a href="post.php" class="nav-list"><i class="fas fa-blog"></i>投稿する</a></p>
   <p><a href="search.php" class="nav-list"><i class="fas fa-search"></i>友達検索</a></p>
   <p><a href="setchange.php?edit=<?=$_SESSION['User']['id']?>" class="nav-list"><i class="fas fa-cogs"></i>設定変更</a></p>
   <p><a href="logout.php" class="nav-list"><i class="fas fa-sign-out-alt"></i>ログアウトする</a></p>
 </div>
 <nav class="sp-nav">
   <ul>
      <li><a href="favorite.php">お気に入り</a></li>
      <li><a href="mypost.php">マイポスト</a></li>
      <li><a href="post.php">投稿する</a></li>
      <li><a href="search.php">友達検索</a></li>
      <li><a href="setchange.php?edit=<?=$_SESSION['User']['id']?>">設定変更</a></li>
      <li><a href="logout.php">ログアウトする</a></li>
     <li class="close"><span>閉じる</span></li>
   </ul>
 </nav>
 <div id="hamburger">
      <span></span>
</div>
</header>
