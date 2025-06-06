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

      <a href="../admin/dashboard.php" class="logo animate__animated animate__pulse">Admin<span> Anh Iem Rọt</span></a>

      <nav class="navbar">
         <a href="../admin/dashboard.php">Trang chủ</a>
         <a href="../admin/products.php">Sản phẩm</a>
         <a href="../admin/placed_orders.php">Đơn hàng</a>
         <a href="../admin/admin_accounts.php">Admins</a>
         <a href="../admin/users_accounts.php">Users</a>
         <a href="../admin/messages.php">Phản hồi</a>
      </nav>

      <div class="icons">
         <div id="menu-btn" class="fas fa-bars"></div>
         <div id="user-btn" class="fas fa-user"></div>
      </div>

      <div class="profile">
         <?php
            $select_profile = $conn->prepare("SELECT * FROM `admins` WHERE id = ?");
            $select_profile->execute([$admin_id]);
            $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
         ?>
         <p><?= $fetch_profile['name']; ?></p>
         <a href="../admin/update_profile.php" class="btn">Cập nhật thông tin</a>
         <div class="flex-btn">
            <a href="../admin/register_admin.php" class="option-btn">Tạo tài khoản</a>
         </div>
         <a href="../components/admin_logout.php" class="delete-btn" onclick="return confirm('Đăng xuất khỏi trang web?');">Đăng xuất</a> 
      </div>

   </section>

</header>