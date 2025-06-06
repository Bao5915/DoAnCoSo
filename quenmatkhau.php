<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

if(isset($_POST['submit'])==true){
   $email = $_POST['email'];
    $sql = "SELECT * FROM `users` WHERE email = ?";
   $stmt = $conn->prepare($sql);
   $stmt->execute([$email]);
   $row = $stmt->fetch(PDO::FETCH_ASSOC);
   $count = $stmt ->rowCount();
 if ($count==0){
   $message[] = 'Email chưa đăng ký!';
 }
 else{
   $matkhaumoi = substr(md5 (rand(0,999999)) , 0, 8) ;
   $sql = "UPDATE users SET password= ? WHERE email = ? ";
   $stmt = $conn->prepare($sql);
   $stmt->execute([$matkhaumoi,$email ]);
   $kq=guimatkhaumoi($email, $matkhaumoi);
   if ($kq==true){
      $message[] = 'Mật khẩu mới của bạn đã được gửi qua mail!';
   }
 }
}
?>
<?php
   function guimatkhaumoi($email, $matkhaumoi){
   require "PHPMailer-master/src/PHPMailer.php"; 
    require "PHPMailer-master/src/SMTP.php"; 
    require 'PHPMailer-master/src/Exception.php'; 
    $mail = new PHPMailer\PHPMailer\PHPMailer(true);//true:enables exceptions
    try {
        $mail->SMTPDebug = 0; //0,1,2: chế độ debug
        $mail->isSMTP();  
        $mail->CharSet  = "utf-8";
        $mail->Host = 'smtp.gmail.com';  //SMTP servers
        $mail->SMTPAuth = true; // Enable authentication
        $mail->Username = 'quocbao200477@gmail.com'; // SMTP username
        $mail->Password = 'woxs mbvg qule mcml';   // SMTP password
        $mail->SMTPSecure = 'ssl';  // encryption TLS/SSL 
        $mail->Port = 465;  // port to connect to                
        $mail->setFrom('datphna@gmail.com', 'Admin Anh Iem Rọt' ); 
        $mail->addAddress($email); 
        $mail->isHTML(true);  // Set email format to HTML
        $mail->Subject = 'Thư gửi lại mật khẩu';
        $noidungthu = "
        <i><p>Lưu ý: Đây là email được gửi tự động từ hệ thông, vui lòng không phản hồi lại email này. Nếu có vấn đề thắc mắc, Quý khách có thể liên hệ với <b>AnhIemRot_Shop</b> tại http://localhost/AnhIemRot_Shop/ !</p></i>
            <p>Bạn nhận được mail này, do bạn hoặc ai đó yêu cầu mật khẩu mới từ website <b>AnhIemRot_Shop</b>. </p>
            Mật khẩu của bạn là: <b>{$matkhaumoi}</b>
            <i><p>Lưu ý: Nếu bạn không phải là người yêu cầu thay đổi mật khẩu, vui lòng bỏ qua email này !</p></i>
            <p>Cảm ơn bạn đã tin tưởng lựa chọn <b>AnhIemRot_Shop</b>!</p>
            <p>Trân trọng!</p>
        "; 
        $mail->Body = $noidungthu;
        $mail->smtpConnect( array(
            "ssl" => array(
                "verify_peer" => false,
                "verify_peer_name" => false,
                "allow_self_signed" => true
            )
        ));
        $mail->send();
        return true;
    } catch (Exception $e) {
        echo 'Error: ', $mail->ErrorInfo;
        return false;
    }
   }
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Anh Iem Rọt - Quên mật khẩu</title>
   
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body class="body-bg" >
   
<?php include 'components/user_header.php'; ?>

<section class="form-container">

   <form action="" method="post">

      <h3>Quên mật khẩu</h3>
      <input type="hidden" name="prev_pass" value="<?= $fetch_profile["password"]; ?>">
      <input type="email" name="email" required placeholder="Nhập vào Email" maxlength="50"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="submit" value="Gửi" class="btn" name="submit">
      <p>Bạn đã có tài khoản? <a href="dangnhaptaikhoan.php" class="click"><b ><i>Đăng nhập</i></b></a></p>
      <p>Bạn đã chưa có tài khoản? <a href="dangkytaikhoan.php" class="click"><b><i>Đăng ký ngay</i></b></a></p>
   </form>

</section>













<?php include 'components/footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>