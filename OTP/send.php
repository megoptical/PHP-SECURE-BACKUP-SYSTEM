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

  <title>SEND OTP</title>
  <link rel="stylesheet" href="https://cdn.tutorialjinni.com/intl-tel-input/17.0.8/css/intlTelInput.css"/>
<script src="https://cdn.tutorialjinni.com/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
</head>

<body>
  
   <div class="auth-content">

    <form method="post">
      <h2 class="form-title"></h2>

            <div>
        <label>PHONE</label>
        <input type="text" name="number" value="" class="text-input" >
      </div>
      
      <button type="submit" name="sendotp" class="btn btn-big">SEND OTP</button>
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
$authKey = "383434Alt4eXJxywl63450f1cP1";

//Sender ID,While using route4 sender id should be 6 characters long.
$senderId = "hy785kj";

if (isset($_POST["sendotp"])) {
    # code...
    $_SESSION['mobile_Number'] = $_POST["number"];
    $mobileNumber=$_SESSION['mobile_Number'];

//Your message to senissd, Add URL encoding here.
$message = "Murife dont run: Your Verification  OTP code is ##OTP##";
//Prepare you post parameters
$postData = array(
    'authkey' => $authKey,
    'mobiles' => $mobileNumber,
    'message' => $message,
    'sender' => $senderId,
    
);
//API URL
$url="http://api.msg91.com/api/sendotp.php";


$curl = curl_init($url);

curl_setopt_array($curl, array(
  //CURLOPT_URL => "https://api.msg91.com/api/v5/flow/",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => $postData,
  CURLOPT_SSL_VERIFYHOST => 0,
  CURLOPT_SSL_VERIFYPEER => 0,
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) 
{
  echo "cURL Error #:" . $err;
} 
else
{
  $json = json_decode($response);
  
  if ($json-> type == 'success') 
  {
    # code...
    header('location: verify.php');
  }
  if ($json-> type == "error") {
    # code...
    echo 'Your OTP "'.$json-> message.'" ';
  }
}
}





