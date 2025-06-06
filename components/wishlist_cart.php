<?php

if(isset($_POST['add_to_wishlist'])){

   if($user_id == ''){
      header('location:dangnhaptaikhoan.php');
   }else{

      $pid = $_POST['pid'];
      $pid = filter_var($pid);
      $name = $_POST['name'];
      $name = filter_var($name);
      $price = $_POST['price'];
      $price = filter_var($price);
      $image = $_POST['image'];
      $image = filter_var($image);

      $check_wishlist_numbers = $conn->prepare("SELECT * FROM `wishlist` WHERE name = ? AND user_id = ?");
      $check_wishlist_numbers->execute([$name, $user_id]);

      $check_cart_numbers = $conn->prepare("SELECT * FROM `cart` WHERE name = ? AND user_id = ?");
      $check_cart_numbers->execute([$name, $user_id]);

      if($check_wishlist_numbers->rowCount() > 0){
         $message[] = 'Sản phẩm đã có danh sách yêu thích!';
      }elseif($check_cart_numbers->rowCount() > 0){
         $message[] = 'Sản phẩm đã có trong giỏ hàng!';
      }else{
         $insert_wishlist = $conn->prepare("INSERT INTO `wishlist`(user_id, pid, name, price, image) VALUES(?,?,?,?,?)");
         $insert_wishlist->execute([$user_id, $pid, $name, $price, $image]);
         $message[] = 'Thêm vào danh sách yêu thích thành công!';
      }

   }

}

if(isset($_POST['add_to_cart'])){

   if($user_id == ''){
      header('location:dangnhaptaikhoan.php');
   }else{

      $pid = $_POST['pid'];
      $pid = filter_var($pid);
      $name = $_POST['name'];
      $name = filter_var($name);
      $price = $_POST['price'];
      $price = filter_var($price);
      $image = $_POST['image'];
      $image = filter_var($image);
      $qty = $_POST['qty'];
      $qty = filter_var($qty);
      
      $check_cart_numbers = $conn->prepare("SELECT * FROM `cart` WHERE name = ? AND user_id = ?");
      $check_cart_numbers->execute([$name, $user_id]);

      if($check_cart_numbers->rowCount() > 0){
         $message[] = 'Sản phẩm đã có trong giỏ hàng!';
      }else{

         $check_wishlist_numbers = $conn->prepare("SELECT * FROM `wishlist` WHERE name = ? AND user_id = ?");
         $check_wishlist_numbers->execute([$name, $user_id]);

         if($check_wishlist_numbers->rowCount() > 0){
            $delete_wishlist = $conn->prepare("DELETE FROM `wishlist` WHERE name = ? AND user_id = ?");
            $delete_wishlist->execute([$name, $user_id]);
         }

         $insert_cart = $conn->prepare("INSERT INTO `cart`(user_id, pid, name, price, quantity, image) VALUES(?,?,?,?,?,?)");
         $insert_cart->execute([$user_id, $pid, $name, $price, $qty, $image]);
         $message[] = 'Thêm vào giỏ hàng thành công!';
         
      }

   }

}

?>