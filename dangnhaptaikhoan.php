<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

if(isset($_POST['submit'])){

   $email = $_POST['email'];
   $email = filter_var($email);
   $pass = $_POST['pass'];
   $pass = filter_var($pass);

   $select_user = $conn->prepare("SELECT * FROM `users` WHERE email = ? AND password = ?");
   $select_user->execute([$email, $pass]);
   $row = $select_user->fetch(PDO::FETCH_ASSOC);

   if($select_user->rowCount() > 0){
      $_SESSION['user_id'] = $row['id'];
      header('location:home.php');
   }else{
      $message[] = 'Tên dăng nhập hoặc mật khẩu không chính xác!';
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Anh Iem Rọt - Đăng nhập</title>
   
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body class="body-bg" >
   
<?php include 'components/user_header.php'; ?>

<section class="form-container" >

   <form action="" method="post" >
      <h3>Đăng nhập</h3>
      <input  type="email" name="email" required placeholder="Nhận vào Email" maxlength="50"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="password" name="pass" required placeholder="Nhập vào mật khẩu" maxlength="20"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="submit" value="Đăng nhập" class="btn" name="submit">
      <p>Bạn quên mật khẩu? <a href="quenmatkhau.php"  class="click"><i><b>Quên mật khẩu</b></i></a></p>
      <p>Bạn chưa có tài khoản? <a href="dangkytaikhoan.php" class="click"><i><b>Đăng ký ngay</b></i></a></p>
     
   </form>

</section>













<?php include 'components/footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>