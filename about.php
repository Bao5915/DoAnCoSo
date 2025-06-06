<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Anh Iem Rọt - Về chúng tôi</title>

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

<section class="about">

   <div class="row">

      <div class="image" data-aos="fade-right">
         <img src="     " alt="">
      </div>

      <div class="content" data-aos="fade-left">
         <h3>Tại sao lại lựa chúng tôi?</h3>
         <p>Chúng tôi tin vào dịch dụ mà chúng tôi cung cấp.  Đặt khách hàng làm trung tâm trong mọi suy nghĩ và hành động của mình. Lấy sự hài lòng của bạn làm thước đo thành công.</p>
         <a href="phanhoi.php" class="btn">Đóng góp ý kiến</a>
      </div>

   </div>

</section>

<section class="reviews" data-aos="fade-up">
   
   <h1 class="heading">Đánh giá của khách hàng</h1>

   <div class="swiper reviews-slider">

   <div class="swiper-wrapper">

      <div class="swiper-slide slide">
         <img src=" " alt="">
         <p>Shop uy tín nên rất yên tâm khi mua hàng, lại còn săn được giá sale, nhận được hàng mà ưng lắm luôn. Giao hàng nhanh như gió, shipper thân thiện còn nhắc nhở quay lại video khi unbox</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
         </div>
         <h3>C.Ronaldo </h3>
      </div>

      <div class="swiper-slide slide">
         <img src=" " alt="">
         <p>Sản phẩm đỉnh nóc kịch trần bay phấp phới.</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>Messi</h3>
      </div>

      <div class="swiper-slide slide">
         <img src=" " alt="">
         <p>Sản phẩm oách xà lách vô cùng <br> Giao hàng nhanh ,Nên mua <br> Shipper thân thiện <br>Hàng tốt, Đúng với mẫu</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>Tommy Tèo</h3>
      </div>

      <div class="swiper-slide slide">
         <img src=" " alt="">
         <p>Đã nhận được sản phẩm.<br>Mua hàng ở shop rất là ưng luôn <br> Đẹp đã trải nghiệm thấy rất hài lòng sẽ tiếp tục ủng hộ điện thoại của shop.</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>Trần Văn C</h3>
      </div>

      <div class="swiper-slide slide">
         <img src="  " alt="">
         <p>Đóng gói kỹ lắm , mình có quay clip lại lun .Hàng cũng đẹp, chạy mượt mà.Mua hàng điện tử mà qua mạng thì cũng hồi họp lắm nhưng săn được giá tốt nên mua. Tiết kiệm được xíu. Gần nhà cũng có trung tâm bảo hành nên có gì thì cứ đem ra. Cũng an tâm mua.</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3> Dấu Tên</h3>
      </div>

      <div class="swiper-slide slide">
         <img src=" " alt="">
         <p>Luôn tin tưởng shop, đã mua hàng ở shop rất nhiều lần, nhân viên tư vấn rất nhiệt tình, giao hàng nhanh, hàng về như hình, sẽ ủng hộ shop dài dài.</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>Ẩn Danh</h3>
      </div>

   </div>

   <div class="swiper-pagination"></div>

   </div>

</section>









<?php include 'components/footer.php'; ?>

<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>

<script src="js/script.js"></script>

<script>

var swiper = new Swiper(".reviews-slider", {
   loop:true,
   spaceBetween: 20,
   pagination: {
      el: ".swiper-pagination",
      clickable:true,
   },
   breakpoints: {
      0: {
        slidesPerView:1,
      },
      768: {
        slidesPerView: 2,
      },
      991: {
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