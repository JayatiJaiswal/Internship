<html>
<head>
<title></title>

</head>
<body>

<div class="header" style="background-color:#fff;text-align:center; width:100%;height:10% ">
<h1>Top Influencers</h1>
<h3>Number of Different People Involved in Communication</h3>
<?php
	$con=mysqli_connect("localhost","root","jayati","SNANEWDB");
	if (mysqli_connect_errno())
	{
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	$result = mysqli_query($con,"SELECT from_number, count(distinct to_number) as tnum FROM cdr_data group by from_number having from_number in(SELECT distinct from_number FROM cdr_data)  order by tnum desc");
	while($row = mysqli_fetch_array($result))
	{
			$result1arr[]  = array($row['from_number']=>$row['tnum']);
	}
	echo '<table border="0" style="border:3px solid olive;" align="center"><tr align="center"><td>SENDERS ID</td><td>NO. OF PEOPLE INVOLVED</td></tr>';
	foreach($result1arr as $key => $val)
	{
		foreach($val as $key1 => $val1)
			{
				echo "<tr><td>".$key1."</td><td align='center'>".$val1."</td></tr>";
			}
	}
?>
</div>
</body>
</html>
