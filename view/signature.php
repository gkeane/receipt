<!DOCTYPE html>
<head>
  <meta charset="utf-8">
  <title>Regenerate a Signature · Signature Pad</title>
  <style>
    body { font: normal 100.01%/1.375 "Helvetica Neue",Helvetica,Arial,sans-serif; }
    p { margin: 0.515em 0 0; padding: 0 6px; }
  </style>
  <link href="../signature-pad/jquery.signaturepad.css" rel="stylesheet">
  <!--[if lt IE 9]><script src="../assets/flashcanvas.js"></script><![endif]-->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>
</head>
<body>
  <div class="sigPad signed">
    <div class="sigWrapper">
      <canvas class="pad" width="600" height="150"></canvas>
    </div>

 

  <script src="../signature-pad/jquery.signaturepad.js"></script>
  <script src="sample-signature-output.js"></script>
  <?php 
  $id= filter_var($_GET["id"],FILTER_SANITIZE_NUMBER_INT);
  $dsn = "mysql:host=localhost;dbname=receipt";
  $user = "receipt";
  $pass = "xfQQEqZEDzXpcG6a";
  $date = new DateTime();
  // 4. Open a connection to the database using PDO
  $db = new PDO($dsn, $user, $pass);
  // Make sure we are talking to the database in UTF-8
  $db->exec('SET NAMES utf8');
  
  // Create some other pieces of information about the user
  //  to confirm the legitimacy of their signature
  $sig_hash = sha1($output);
  $created = time();
  $ip = $_SERVER['REMOTE_ADDR'];
  
  // 5. Use PDO prepare to insert all the information into the database
  $sql = 'select id,signature,signator,ip,created from signatures WHERE id='.$id.' order by created'; 
  //print $sql;
  foreach ($db->query($sql) as $row) {
  	//print $row['id'] . "\t";
  	print "<p>".$row['signator'] . "<br>";
  	date_timestamp_set($date, $row['created']);
  	print date_format($date, 'Y-m-d H:i:s') . "<br>";
  	print $row['ip'] . "</p>";
  }

  
  
  ?>
   </div>
  <script>
    $(document).ready(function() {
      $('.sigPad').signaturePad({displayOnly:true}).regenerate(<?php echo $row['signature'];?>);
    });
  </script>
  <script src="../assets/json2.min.js"></script>
</body>