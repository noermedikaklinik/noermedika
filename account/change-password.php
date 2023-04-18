<?php
include "akses.php";
?>


<style>
@media screen and (min-width: 279px) 
{
*{margin:0px auto; /*supaya layer otomatis mengisi dan ke tengah*/}
#wrapper1{width:100%;position:relative;}
#header1{width:100%;position:fixed;height:120px;z-index:1000;}
#header1 a.title{color:#f0f0f0; font-weight:bold; text-decoration:none; font-size:30px; line-height:60px;padding:0px 20px;}
}

@media screen and (min-width: 479px) 
{
*{margin:0px auto; /*supaya layer otomatis mengisi dan ke tengah*/}
#wrapper1{width:100%;position:relative;}
#header1{width:100%;position:fixed;height:120px;z-index:1000;}
#header1 a.title{color:#f0f0f0; font-weight:bold; text-decoration:none; font-size:30px; line-height:60px;padding:0px 20px;}
}

@media screen and (min-width: 679px) 
{
*{margin:0px auto; /*supaya layer otomatis mengisi dan ke tengah*/}
#wrapper1{width:100%;position:relative;}
#header1{width:100%;position:fixed;height:120px;z-index:1000;}
#header1 a.title{color:#f0f0f0; font-weight:bold; text-decoration:none; font-size:30px; line-height:60px;padding:0px 20px;}
}

@media screen and (min-width: 1280px) 
{
*{margin:0px auto; /*supaya layer otomatis mengisi dan ke tengah*/}
#wrapper1{width:100%;position:relative;}
#header1{width:100%;position:fixed;height:120px;z-index:1000;}
#header1 a.title{color:#f0f0f0; font-weight:bold; text-decoration:none; font-size:30px; line-height:60px;padding:0px 20px;}
}

body{font-family:verdana, sans-serif;font-size:14px; color:#ggg;background:#fff;}
.link {background:#eeeceb;height:50px;color:#ggg;}
.link:hover {background:#e5c309;height:40px;color:#ggg;}

#header{
    height:90px;
    line-height:15px;
    position:fixed;
    top:0px;
    z-index:1000;
    width:100%;
}

input[type=text],input[type=password],select,input[type=number],input[type=file]
{
    font-size: 14px;
    width: 100%;
    padding: 15px 10px;
    margin: 8px 0;
    box-sizing: border-box;
    border: 2px solid #ccc;
    -webkit-transition: 0.5s;
    transition: 0.5s;
    outline: none;
    background-size: 30px;
    background-position: 5px 5px;
    background-repeat: no-repeat;
    padding-left: 10px;
    border-radius: 5px;
}

input[type=text]:focus {background:#e4dab2;border: 2px solid #f0ca34;}
select:focus {background:#e4dab2;border: 2px solid #f0ca34;}
input[type=number]:focus {background:#e4dab2;border: 2px solid #f0ca34;}

input[type=submit],input[type=reset]{
    font-size: 14px;
    background: #009973;
    color: white;
    border: white 3px solid;
    border-radius: 5px;
    padding: 12px 20px;
    cursor:pointer;
    margin-top: 10px;
    width:125px;    
    -webkit-transition: 0.5s;
    transition: 0.5s;
}

input[type=submit]:hover,input[type=reset]:hover{
    opacity:0.9;width:150px;
}

input[type=reset]{
    background:  #999999;
}
</style>

<?php
$ket= $_GET['message'];
if ($ket <> ""){$message = "<td height='50'><font size='2' color='red'>$ket</font></td></tr>";}
if ($ket == ""){$message = "<td>&nbsp;</td></tr>";}
?>


<table width="95%" align="center" style="margin-top:25px;">
<td><font size="3"><b>Change Password</b><hr></font></td>
</table>

<form name="login" method="post" action="save-data">
<input type="hidden" name="jenis" value="account-change-password">
    
<table width="95%" align="center">
<?php echo "$message"; ?>
<td>Old Password</td></tr>
<td><input type="text" name="old_password" maxLength="6" autocomplete="off" required></td></tr>
<td>New Password</td></tr>
<td><input type="text" name="new_password1" maxLength="6" autocomplete="off" required></td></tr>
<td>Repeat New Password</td></td></tr>
<td><input type="text" name="new_password2" maxLength="6" autocomplete="off" required></td></tr>
<td><input type="submit" value="Submit"> &nbsp; <input type="reset" value="Reset"></td></tr>
</table>

