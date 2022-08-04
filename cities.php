<?php require_once('Connections/conn.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

mysql_select_db($database_conn, $conn);
$query_Recordset1 = "SELECT * FROM cities";
$Recordset1 = mysql_query($query_Recordset1, $conn) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>KIBUGAMESANDSPORTS</title>
<script src="SpryAssets/SpryMenuBar.js" type="text/javascript"></script>
<link href="SpryAssets/SpryMenuBarHorizontal.css" rel="stylesheet" type="text/css" />
</head>

<body>
 <table width="100%" border="0">
  <tr>
    <td> <center> 
    <img src="img/logo.PNG"  /><br />
  
      <p style="margin-top:0; font-size:12px; font-family:Arial, Helvetica, sans-serif" > P.O. Box 1699 -50200 &nbsp;BUNGOMA<br />
      Tel: xxxxxxxxxxx/ xxxxxxxxx<br />
      Email: contactemailhere/<br />
web: web link here <br />
           <hr color="black" size="3" width="100%" />
    </center></td>
  </tr>
</table>
       
          <center>
            <strong>LIST OF CITIES</strong>
          </center></td>
   
</table>
<table border="1" style="border-collapse:collapse" width="100%">





</table>
<footer style="bottom:0">
  <table border="1" style="border-collapse:collapse;" width="100%">
    <tr style="font-weight:bold; text-transform:uppercase">
      <td>Number</td>
      <td>City Code</td>
      <td>City Name</td>
    </tr>
    <?php 
	$counter=1;
	
	do { ?>
      <tr>
      <td><?php echo $counter; ?></td>
        <td><?php echo $row_Recordset1['City_Code']; ?></td>
        <td><?php echo $row_Recordset1['City_Name']; ?></td>
      </tr>
      <?php $counter++; } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
  </table>
<table width="100%" border="0" style="bottom:0; position:fixed"  >

        <tr>
        <hr color="black" size="3" width="100%" style="padding:0"/>
          <td><img src="img/logo.PNG" width="500" height="75" alt="cert" /></td>
    </tr>
  </table></td>
</footer>
 
</script>
</body>


</html>
<?php
mysql_free_result($Recordset1);
?>

<?php

?>