<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
   header('location:admin_login.php');
};

if (isset($_POST['add_product'])) {

   $name = $_POST['name'];
   $name = filter_var($name);
   $price = $_POST['price'];
   $price = filter_var($price);
   $details = $_POST['details'];
   $details = filter_var($details);

   $image_01 = $_FILES['image_01']['name'];
   $image_01 = filter_var($image_01);
   $image_size_01 = $_FILES['image_01']['size'];
   $image_tmp_name_01 = $_FILES['image_01']['tmp_name'];
   $image_folder_01 = '../uploaded_img/' . $image_01;

   $image_02 = $_FILES['image_02']['name'];
   $image_02 = filter_var($image_02);
   $image_size_02 = $_FILES['image_02']['size'];
   $image_tmp_name_02 = $_FILES['image_02']['tmp_name'];
   $image_folder_02 = '../uploaded_img/' . $image_02;

   $image_03 = $_FILES['image_03']['name'];
   $image_03 = filter_var($image_03);
   $image_size_03 = $_FILES['image_03']['size'];
   $image_tmp_name_03 = $_FILES['image_03']['tmp_name'];
   $image_folder_03 = '../uploaded_img/' . $image_03;

   $quantity = $_POST['quantity'];
   $quantity = filter_var($quantity, FILTER_VALIDATE_INT);


   $select_products = $conn->prepare("SELECT * FROM `products` WHERE name = ?");
   $select_products->execute([$name]);

   if ($select_products->rowCount() > 0) {
      $message[] = 'Tên sản phẩm đã tồn tại!';
   } else {

      $insert_products = $conn->prepare("INSERT INTO `products`(name, details, price, image_01, image_02, image_03, quantity) VALUES(?,?,?,?,?,?,?)");
      $insert_products->execute([$name, $details, $price, $image_01, $image_02, $image_03, $quantity]);


      if ($insert_products) {
         if ($image_size_01 > 2000000 or $image_size_02 > 2000000 or $image_size_03 > 2000000) {
            $message[] = 'Kích thước ảnh quá lớn!';
         } else {
            move_uploaded_file($image_tmp_name_01, $image_folder_01);
            move_uploaded_file($image_tmp_name_02, $image_folder_02);
            move_uploaded_file($image_tmp_name_03, $image_folder_03);
            $message[] = 'Sản phẩm mới được thêm!';
         }
      }
   }
};

if (isset($_GET['delete'])) {

   $delete_id = $_GET['delete'];
   $delete_product_image = $conn->prepare("SELECT * FROM `products` WHERE id = ?");
   $delete_product_image->execute([$delete_id]);
   $fetch_delete_image = $delete_product_image->fetch(PDO::FETCH_ASSOC);
   unlink('../uploaded_img/' . $fetch_delete_image['image_01']);
   unlink('../uploaded_img/' . $fetch_delete_image['image_02']);
   unlink('../uploaded_img/' . $fetch_delete_image['image_03']);
   $delete_product = $conn->prepare("DELETE FROM `products` WHERE id = ?");
   $delete_product->execute([$delete_id]);
   $delete_cart = $conn->prepare("DELETE FROM `cart` WHERE pid = ?");
   $delete_cart->execute([$delete_id]);
   $delete_wishlist = $conn->prepare("DELETE FROM `wishlist` WHERE pid = ?");
   $delete_wishlist->execute([$delete_id]);
   header('location:products.php');
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Anh Iem Rọt - Admin - Sản phẩm</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="../css/admin_style.css">
   <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
   <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

</head>

<body class="home">

   <?php include '../components/admin_header.php'; ?>

   <section class="add-products">

      <h1 class="heading">Thêm sản phẩm</h1>

      <form action="" method="post" enctype="multipart/form-data" data-aos="zoom-in">
         <div class="flex">
            <div class="inputBox">
               <span>Tên sản phẩm (Bắt buộc)</span>
               <input type="text" class="box" required maxlength="100" placeholder="Nhập tên sản phẩm" name="name">
            </div>
            <div class="inputBox">
               <span>Giá sản phẩm (Bắt buộc)</span>
               <input type="text" class="box" placeholder="Nhập giá sản phẩm" onkeypress="if(this.value.length == 10) return false;" name="price">
            </div>
            <div class="inputBox">
               <span>Ảnh 01 (Bắt buộc)</span>
               <input type="file" name="image_01" accept="image/jpg, image/jpeg, image/png, image/webp" class="box" required>
            </div>
            <div class="inputBox">
               <span>Ảnh 02 (Bắt buộc)</span>
               <input type="file" name="image_02" accept="image/jpg, image/jpeg, image/png, image/webp" class="box" required>
            </div>
            <div class="inputBox">
               <span>Ảnh 03 (Bắt buộc)</span>
               <input type="file" name="image_03" accept="image/jpg, image/jpeg, image/png, image/webp" class="box" required>
            </div>
            <div class="inputBox">
               <span>Thông tin sản phẩm (Bắt buộc)</span>
               <textarea name="details" placeholder="Nhập vào thông tin sản phẩm" class="box" required maxlength="500" cols="30" rows="10"></textarea>
            </div>
            <div class="inputBox">
               <span>Số lượng sản phẩm (Bắt buộc)</span>
               <input type="number" class="box" name="quantity" required min="1" placeholder="Nhập số lượng sản phẩm">
            </div>

         </div>

         <input type="submit" value="Thêm sản phẩm" class="btn" name="add_product">
      </form>

   </section>

   <section class="show-products">

      <h1 class="heading">Sản phẩm được thêm</h1>

      <div class="box-container">

         <?php
         $select_products = $conn->prepare("SELECT * FROM `products`");
         $select_products->execute();
         if ($select_products->rowCount() > 0) {
            while ($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)) {
         ?>
               <div class="box" data-aos="fade-up" data-aos-anchor-placement="center-bottom">
                  <img src="../uploaded_img/<?= $fetch_products['image_01']; ?>" alt="">
                  <div class="name"><?= $fetch_products['name']; ?></div>
                  <div class="price"><span><?= currency_fomat($fetch_products['price']); ?></span></div>
                  <div class="details"><span><?= $fetch_products['details']; ?></span></div>
                  <div class="price">Số lượng: <span><?= $fetch_products['quantity']; ?></span></div>
                  <div class="flex-btn">
                     <a href="update_product.php?update=<?= $fetch_products['id']; ?>" class="option-btn">Cập nhật</a>
                     <a href="products.php?delete=<?= $fetch_products['id']; ?>" class="delete-btn" onclick="return confirm('Bạn muốn xóa sản phẩm này?');">Xóa</a>
                  </div>
                  
               </div>
         <?php
            }
         } else {
            echo '<p class="empty">Chưa có sản phẩm nào được thêm!</p>';
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