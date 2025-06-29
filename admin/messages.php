<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
};

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   $delete_message = $conn->prepare("DELETE FROM `messages` WHERE id = ?");
   $delete_message->execute([$delete_id]);
   header('location:messages.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Anh Iem Rọt - Adnin - Đóng góp ý kiến</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="../css/admin_style.css">
   <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
   <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

</head>
<body class="home">

<?php include '../components/admin_header.php'; ?>

<section class="contacts">

<h1 class="heading">Phản hồi</h1>

<div class="box-container">

   <?php
      $select_messages = $conn->prepare("SELECT * FROM `messages`");
      $select_messages->execute();
      if($select_messages->rowCount() > 0){
         while($fetch_messages = $select_messages->fetch(PDO::FETCH_ASSOC)){
   ?>
   <div class="box" data-aos="zoom-out">
   <p> User ID : <span><?= $fetch_messages['user_id']; ?></span></p>
   <p> Tên : <span><?= $fetch_messages['name']; ?></span></p>
   <p> Email : <span><?= $fetch_messages['email']; ?></span></p>
   <p> Số điện thoại : <span><?= $fetch_messages['number']; ?></span></p>
   <p> Phản hồi : <span><?= $fetch_messages['message']; ?></span></p>
   <a href="messages.php?delete=<?= $fetch_messages['id']; ?>" onclick="return confirm('Xóa phản hồi này?');" class="delete-btn">Xóa</a>
   </div>
   <?php
         }
      }else{
         echo '<p class="empty">Bạn không có phản hồi nào!</p>';
      }
   ?>

</div>

</section>












<script src="../js/admin_script.js"></script>
   
</body>
<script>
  AOS.init();
</script>
</html>