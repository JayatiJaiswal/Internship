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
    <div id="slides">
      <div class="slide"><img src="img/image/img3.jpg" width="920" height="400" alt="side" /></div>
      <div class="slide"><img src="img/image/img1.jpg" width="920" height="400" alt="side" /></div>
      <div class="slide"><img src="img/image/img2.jpg" width="920" height="400" alt="side" /></div>
      <div class="slide"><img src="img/image/img4.jpg" width="920" height="400" alt="side" /></div>
    </div>
    <div id="menu1">
      <ul>
        <li class="fbar">&nbsp;</li>
        <li class="menuItem"><a href=""><img src="img/sample_slides/thumb_macbook.png" alt="thumbnail" /></a></li>
        <li class="menuItem"><a href=""><img src="img/sample_slides/thumb_iphone.png" alt="thumbnail" /></a></li>
        <li class="menuItem"><a href=""><img src="img/sample_slides/thumb_imac.png" alt="thumbnail" /></a></li>
        <li class="menuItem"><a href=""><img src="img/sample_slides/thumb_about.png" alt="thumbnail" /></a></li>
      </ul>
    </div>
  </div>
  
</div>
</div>
</body>
</html>
