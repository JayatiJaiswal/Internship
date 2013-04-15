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
	$con=mysqli_connect("localhost","root","jayati","sna");
	if (mysqli_connect_errno())
	{
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	$result = mysqli_query($con,"SELECT senderId , NumMsg FROM  NumMsgSent ORDER By date DESC , NumMsg desc LIMIT 5");
	echo '</br></br><table border="0" align="center"><tr ><td><h4 align="left">SENDER</h4></td><td><h4 align="right">TO NO OF PEOPLE</h4></td></tr>';
	while($row = mysqli_fetch_array($result))
	{
		
		echo "<tr><td>".$row['senderId']."</td><td align='center'>".$row['NumMsg']."</td></tr>";
			
	}
	echo "</table>";
	echo "</br></br></br>";
?>
</div>
</div>
</div>
</body>
</html>
