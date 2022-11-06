<?php 
//include("../path.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
    integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Candal|Lora" rel="stylesheet">

  <!-- Custom Styling -->
  <link rel="stylesheet" href="../assets/css/style.css">

  <title>Verify OTP</title>
  <link rel="stylesheet" href="https://cdn.tutorialjinni.com/intl-tel-input/17.0.8/css/intlTelInput.css"/>
<script src="https://cdn.tutorialjinni.com/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
</head>

<body>
  
   <div class="auth-content">

    <form action="verify.php" method="post">
      <h2 class="form-title"></h2>
      <div>
        <label>ENTER  NUMBER THAT RECEIVED OTP</label>
        <input type="text" name="phone"  value="" class="text-input" >
      </div>

            <div>
        <label>ENTER OTP TO VERIFY</label>
        <input type="text" name="username" value="" class="text-input" >
      </div>
      
      <button type="submit" name="verifyotp" class="btn btn-big">VERIFY OTP</button>
    </form>

  </div>
<!-- Javascript to initialize the code list -->
s

  <!-- JQuery -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

  <!-- Custom Script -->
  <script src="assets/js/scripts.js"></script>

</body>

</html>
<?php
session_start();
//Your authentication key
$authKey = "383434Adqgm1sS63406179P1";

//Sender ID,While using route4 sender id should be 6 characters long.
$senderId = "hy785kj";

if (isset($_POST["verifyotp"])) {
    # code...
        $mobileNumber = $_SESSION['mobile_Number'];
        $verifyotp = $_POST['username'];


//API URL
$url="https://api.msg91.com/api/v5/otp/verify?otp=&authkey=$authKey&mobile=$mobileNumber&otp=$verifyotp";
$curl = curl_init($url);

curl_setopt_array($curl, [
  //CURLOPT_URL => "https://api.msg91.com/api/v5/otp?template_id=&otp_expiry=&mobile=&authkey=",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => "",
  CURLOPT_HTTPHEADER => [
    "Content-Type: application/json"
  ],
]);

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  $json = json_decode($response);
  
  if ($json-> type == 'success') 
  {
    # code...
    header('location: ' . BASE_URL . '../admin/Database/createdb.php');
  }
  if ($json-> type == "error") {
    # code...
    echo 'Your OTP "'.$json-> message.'" ';
  }
}
}