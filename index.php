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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO customer (FirstName, LastName, Email_address, street, Zip_code, City_Code) VALUES (%s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['FirstName'], "text"),
                       GetSQLValueString($_POST['LastName'], "text"),
                       GetSQLValueString($_POST['Email_address'], "text"),
                       GetSQLValueString($_POST['street'], "text"),
                       GetSQLValueString($_POST['Zip_code'], "text"),
                       GetSQLValueString($_POST['City_Code'], "text"));

  mysql_select_db($database_conn, $conn);
  $Result1 = mysql_query($insertSQL, $conn) or die(mysql_error());
}

$maxRows_Recordset1 = 10;
$pageNum_Recordset1 = 0;
if (isset($_GET['pageNum_Recordset1'])) {
  $pageNum_Recordset1 = $_GET['pageNum_Recordset1'];
}
$startRow_Recordset1 = $pageNum_Recordset1 * $maxRows_Recordset1;

mysql_select_db($database_conn, $conn);
$query_Recordset1 = "SELECT * FROM customer";
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
    <fieldset>
      <form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
        <table align="center">
          <tr valign="baseline">
            <td nowrap="nowrap" align="right">First Name:</td>
            <td><input type="text" name="FirstName" value="" size="32" required  placeholder="Geofrey"/></td>
          </tr>
          <tr valign="baseline">
            <td nowrap="nowrap" align="right">Last Name:</td>
            <td><input type="text"  name="LastName" value="" size="32" required placeholder="Ongidi"  /></td>
          </tr>
          <tr valign="baseline">
            <td nowrap="nowrap" align="right">Email Address:</td>
            <td><input type="email" name="Email_address" size="32" required placeholder="ongidigeofrey@gmail.com"/></td>
          </tr>
          <tr valign="baseline">
            <td nowrap="nowrap" align="right">Street:</td>
            <td><input type="text" name="street" value="" size="32"  required placeholder="Busia"/></td>
          </tr>
          <tr valign="baseline">
            <td nowrap="nowrap" align="right">Zip Code:</td>
            <td><input type="text" name="Zip_code" value="" size="32" required placeholder="50400"/></td>
          </tr>
          <tr valign="baseline">
            <td nowrap="nowrap" align="right">City :</td>
            <td><select name="City_Code" style="width:261px">
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
            <td><input type="submit" value="Add Customer" />  <input type="reset" name="Reset" id="button" value="Refresh" /></td>
          </tr>
        </table>
        <input type="hidden" name="MM_insert" value="form1" />
      </form>
      <p>&nbsp;</p>
    </fieldset>
    
    
    
    
    </center></td>
    
    <td><center>
     <fieldset>
       <table border="1" width="100%">
         <tr style="font-weight:bold">
           <td>Number</td>
           <td>First Name</td>
           <td>Last Name</td>
           <td>Email Address</td>
           <td>street</td>
           <td>Zip_code</td>
           <td>City Code</td>
         </tr>
         <?php 
		 
		 $counter=1;
		 do { ?>
           <tr style="text-transform:uppercase">
             <td><?php echo $counter; ?></td>
             <td><?php echo $row_Recordset1['FirstName']; ?></td>
             <td><?php echo $row_Recordset1['LastName']; ?></td>
             <td style="text-transform:lowercase"><?php echo $row_Recordset1['Email_address']; ?></td>
             <td><?php echo $row_Recordset1['street']; ?></td>
             <td><?php echo $row_Recordset1['Zip_code']; ?></td>
             <td><?php echo $row_Recordset1['City_Code']; ?></td>
           </tr>
           <?php
		   $counter++;
		   
		   
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

mysql_free_result($Recordset2);
?>
