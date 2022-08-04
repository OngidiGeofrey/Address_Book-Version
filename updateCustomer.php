<?php require_once('Connections/conn.php'); ?>
<?php

if(isset($_GET['id']))
{
    
   $email=$_GET['id'];
 
   

  
  
   
    
      
 
    

}
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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE customer SET FirstName=%s, LastName=%s, Email_address=%s, street=%s, Zip_code=%s, City_Code=%s WHERE Email_address='$email'",
                       GetSQLValueString($_POST['FirstName'], "text"),
                       GetSQLValueString($_POST['LastName'], "text"),
                       GetSQLValueString($_POST['Email_address'], "text"),
                       GetSQLValueString($_POST['street'], "text"),
                       GetSQLValueString($_POST['Zip_code'], "text"),
                       GetSQLValueString($_POST['City_Code'], "text"),
                       GetSQLValueString($_POST['S/No'], "int"));

  mysql_select_db($database_conn, $conn);
  $Result1 = mysql_query($updateSQL, $conn) or die(mysql_error());
if($Result1){
	  echo '<script>alert("Updated successfully")</script>';
	  
	  
	  }
}

mysql_select_db($database_conn, $conn);
$query_Recordset1 = "SELECT * FROM customer WHERE customer.Email_address='$email'";
$Recordset1 = mysql_query($query_Recordset1, $conn) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

mysql_select_db($database_conn, $conn);
$query_Recordset2 = "SELECT City_Name FROM cities";
$Recordset2 = mysql_query($query_Recordset2, $conn) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2);




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
   
      <fieldset><legend style="margin-left:40%">Update Customer Details</legend>
        <form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
          <table align="center">
            <tr valign="baseline">
              <td nowrap="nowrap" align="right">FirstName:</td>
              <td><input type="text" name="FirstName" value="<?php echo htmlentities($row_Recordset1['FirstName'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
            </tr>
            <tr valign="baseline">
              <td nowrap="nowrap" align="right">LastName:</td>
              <td><input type="text" name="LastName" value="<?php echo htmlentities($row_Recordset1['LastName'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
            </tr>
            <tr valign="baseline">
              <td nowrap="nowrap" align="right">Email_address:</td>
              <td><input type="text" name="Email_address" value="<?php echo htmlentities($row_Recordset1['Email_address'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
            </tr>
            <tr valign="baseline">
              <td nowrap="nowrap" align="right">Street:</td>
              <td><input type="text" name="street" value="<?php echo htmlentities($row_Recordset1['street'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
            </tr>
            <tr valign="baseline">
              <td nowrap="nowrap" align="right">Zip_code:</td>
              <td><input type="text" name="Zip_code" value="<?php echo htmlentities($row_Recordset1['Zip_code'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
            </tr>
            <tr valign="baseline">
              <td nowrap="nowrap" align="right">City_Code:</td>
              <td><select name="City_Code" value="<?php echo htmlentities($row_Recordset1['City_Code'], ENT_COMPAT, 'utf-8'); ?>">
                <?php
do {  
?>
                <option value="<?php echo $row_Recordset2['City_Name']?>"><?php echo $row_Recordset2['City_Name']?></option>
                <?php
} while ($row_Recordset2 = mysql_fetch_assoc($Recordset2));
  $rows = mysql_num_rows($Recordset2);
  if($rows > 0) {
      mysql_data_seek($Recordset2, 0);
	  $row_Recordset2 = mysql_fetch_assoc($Recordset2);
  }
?>
              </select></td>
            </tr>
            <tr valign="baseline">
              <td nowrap="nowrap" align="right">&nbsp;</td>
              <td><input type="submit" value="Update" /></td>
            </tr>
          </table>
          <input type="hidden" name="MM_update" value="form1" />
          <input type="hidden" name="S/No" value="<?php echo $row_Recordset1['S/No']; ?>" />
        </form>
        <p>&nbsp;</p>
      
      
        
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

mysql_free_result($Recordset2);


?>
