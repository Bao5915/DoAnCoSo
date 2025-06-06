<?php
   if(isset($message)){
      foreach($message as $message){
         echo '
         <div class="message">
            <span>'.$message.'</span>
            <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
         </div>
         ';
      }
   }
   if(!function_exists('currency_fomat')){
      function currency_fomat($number, $suffmix = ' VNĐ'){
         if(!empty($number)){
            return number_format($number, 0, ',', '.'). "$suffmix";
         }
      }
   }
?>

<header class="header">

   <section class="flex">
       <link
         rel="stylesheet"
         href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
      />
   <a href="home.php" class="logo" ><span><h2 class="animate__animated animate__rubberBand">Anh Iem Rọt!</h2></span><h5 class="animate__animated animate__pulse"><i>Nội Thất Đỉnh Nóc Kịch Trần</i></h5></a>

      <nav class="navbar">
         <a href="home.php">Trang chủ</a>
         <a href="about.php">Về chúng tôi</a>
         <a href="donhang.php">Đơn hàng</a>
         <a href="shop.php">Cửa hàng</a>
         <a href="phanhoi.php">Đóng góp</a>
      </nav>

      <div class="icons">
         <?php
            $count_wishlist_items = $conn->prepare("SELECT * FROM `wishlist` WHERE user_id = ?");
            $count_wishlist_items->execute([$user_id]);
            $total_wishlist_counts = $count_wishlist_items->rowCount();

            $count_cart_items = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
            $count_cart_items->execute([$user_id]);
            $total_cart_counts = $count_cart_items->rowCount();
         ?>
         <div id="menu-btn" class="fas fa-bars"></div>
         <a href="timkiem.php"><i class="fas fa-search"></i></a>
         <a href="yeuthich.php"><i class="fas fa-heart"></i><span>(<?= $total_wishlist_counts; ?>)</span></a>
         <a href="giohang.php"><i class="fas fa-shopping-cart"></i><span>(<?= $total_cart_counts; ?>)</span></a>
         <div id="user-btn" class="fas fa-user"></div>
      </div>

      <div class="profile">
         <?php          
            $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
            $select_profile->execute([$user_id]);
            if($select_profile->rowCount() > 0){
            $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
         ?>
         <p>Xin Chào! </p>
         <p><?= $fetch_profile["name"]; ?></p>
         <a href="capnhattaikhoan.php" class="btn">Cập nhật thông tin</a>
         <a href="components/user_logout.php" class="delete-btn" onclick="return confirm('Bạn muỗn đăng xuất khỏi trang web này?');">Đăng xuất</a> 
         <?php
            }else{
         ?>
         <p>Vui lòng đăng nhập hoặc đăng ký tài khoản mới!</p>
         <div class="flex-btn">
            <a href="dangkytaikhoan.php" class="option-btn">Đăng ký</a>
            <a href="dangnhaptaikhoan.php" class="option-btn">Đăng nhập</a>
         </div>
         <?php
            }
         ?>      
         
         
      </div>

   </section>

</header>