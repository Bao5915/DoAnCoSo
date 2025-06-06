<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

include 'components/wishlist_cart.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Anh Iem Rọt - Nội Thất Đẹp</title>

   <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />
   
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">
   <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
   <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
</head>
<body class="bg-body">
   
<?php include 'components/user_header.php'; ?>

<div class="home-bg">

<section class="home">

   <div class="swiper home-slider "  >
   
   <div class="swiper-wrapper">

      <div class="swiper-slide slide">
         <div class="image">
            <img src="anhnenweb/ketunen.png" alt="">
         </div>
         <div class="content">
            <img src="anhnenweb/sieusale.png"><br>
            <span><b><i>Giảm đến 55%</i> </b></span>
            <h3>Kệ Tủ Sách Cao Cấp</h3>
            <a href="shop.php" class="btn">Cửa hàng</a>


         </div>
      </div>

      <div class="swiper-slide slide">
         <div class="image">
            <img src="anhnenweb/ghenen.png" alt="">
         </div>
         <div class="content">
            <img src="anhnenweb/sieusale.png"><br>
            <span><b><i>Giảm đến 55%</i> </b></span>
            <h3>Ghế Ban Công Chất Liệu Cao Cấp</h3>
            <a href="shop.php" class="btn">Của hàng</a>
         </div>
      </div>

      <div class="swiper-slide slide">
         <div class="image">
            <img src="anhnenweb/bannen.png" alt="">
         </div>
         <div class="content">
            <img src="anhnenweb/sieusale.png"><br>
            <span><b><i>Giảm đến 55%</i> </b></span>
            <h3>Bàn Tròn Cao Cấp</h3>
            <a href="shop.php" class="btn">Cửa hàng</a>
         </div>
      </div>

   </div>

      <div class="swiper-pagination"></div>

   </div>

</section>

</div>

<section class="category"  data-aos="fade-up">

   <h1 class="heading">Danh mục sản phẩm</h1>

   <div class="swiper category-slider">

   <div class="swiper-wrapper">

   <a href="danhmuc.php?category=Bàn" class="swiper-slide slide">
      <img src="anhnenweb/bàn.png" alt="">
      <h3>Bàn</h3>
   </a>

   <a href="danhmuc.php?category=Ghế" class="swiper-slide slide">
      <img src="anhnenweb/ghế.png" alt="">
      <h3>Ghế</h3>
   </a>


   <a href="danhmuc.php?category=Đèn" class="swiper-slide slide">
      <img src="anhnenweb/đèn.png" alt="">
      <h3>Đèn</h3>
   </a>

   <a href="danhmuc.php?category=Giường" class="swiper-slide slide">
      <img src="anhnenweb/giường.png" alt="">
      <h3>Giường</h3>
   </a>

   <a href="danhmuc.php?category=Tranh" class="swiper-slide slide">
      <img src="anhnenweb/tranh.png" alt="">
      <h3>Tranh</h3>
   </a>

   <a href="danhmuc.php?category=Tủ" class="swiper-slide slide">
      <img src="anhnenweb/tủ.png" alt="">
      <h3>Tủ</h3>
   </a>

   <a href="danhmuc.php?category=Sofa" class="swiper-slide slide">
      <img src="anhnenweb/sofa.png" alt="">
      <h3>Sofa</h3>
   </a>



   </div>

   <div class="swiper-pagination"></div>

   </div>

</section>
<section class="home-products " data-aos="fade-up">

   <h1 class="heading">Sản phẩm hot nhất</h1>

   <div class="swiper products-slider ">

   <div class="swiper-wrapper">

   <?php
      $select_products = $conn->prepare("SELECT * FROM `products` ORDER BY `id` DESC LIMIT 6");
      $select_products->execute();
      if($select_products->rowCount() > 0){
      while($fetch_product = $select_products->fetch(PDO::FETCH_ASSOC)){
   ?>
   <form action="" method="post" class="swiper-slide slide">
      <input type="hidden" name="pid" value="<?= $fetch_product['id']; ?>">
      <input type="hidden" name="name" value="<?= $fetch_product['name']; ?>">
      <input type="hidden" name="price" value="<?= $fetch_product['price']; ?>">
      <input type="hidden" name="image" value="<?= $fetch_product['image_01']; ?>">
      
      <button class="fas fa-heart" type="submit" name="add_to_wishlist"></button>
      <a href="thongtinsp.php?pid=<?= $fetch_product['id']; ?>" class="fas fa-eye"></a>
      <img src="uploaded_img/<?= $fetch_product['image_01']; ?>" alt="">
      <div class="name"><?= $fetch_product['name']; ?></div>
      <div class="flex">
         <div class="price"><span></span><?= currency_fomat($fetch_product['price']); ?><span></span></div>
         <input type="number" name="qty" class="qty" min="1" max="99" onkeypress="if(this.value.length == 2) return false;" value="1">
      </div>
      <input type="submit" value="Thêm vào giỏ hàng" class="btn" name="add_to_cart">
      
   </form>
   <?php
      }
   }else{
      echo '<p class="empty">Chưa có sản phẩm nào được thêm!</p>';
   }
   ?>

   </div>

   <div class="swiper-pagination"></div>

   </div>

</section>








<?php include 'components/footer.php'; ?>

<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>

<script src="js/script.js"></script>

<script>

var swiper = new Swiper(".home-slider", {
   loop:true,
   spaceBetween: 20,
   pagination: {
      el: ".swiper-pagination",
      clickable:true,
    },
    autoplay: {
   delay: 5000,
 },
});

 var swiper = new Swiper(".category-slider", {
   spaceBetween: 20,
   pagination: {
      el: ".swiper-pagination",
      clickable:true,
   },
   breakpoints: {
      0: {
         slidesPerView: 2,
       },
      650: {
        slidesPerView: 3,
      },
      768: {
        slidesPerView: 4,
      },
      1024: {
        slidesPerView: 5,
      },
   },
});

var swiper = new Swiper(".products-slider", {
   spaceBetween: 20,
   pagination: {
      el: ".swiper-pagination",
      clickable:true,
   },
   autoplay: {
   delay: 5000,
 },
   breakpoints: {
      550: {
        slidesPerView: 2,
      },
      768: {
        slidesPerView: 2,
      },
      1024: {
        slidesPerView: 3,
      },
   },
});

</script>
</body>
<script>
  AOS.init();
</script>
</html>