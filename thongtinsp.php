<?php
include 'components/connect.php';
session_start();

$user_id = $_SESSION['user_id'] ?? '';
include 'components/wishlist_cart.php';
?>

<!DOCTYPE html>
<html lang="vi">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Thông tin sản phẩm</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link rel="stylesheet" href="css/style.css">
   <style>
      .main-image {
         position: relative;
         overflow: hidden;
         width: 100%;
         max-width: 400px;
         cursor: zoom-in;
      }
      .main-image img {
         width: 100%;
         transition: transform 0.3s ease;
      }
      .main-image:hover img {
         transform: scale(1.8);
      }
      .sub-image {
         display: flex;
         gap: 10px;
         margin-top: 10px;
      }
      .sub-image img {
         width: 80px;
         height: 80px;
         object-fit: cover;
         cursor: pointer;
         border: 2px solid transparent;
      }
      .sub-image img:hover {
         border-color: #999;
      }
      .image-modal {
         display: none;
         position: fixed;
         z-index: 1000;
         left: 0; top: 0;
         width: 100%; height: 100%;
         background-color: rgba(0,0,0,0.9);
         text-align: center;
         padding-top: 60px;
      }
      .image-modal img {
         max-width: 90%;
         max-height: 80vh;
         animation: zoom 0.3s;
      }
      @keyframes zoom {
         from {transform: scale(0.7);}
         to {transform: scale(1);}
      }
      .image-modal .close,
      .image-modal .prev,
      .image-modal .next {
         position: absolute;
         color: white;
         font-size: 40px;
         font-weight: bold;
         cursor: pointer;
         transition: 0.3s;
         user-select: none;
      }
      .image-modal .close {
         top: 30px;
         right: 35px;
      }
      .image-modal .prev {
         top: 50%;
         left: 20px;
         transform: translateY(-50%);
      }
      .image-modal .next {
         top: 50%;
         right: 20px;
         transform: translateY(-50%);
      }
      .image-modal .prev:hover,
      .image-modal .next:hover,
      .image-modal .close:hover {
         color: #bbb;
      }
   </style>
</head>
<body class="bg-body">

<?php include 'components/user_header.php'; ?>

<section class="quick-view">
   <h1 class="heading">Thông tin sản phẩm</h1>

   <?php
     $pid = $_GET['pid'];
     $select_products = $conn->prepare("SELECT * FROM `products` WHERE id = ?");
     $select_products->execute([$pid]);
     if($select_products->rowCount() > 0){
         while($product = $select_products->fetch(PDO::FETCH_ASSOC)){
   ?>
   <form action="" method="post" class="box">
      <input type="hidden" name="pid" value="<?= $product['id']; ?>">
      <input type="hidden" name="name" value="<?= $product['name']; ?>">
      <input type="hidden" name="price" value="<?= $product['price']; ?>">
      <input type="hidden" name="image" value="<?= $product['image_01']; ?>">
      <div class="row">
         <div class="image-container">
            <div class="main-image">
               <img src="uploaded_img/<?= $product['image_01']; ?>" id="mainProductImage" alt="">
            </div>
            <div class="sub-image">
               <img src="uploaded_img/<?= $product['image_01']; ?>" alt="">
               <img src="uploaded_img/<?= $product['image_02']; ?>" alt="">
               <img src="uploaded_img/<?= $product['image_03']; ?>" alt="">
            </div>
         </div>
         <div class="content">
            <div class="name"><?= $product['name']; ?></div>
            <div class="flex">
               <div class="price"><?= currency_fomat($product['price']); ?></div>
               <input type="number" name="qty" class="qty" min="1" max="99" value="1"
                  onkeypress="if(this.value.length == 2) return false;">
            </div>
            <div class="details"><pre><?= $product['details']; ?></pre></div>
            <div class="flex-btn">
               <input type="submit" value="Thêm vào giỏ hàng" class="btn" name="add_to_cart">
               <input class="option-btn" type="submit" name="add_to_wishlist" value="Yêu thích">
            </div>
         </div>
      </div>
   </form>
   <?php
         }
     } else {
         echo '<p class="empty">Chưa có sản phẩm nào được thêm</p>';
     }
   ?>
</section>

<!-- Modal ảnh lớn -->
<div id="imageModal" class="image-modal">
   <span class="close">&times;</span>
   <span class="prev">&#10094;</span>
   <span class="next">&#10095;</span>
   <img class="modal-content" id="modalImage">
</div>

<?php include 'components/footer.php'; ?>

<script>
document.addEventListener("DOMContentLoaded", () => {
   const modal = document.getElementById("imageModal");
   const modalImg = document.getElementById("modalImage");
   const closeBtn = document.querySelector(".image-modal .close");
   const prevBtn = document.querySelector(".image-modal .prev");
   const nextBtn = document.querySelector(".image-modal .next");

   const mainImage = document.getElementById("mainProductImage");
   const subImages = Array.from(document.querySelectorAll(".sub-image img"));
   let currentIndex = 0;

   function openModal(index) {
      currentIndex = index;
      modalImg.src = subImages[currentIndex].src;
      modal.style.display = "block";
   }

   function updateModalImage() {
      modalImg.src = subImages[currentIndex].src;
   }

   // Mở modal khi bấm ảnh chính
   mainImage.addEventListener("click", () => {
      let index = subImages.findIndex(img => img.src === mainImage.src);
      openModal(index >= 0 ? index : 0);
   });

   // Đóng modal
   closeBtn.onclick = () => modal.style.display = "none";
   window.onclick = e => { if (e.target == modal) modal.style.display = "none"; };

   // Chuyển ảnh tiếp/theo
   prevBtn.onclick = () => {
      currentIndex = (currentIndex - 1 + subImages.length) % subImages.length;
      updateModalImage();
   };
   nextBtn.onclick = () => {
      currentIndex = (currentIndex + 1) % subImages.length;
      updateModalImage();
   };

   // Click ảnh phụ: đổi ảnh chính
   subImages.forEach((img, i) => {
      img.addEventListener("click", (e) => {
         e.stopPropagation();
         mainImage.src = img.src;
         currentIndex = i;
      });
   });
});
</script>

</body>
</html>
