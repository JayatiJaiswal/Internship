
<html>
	<head>
		<center>
		<h1>
			Individuals Network
		</h1>
		</center>
	</head>
	<title></title>
	<body bgcolor="white">
	<form action="graph.php" method='post'>
	<center>
	<br />
	<br />
	<br />

	Select Name of the person :
	<select name="mydropdownlist">

	<?php
		$con=mysqli_connect("localhost","root","jayati","SNANEWDB");
		// Check connection
		if (mysqli_connect_errno())
  		{
  			echo "Failed to connect to MySQL: " . mysqli_connect_error();
  		}

		$result = mysqli_query($con,"select distinct a.email_address from emails a , cdr_data b where a.email_address = b.from_number");

		while($row = mysqli_fetch_array($result))
  		{
			$mystring = $row['email_address'];
			$pos = strrpos($mystring, "@");
			$name = substr($mystring, 0, $pos);
			echo "<option value=\"$mystring\">$name</option>";
		}

		mysqli_close($con);
	?>
	</select>
	</br></br></br>
	<input type="submit" value ="Social Graph of Person"/>
	</form>
	</body>
</html>

