<?php
	$host="localhost";
	$username="root";
	$password="jayati";
	$dbname="sna";

	$con=mysqli_connect($host,$username,$password,$dbname);
	// Check connection
	if (mysqli_connect_errno())
  	{
  		echo "Failed to connect to MySQL: " . mysqli_connect_error();
  	}	
		$result = mysqli_query($con,"select distinct from_number from cdr_data");
		$num =1;
		$nval=0;
		while($row = mysqli_fetch_array($result))
  		{
			if($num==1)
			{
				$val = 'Pakistan';
				$nval = 10;
			}
			else
			if($num==2)
			{	
				$val = 'Iran';
				$nval = 9;
			}
			else
			if($num==3)
			{	
				$val = 'Israel';
				$nval = 8;
			}
			else
			if($num==4)
			{	
				$val = 'Afgaistan';
				$nval = 7;
			}
			else
			if($num==5)
			{	
				$val = 'Iran';
				$nval = 4;
			}
			else
			if($num==5)
			{	
				$val = 'Israel';
				$nval = 6;
			}
			else
			if($num==6)
			{	
				$val = 'Afgaistan';
				$nval = 3;
			}
			else
			if($num==7)
			{	
				$val = 'Iran';
				$nval = 2;
			}
			else
			if($num==8)
			{	
				$val = 'Israel';
			$nval = 3;
			}
			else
			if($num==9)
			{	
				$val = 'Afgaistan';
				$nval = 2;
			}
			else
			if($num==10)
			{	
				$val = 'Israel';
				$nval = 6;
			}
			else
			if($num==11)
			{	
				$val = 'Afgaistan';
				$nval = 3;
			}
			else
			if($num==12)
			{	
				$val = 'Iran';
				$nval = 2;
			}
			else
			if($num==13)
			{	
				$val = 'Israel';
			$nval = 3;
			}
			else
			if($num==14)
			{	
				$val = 'Afgaistan';
				$nval = 2;
			}
			echo $row['from_number'].",".$val.",".$nval.",".$num."</br>";
			mysqli_query($con,"INSERT INTO indpepl VALUES (NULL, '".$row['from_number']."','".$val."','".$nval."')");
			$num++;
  		}
?>
