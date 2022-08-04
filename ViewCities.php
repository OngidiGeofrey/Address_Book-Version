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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}



$maxRows_Recordset1 = 10;
$pageNum_Recordset1 = 0;
if (isset($_GET['pageNum_Recordset1'])) {
  $pageNum_Recordset1 = $_GET['pageNum_Recordset1'];
}
$startRow_Recordset1 = $pageNum_Recordset1 * $maxRows_Recordset1;

mysql_select_db($database_conn, $conn);
$query_Recordset1 = "SELECT * FROM cities";
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
<title>BMW_Test</title>
<script src="SpryAssets/SpryMenuBar.js" type="text/javascript"></script>
<link href="SpryAssets/SpryMenuBarHorizontal.css" rel="stylesheet" type="text/css" />
</head>



<body>
<header>
<table width="100%" border="0" style="margin-top:5px" >
  <tr>
    <td><center><img src="img/logo.PNG" alt="logo"/></center></td>
  </tr>
</table>
</header>

<nav>

<table width="100%" border="0" height="100px">
  <tr>
    <td><ul id="MenuBar1" class="MenuBarHorizontal">
      <li><a class="MenuBarItemSubmenu" href="#">Customer</a>
        <ul>
          <li><a href="addCustomer.php">Add Customer</a></li>
          <li><a href="viewCustomer.php">ViewCustomer</a></li>
</ul>
      </li>
      <li><a href="#" class="MenuBarItemSubmenu">Cities</a>
        <ul>
          <li><a href="addCity.php">Add City</a></li>
          <li><a href="ViewCities.php">ViewCities</a></li>
        </ul>
      </li>
      <li><a href="#" class="MenuBarItemSubmenu">Reports</a>
        <ul>
          <li><a href="customers.php">Customers.php</a></li>
          <li><a href="cities.php">Cities</a></li>
        </ul>
      </li>
    </ul></td>
  </tr>
</table>
</nav>


<table width="100%" border="0">
  <tr>
    
    
    <td><center>
    <fieldset> <legend style="margin-left:50%">Available Cities</legend>
      <table border="1" width="100%" style="border-collapse:collapse">
        <tr style="text-transform:uppercase;">
        <td>Number</td>
          <td>City Code</td>
          <td>City Name</td>
          <td>Operation</td>
        </tr>
        <?php 
		$inc=1;
		
		
		do { ?>
          <tr>
           <td><?php echo $inc; ?></td>
            <td><?php echo $row_Recordset1['City_Code']; ?></td>
            <td><?php echo $row_Recordset1['City_Name']; ?></td>
             <td>
               
               <button><a href="updateCity.php? id=<?php echo $row_Recordset1['City_Code']; ?>" class=                 "text-light">Update</a></button><br><br>
               
               </td>
          </tr>
          <?php
		  $inc++;
		  
		  
		   } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
      </table>
    </fieldset>
    
    
    
    
    </center></td>
    
    
  </tr>
</table>

<table width="100%" height="20%" border="0" bgcolor="blue" style="bottom:0 ; position:fixed; margin:0" >
  <tr>
    <td><center><p style="color:white">&copy; &nbsp;&nbsp;Lodur Softwares. All rights Reserved <?php echo date("Y"); ?></p> 
    
    </center></td>
  </tr>
</table>
<script type="text/javascript">
var MenuBar1 = new Spry.Widget.MenuBar("MenuBar1", {imgDown:"SpryAssets/SpryMenuBarDownHover.gif", imgRight:"SpryAssets/SpryMenuBarRightHover.gif"});
</script>
</body>
</html>
<?php
mysql_free_result($Recordset1);
?>
