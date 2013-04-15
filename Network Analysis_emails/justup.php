<?php
	$con=mysqli_connect("localhost","root","jayati","SNANEWDB");
	if (mysqli_connect_errno())
	{
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	$result = mysqli_query($con,"SELECT distinct to_number FROM cdr_data");
	while($row = mysqli_fetch_array($result))
	{
		$result1 = mysqli_query($con,"SELECT email_address , phone_num FROM emails where phone_num = ".$row['to_number']);
		while($rownew = mysqli_fetch_array($result1))
		{
			echo $rownew['email_address']."&nbsp&nbsp&nbsp&nbsp".$rownew['phone_num']."</br>";
			mysqli_query($con,"UPDATE cdr_data SET to_number='".$rownew['email_address']."'where to_number = ".$row['to_number']);
			
		}	
	}		

?>
