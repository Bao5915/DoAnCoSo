<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Anh Iem Rọt - Dashboard</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="../css/admin_style.css">
   <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
   <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

</head>
<body class="home">

<?php include '../components/admin_header.php'; ?>


<section class="dashboard">

   <h1 class="heading">Trang Chủ Admin</h1>

   <div class="box-container"  >

      <div class="box" data-aos="zoom-in">
         <h3>Xin chào!</h3>
         <p><?= $fetch_profile['name']; ?></p>
         <a href="update_profile.php" class="btn">Cập nhật thông tin</a>
      </div>

      <div class="box" data-aos="zoom-in">
         <?php
            $total_pendings = 0;
            $select_pendings = $conn->prepare("SELECT * FROM `orders` WHERE payment_status = ?");
            $select_pendings->execute(['Đang xử lý']);
            if($select_pendings->rowCount() > 0){
               while($fetch_pendings = $select_pendings->fetch(PDO::FETCH_ASSOC)){
                  $total_pendings += $fetch_pendings['total_price'];
               }
            }
         ?>
         <h3><span></span><?= currency_fomat($total_pendings); ?><span></span></h3>
         <p>Đang xử lý</p>
         <a href="admin_pending.php" class="btn">Xem đơn hàng</a>
      </div>

      <div class="box" data-aos="zoom-in">
         <?php
            $total_completes = 0;
            $select_completes = $conn->prepare("SELECT * FROM `orders` WHERE payment_status = ?");
            $select_completes->execute(['Hoàn thành']);
            if($select_completes->rowCount() > 0){
               while($fetch_completes = $select_completes->fetch(PDO::FETCH_ASSOC)){
                  $total_completes += $fetch_completes['total_price'];
               }
            }
         ?>
         <h3><span></span><?=currency_fomat($total_completes); ?><span></span></h3>
         <p>Đơn hoàn thành</p>
         <a href="admin_completed.php" class="btn">Xem đơn hàng</a>
      </div>

      <div class="box" data-aos="zoom-in">
         <?php
            $select_orders = $conn->prepare("SELECT * FROM `orders`");
            $select_orders->execute();
            $number_of_orders = $select_orders->rowCount()
         ?>
         <h3><?= $number_of_orders; ?></h3>
         <p>Đơn đặt hàng</p>
         <a href="placed_orders.php" class="btn">Xem đơn đặt hàng</a>
      </div>

      <div class="box" data-aos="zoom-in">
         <?php
            $select_products = $conn->prepare("SELECT * FROM `products`");
            $select_products->execute();
            $number_of_products = $select_products->rowCount()
         ?>
         <h3><?= $number_of_products; ?></h3>
         <p>Sản phẩm được thêm</p>
         <a href="products.php" class="btn">Xem sản phẩm</a>
      </div>

      <div class="box" data-aos="zoom-in">
         <?php
            $select_users = $conn->prepare("SELECT * FROM `users`");
            $select_users->execute();
            $number_of_users = $select_users->rowCount()
         ?>
         <h3><?= $number_of_users; ?></h3>
         <p>Users</p>
         <a href="users_accounts.php" class="btn">Xem Users</a>
      </div>

      <div class="box" data-aos="zoom-in">
         <?php
            $select_admins = $conn->prepare("SELECT * FROM `admins`");
            $select_admins->execute();
            $number_of_admins = $select_admins->rowCount()
         ?>
         <h3><?= $number_of_admins; ?></h3>
         <p>Admins</p>
         <a href="admin_accounts.php" class="btn">Xem admins</a>
      </div>

      <div class="box" data-aos="zoom-in">
         <?php
            $select_messages = $conn->prepare("SELECT * FROM `messages`");
            $select_messages->execute();
            $number_of_messages = $select_messages->rowCount()
         ?>
         <h3><?= $number_of_messages; ?></h3>
         <p>Phản hồi</p>
         <a href="messages.php" class="btn">Xem phản hồi</a>
      </div>

   </div>

</section>












<script src="../js/admin_script.js"></script>
   
</body>
<script>
  AOS.init();
</script>
</html>