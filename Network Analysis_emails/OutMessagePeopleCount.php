<?php
	$con=mysqli_connect("localhost","root","jayati","SNANEWDB");
	if (mysqli_connect_errno())
	{
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	$result = mysqli_query($con,"SELECT distinct from_number FROM cdr_data");
	while($row = mysqli_fetch_array($result))
	{
		$result1 = mysqli_query($con,"SELECT count(distinct to_number) as tnum FROM cdr_data where from_number = '".$row['from_number']."'");
		//echo "hello";
		while($rownew = mysqli_fetch_array($result1))
		{//echo "hello";
			echo $row['from_number']."&nbsp&nbsp&nbsp&nbsp".$rownew['tnum']."</br>";
	mysqli_query($con,"INSERT INTO NumMsgSent VALUES (NULL, CURRENT_TIMESTAMP, '".$row['from_number']."',".$rownew['tnum'].")");
		}	
	}		

?>
