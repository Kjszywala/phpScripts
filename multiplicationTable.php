<html>
<head>
  <meta charset="utf-8">
  <title>Login</title>
  <style>
	body { background-color: teal; color: #FFFFFF; }
	input[type="text"]{ text-align:center; }
  </style>
</head>
<body>
<br><center>
<b>Enter the range of the multiplication table</b></br></br>
<form method=POST>
  <b>From </b>
  <input type="text" name="od" maxlength="10" size="5"/>
  <b> To </b>
  <input type="text" name="do" maxlength="10" size="5"/>
  <input type=submit name="test" id="test" value='Show Table' style='background-color: pink;'></br></br>
</form>
<table border='1'>
<?php 
    if(array_key_exists('test',$_POST)){
      echo '<tr>';
      echo '<th></th>';
      $from = $_POST['od'];
      $to = $_POST['do'];
      $from1 = $from;
      $from2 = $from;

      for($from; $from<=$to; $from++)
      {
          echo '<th>' . $from . '</th>';
      }
      echo '</tr>';
      for($from1; $from1<=$to; $from1++)
      {
          echo '<tr><th>' . $from1 . '</th>';
          for($k=$from2; $k<=$to; $k++)
          {
              $result = $from1 * $k;
              echo '<td>' . $result . '</td>';
          }
          echo '</tr>';
      }
    }
?> 
</table>
</center>
</body>
</html>
