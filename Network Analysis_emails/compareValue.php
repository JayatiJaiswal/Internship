<html>
<head>
<title></title>
</head>
<body>
<div class="header" style="background-color:#fff;text-align:center; width:100%;height:10% ">
<h1>Watch List</h1>
<?php
//Connect To Database
	$host="localhost";
	$username="root";
	$password="jayati";
	$dbname="SNANEWDB";

	//Connect to database	
	mysql_connect($host,$username,$password)
	OR DIE ('Unable to connect to database! Please try again later.');
	mysql_select_db($dbname);


	//query the database
	$query1 = 'SELECT * FROM  NumMsgSent ORDER By date DESC , noofpeople desc  LIMIT 5';
	$result1 = mysql_query($query1);
	while($row1 = mysql_fetch_array($result1))
	{
        $name = $row1['senderid'];
		$value=$row1['noofpeople'];
		$result1arr[]  = array('name'=>$name,'val'=>$value);	
	}

	$query2 = 'SELECT distinct date FROM  NumMsgSent ORDER By date DESC LIMIT 2';
	$result2 = mysql_query($query2);
	while($row1 = mysql_fetch_array($result2))
	{
                $date = $row1['date'];	
	}
	
	$query3 = "SELECT  * FROM  NumMsgSent where date = '".$date."' ORDER By noofpeople desc  LIMIT 10";
	$result3 = mysql_query($query3);
	while($row1 = mysql_fetch_array($result3))
	{
        $name = $row1['senderid'];
		$value=$row1['noofpeople'];
		$result3arr[]  = array('name'=>$name,'val'=>$value);
	}
	$flag = 0;
	foreach($result1arr as $x=>$x_value)
	{
		foreach($result3arr as $y=>$y_value)
		{
	   		if($x_value['name']==$y_value['name'])
           		{
             		if($y_value['val'] > $x_value['val'])	
					{
							$img="decrease.jpg Title='Decreased but still a threat' ";
							$finalarr[]=array($x_value['name'],$x_value['val'],$img);
        	 		}
	    			if($y_value['val'] < $x_value['val'])
	     			{ 
                			$img="up.jpg Title='Increased Threat'";            
                			$finalarr[]=array($x_value['name'],$x_value['val'],$img);

	     			}
				if($y_value['val'] == $x_value['val'])
	     			{ 
                			$img="same.png Title='NoChange still spamming'";            
                			$finalarr[]=array($x_value['name'],$x_value['val'],$img);
	     			}
				$flag = 1;
  	  		}	
		}
		if($flag == 0)
		{
			$img="newentry.png Title='I am NEW'";            
                	$finalarr[]=array($x_value['name'],$x_value['val'],$img);
		}
		$flag = 0;
	}

	echo '<table border="0" style="border:3px solid olive;" align="center" ><tr><td>EMAILID</td><td>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</td><td>SPAMMING SCORE</td><td>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</td><td>STATUS</td><td></td></tr><tr></tr>';
	foreach($finalarr as $x=>$x_value)
	{
		echo "<tr><td>".$x_value[0]."</td><td>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</td><td  align='center'>".$x_value[1]."</td><td>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</td><td  align='center'><img style='width:50px; height:50px' src=".$x_value[2]."></td></tr>";
	}
	echo "</table>";
?>

</div>
</body>
</html>
