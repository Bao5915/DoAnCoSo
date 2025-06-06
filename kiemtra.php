<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
   header('location:user_login.php');
};

if(isset($_POST['order'])){
   
   $name = $_POST['name'];
   $name = filter_var($name);
   $number = $_POST['number'];
   $number = filter_var($number);
   $email = $_POST['email'];
   $email = filter_var($email);
   $method = $_POST['method'];
   $method = filter_var($method);
   $address = $_POST['adress'] .', '. $_POST['xa'] .', '. $_POST['huyen'] .', '. $_POST['tinh'];
   $address = filter_var($address);
   $total_products = $_POST['total_products'];
   $total_price = $_POST['total_price'];

   $check_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
   $check_cart->execute([$user_id]);

   if($check_cart->rowCount() > 0){

      $insert_order = $conn->prepare("INSERT INTO `orders`(user_id, name, number, email, method, address, total_products, total_price) VALUES(?,?,?,?,?,?,?,?)");
      $insert_order->execute([$user_id, $name, $number, $email, $method, $address, $total_products, $total_price]);

      $delete_cart = $conn->prepare("DELETE FROM `cart` WHERE user_id = ?");
      $delete_cart->execute([$user_id]);

      $message[] = 'Đặt hàng thành công!';
   }else{
      $message[] = 'Giỏ hàng của bạn trống!';
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Anh Iem Rọt - Đặt hàng</title>
   
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body class="bg-body">
   
<?php include 'components/user_header.php'; ?>

<section class="checkout-orders">

   <form action="" method="POST">

   <h3>Đơn hàng của bạn</h3>

      <div class="display-orders">
      <?php
         $grand_total = 0;
         $cart_items[] = '';
         $select_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
         $select_cart->execute([$user_id]);
         if($select_cart->rowCount() > 0){
            while($fetch_cart = $select_cart->fetch(PDO::FETCH_ASSOC)){
               $cart_items[] = $fetch_cart['name'].' ('.currency_fomat($fetch_cart['price']).' x '. $fetch_cart['quantity'].') - ';
               $total_products = implode($cart_items);
               $grand_total += ($fetch_cart['price'] * $fetch_cart['quantity']);
      ?>
         <p> <?= $fetch_cart['name']; ?> <span>(<?= currency_fomat($fetch_cart['price']).' x '. $fetch_cart['quantity']; ?>)</span> </p>
      <?php
            }
         }else{
            echo '<p class="empty">Giỏ hàng của bạn trống!</p>';
         }
      ?>
         <input type="hidden" name="total_products" value="<?= $total_products; ?>">
         <input type="hidden" name="total_price" value="<?= $grand_total; ?>" value="">
         <div class="grand-total">Tổng tiền : <span><?= currency_fomat($grand_total); ?></span></div>
      </div>

      <h3>Thông tin giao hàng</h3>

      <div class="flex">
         <div class="inputBox">
            <span>Tên :</span>
            <input  type="text" name="name" required placeholder="Nhập vào tên" maxlength="20"  class="box" value="<?= $fetch_profile["name"]; ?>">
         </div>
         <div class="inputBox">
            <span>Số điện thoại :</span>
            <input type="text" name="number" placeholder="Nhập vào số điện thoại" class="box"  onkeypress="if(this.value.length == 10) return false;" required>
         </div>
         <div class="inputBox">
            <span>Email :</span>
            <input type="email" name="email" required placeholder="Nhập vào Email" maxlength="50"  class="box" oninput="this.value = this.value.replace(/\s/g, '')" value="<?= $fetch_profile["email"]; ?>">
         </div>
         <div class="inputBox">
            <span>Phương thức thanh toán :</span>
            <select name="method" class="box" required>
               <option value="Thanh toán khi nhận hàng">Thanh toán khi nhận hàng</option>
               <option value="Thanh toán qua thẻ ghi nợ">Thanh toán qua thẻ ghi nợ</option>
               <option value="Thanh toán qua Mobile Banking">Thanh toán qua Mobile Banking</option>
               <option value="Thanh toán qua Mono">Thanh toán qua Mono</option>
            </select>
         </div>
         <div class="inputBox">
            <span>Địa chỉ nhận hàng :</span>
            <input type="text" name="adress" placeholder="Nhập địa chỉ" class="box" maxlength="50" required>
         </div>
         <div class="inputBox">
            <span>Phường/ Xã :</span>
            <input type="text" name="xa" placeholder="Nhập Phường/ Xã" class="box" maxlength="50" required>
         </div>
         <div class="inputBox">
            <span>Quận/ Huyện :</span>
            <input type="text" name="huyen" placeholder="Nhập Quận/ Huyện" class="box" maxlength="50" required>
         </div>
         <div class="inputBox">
            <span>Tỉnh/ Thành phố :</span>
            <input type="text" name="tinh" placeholder="Nhập Tỉnh/ Thành phố" class="box" maxlength="50" required>
         </div>

      </div>

      <input type="submit" name="order" class="btn <?= ($grand_total > 1)?'':'disabled'; ?>" value="Đặt hàng">

   </form>

</section>













<?php include 'components/footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>