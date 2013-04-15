<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="demo.css" />
<link rel="stylesheet" href="menu.css" type="text/css" media="screen" />
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
<script type="text/javascript" src="script.js"></script>
</head>
	
<body onload='main()'>
<div id="title">
  <div id="title1">Social Netwok Analysis</div>
</div>
<div id="main1">
  <ul id="menu2">
    <li><a href="index.php" class="drop">Home</a>
      <!-- Begin Home Item -->
      <div class="dropdown_2columns">
        <!-- Begin 2 columns container -->
        <div class="col_2">
          <h2>Welcome !</h2>
        </div>
        <div class="col_2">
          <p>Hi and welcome here ! This is just a demo application of huge possibilities of network analysis.</p>
          <p>The Application shows the network of a bank transaction, and identifies key influencers in a bank transaction network.</p>
        </div>
      </div>
      <!-- End 2 columns container -->
    </li>

    <li class="menu_right"><a href="#" class="drop">Network Graphs</a>
      <div class="dropdown_1column align_right">
        <div class="col_1">
          <ul class="simple">
            <li><a href="completeGraph.php">Complete Network</a></li>
            <li><a href="TopInfluencer.php">Top Influencers</a></li>
          </ul>
        </div>
      </div>
    </li>
	<li class="menu_right"><a href="#" class="drop">Network Report</a>
      <div class="dropdown_1column align_right">
        <div class="col_1">
          <ul class="simple">
            <li><a href="TopInfluencerStatusReport.php">Top Transaction Acc</a></li>
            <li><a href="noOfTransactions.php">No. Of Transaction</a></li>
            <li><a href="peopleInvolved.php">No. People Involved </a></li>
          </ul>
        </div>
      </div>
    </li>
	<li class="menu_right"><a href="individual.php">Network of individual</a></li>
  </ul>
  <div id="gallery">
<?php
//Connect To Database
	$host="localhost";
	$username="root";
	$password="jayati";
	$dbname="sna";

	//Connect to database	
	mysql_connect($host,$username,$password)
	OR DIE ('Unable to connect to database! Please try again later.');
	mysql_select_db($dbname);


	//query the database
	$query1 = 'SELECT * FROM  NumMsgSent ORDER By date DESC , NumMsg desc  LIMIT 10';
	$result1 = mysql_query($query1);
	while($row1 = mysql_fetch_array($result1))
	{
		$name = $row1['senderId'];
		$value=$row1['NumMsg'];
		$result1arr[]  = array('name'=>$name,'val'=>$value);
	}

	$query2 = 'SELECT distinct date FROM  NumMsgSent ORDER By date DESC LIMIT 2';
	$result2 = mysql_query($query2);
	while($row1 = mysql_fetch_array($result2))
	{
                $date = $row1['date'];
	}
	$query3 = "SELECT * FROM  NumMsgSent where date = '".$date."' ORDER By NumMsg desc  LIMIT 10";
	$result3 = mysql_query($query3);
	while($row1 = mysql_fetch_array($result3))
	{
                $name = $row1['senderId'];
				$aname ='';
				$country = '';
				$query4 = "SELECT * FROM  emails where phone_num = '".$name;
				$result4 = mysql_query($query4);
				while($row1 = mysql_fetch_array($result2))
				{
						$country = $row1['country'];
						$emid = $row1['email_id'];
						$pos = strrpos($emid, "@");
						$aname = substr($emid, 0, $pos);
						
				}
				$value=$row1['NumMsg'];
				$result3arr[]  = array('name'=>$name,'val'=>$value,'aname'=>$aname,'country'=>$country);

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
	echo '</br></br><table border="0" align="center" ><tr><td><h4>ACCOUNT NUMBER</h4></td><td>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</td><td><h4>NO. OF  TRANSACTIONS</h4></td><td>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</td><td><h4>STATUS</h4></td><td></td></tr><tr></tr>';
	foreach($finalarr as $x=>$x_value)
	{
		echo "<tr><td>".$x_value[0]."</td><td>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</td><td  align='center'>".$x_value[1]."</td><td>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</td><td  align='center'><img style='width:50px; height:50px' src=".$x_value[2]."></td></tr>";
	}
	echo "</table>";
	echo "</br></br>";
?>
</div>
</div>
</div>
</body>
</html>
