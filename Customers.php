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

$maxRows_Recordset1 = 10;
$pageNum_Recordset1 = 0;
if (isset($_GET['pageNum_Recordset1'])) {
  $pageNum_Recordset1 = $_GET['pageNum_Recordset1'];
}
$startRow_Recordset1 = $pageNum_Recordset1 * $maxRows_Recordset1;

mysql_select_db($database_conn, $conn);
$query_Recordset1 = "SELECT FirstName, LastName, Email_address, street,City_Code FROM customer";
$query_limit_Recordset1 = sprintf("%s LIMIT %d, %d", $query_Recordset1, $startRow_Recordset1, $maxRows_Recordset1);
$Recordset1 = mysql_query($query_limit_Recordset1, $conn) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);

if (isset($_GET['totalRows_Recordset1'])) {
  $totalRows_Recordset1 = $_GET['totalRows_Recordset1'];
} else {
  $all_Recordset1 = mysql_query($query_Recordset1);
  $totalRows_Recordset1 = mysql_num_rows($all_Recordset1);
}
$totalPages_Recordset1 = ceil($totalRows_Recordset1/$maxRows_Recordset1)-1;
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
            <strong>LIST OF CUSTOMERS</strong>
          </center></td>
   
</table>
<table border="1" style="border-collapse:collapse" width="100%">



</table>
<footer style="bottom:0">
  <table border="1" width="100%" style="border-collapse:collapse">
    <tr style="font-weight:bold; text-transform:uppercase">
     <td>Number</td>
      <td>FirstName</td>
      <td>LastName</td>
      <td>Email Address</td>
      <td>street</td>
       <td>City</td>
    </tr>
    <?php 
	$inc=1;
	
	do { ?>
      <tr>
      <td><?php echo $inc; ?></td>
        <td><?php echo $row_Recordset1['FirstName']; ?></td>
        <td><?php echo $row_Recordset1['LastName']; ?></td>
        <td><?php echo $row_Recordset1['Email_address']; ?></td>
        <td><?php echo $row_Recordset1['street']; ?></td>
        <td><?php echo $row_Recordset1['City_Code']; ?></td>
      </tr>
      <?php
	  $inc++; } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
  </table>
<table width="100%" border="0" style="bottom:0; position:fixed" >

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
