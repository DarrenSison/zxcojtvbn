<!DOCTYPE html>
<html lang="en">

<head>
      <title>Registration</title><meta charset="UTF-8" />

      <link rel="stylesheet" href="pages/assets/css/style.css">

      <style type="text/css">
      body {
        background-repeat: no-repeat;
        background-size: 600px;
		background-position: center;
        background-color: #ffffff;; /* Black fallback color */
		background-color: #ffffff;; /* Black w/opacity */
      }
      </style>

</head>
<body>
<form name="reg" action="code_exec.php" onsubmit="return validateForm()" method="post">
<table width="274" border="solid 10px" align="center" cellpadding="2" cellspacing="2" style="background-color:##686667">
  <tr>
    <td colspan="2">
    <div align="left">
     
 <?php 
/* @var $_GET type */
        $remarks="";
    if ($remarks==null and $remarks=="")
    {
    echo 'Register Here';
    }
    if ($remarks=='success')
    {
    echo 'Registration Success';
    }
    ?>
        
      </div></td>
  </tr>
  <tr>
    <td style="background-color:##686667"><div align="center" style="color:#000000; font-family:life savers; font-size:18px;">Company Name:</div></td>
    <td width="171"><input type="text" name="company_name" /></td>
  </tr>
  <tr>
    <td style="background-color:##686667"><div align="center" style="color:#000000; font-family:life savers; font-size:18px;">Contact Name:</div></td>
    <td><input type="text" name="full_name" /></td>
  </tr>
  <tr>
    <td style="background-color:##686667"><div align="center">Address:</div></td>
    <td><input type="text" name="address" /></td>
  </tr>
  <tr>
    <td style="background-color:##686667"><div align="center" style="color:#000000; font-family:life savers; font-size:18px;">Phone No.:</div></td>
    <td><input type="text" name="phone_number" /></td>
  </tr>
    <tr>
    <td style="background-color:##686667"><div align="center" style="color:#000000; font-family:life savers; font-size:18px;">Landline:</div></td>
    <td><input type="text" name="landline" /></td>
  </tr>
  <tr>
    <td><div align="center"></div></td>
    <td>
    <input name="submit" type="submit" value="Submit" style="background-color:##686667" /></td>
  </tr>

  <tr>
    <td><div align="center"></div></td>
    <td>
    <a  href="login.php"><input name="aaa" type="aaa" value="Log In" style="background-color:##686667; text-align: center " /> 
        </a>
  </tr>

</table>
</form>
</body>

</html>


<script type="text/javascript">
function validateForm()
{
var a=document.forms["reg"]["company_name"].value;
var b=document.forms["reg"]["full_name"].value;
var c=document.forms["reg"]["address"].value;
var d=document.forms["reg"]["phone_number"].value;
var e=document.forms["reg"]["landline"].value;
if ((a==null || a=="") && (b==null || b=="") && (c==null || c=="") && (d==null || d=="") && (e==null || e==""))
  {
  alert("All Field must be filled out");
  return false;
  }
if (a==null || a=="")
  {
  alert("Company name must be filled out");
  return false;
  }
if (b==null || b=="")
  {
  alert("Full name must be filled out");
  return false;
  }
if (c==null || c=="")
  {
  alert("Address name must be filled out");
  return false;
  }
if (d==null || d=="")
  {
  alert("Phone Number must be filled out");
  return false;
  }
if (e==null || e=="")
  {
  alert("Landline must be filled out");
  return false;
  }
}
</script>