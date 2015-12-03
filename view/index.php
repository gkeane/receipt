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


  <script src="../signature-pad/jquery.signaturepad.js"></script>
  <script src="sample-signature-output.js"></script>
  <table>
  <?php 
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

  
  // 5. Use PDO prepare to insert all the information into the database
  $sql = 'select id,signature,signator,ip,created from signatures order by created'; 
  foreach ($db->query($sql) as $row) {
  	print "<tr>";
  	print "<td><a href=signature.php?id=".$row['id'] . ">".$row['signator']."</td>";
  	//print "<td>".$row['signator'] . "</td>";
  	print "<td>".$row['ip'] . "</td>";
  	date_timestamp_set($date, $row['created']);
  	print "<td>".date_format($date, 'Y-m-d H:i:s') . "</td>";
  	print "</tr>";
  }

  
 
  ?>
   </table>
  <script src="../assets/json2.min.js"></script>
</body>