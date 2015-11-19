
<html>
	<head>
		<title>Clearance Tracker</title>
		<LINK href="css/style.php" type=text/css rel=STYLESHEET>
	
   	<script>
	function fcs() {
		document.loginform.username.focus();
	}
	</script>



</head>
	
	<body onload="fcs()">
	<BR>
	<BR>
	<BR>

	<form name="loginform" action="login_exec.php" method="post">
	<table width="309" border="0" align="center" cellpadding="2" cellspacing="5">
	 <tr>
	   <td colspan="2">

			<!--the code below is used to display the message of the input validation-->
		 <?php
			session_start ();
			if( isset($_SESSION['ERRMSG_ARR']) && is_array($_SESSION['ERRMSG_ARR']) && count($_SESSION['ERRMSG_ARR']) >0 ) {
			echo '<ul class="err">';
			foreach($_SESSION['ERRMSG_ARR'] as $msg) {
				echo '<li>',$msg,'</li>'; 
				}
			echo '</ul>';
			unset($_SESSION['ERRMSG_ARR']);
			}
		?>
		<center><h1>Clearance Tracker</h1></center>
	    </td>
	  </tr>
	<tr>

       <td width="116"><div align="right">Username</div></td>
        <td width="177"><input name="username" type="text" /></td>
        </tr>
       <tr>
      <td><div align="right">Password</div></td>
     <td><input type ="password" name="password" type="text" /></td>
     </tr>
  <tr>
    <td><div align="right"></div></td>
    <td><input name="" type="submit" value="login" /></td>
  </tr>
</table>
</form>

	</body>

</html>
