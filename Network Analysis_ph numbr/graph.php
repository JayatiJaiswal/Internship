<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Complete Network</title>
<link rel="stylesheet" type="text/css" href="demo.css" />
<link rel="stylesheet" href="menu.css" type="text/css" media="screen" />
    	<script type="text/javascript" src="lib/vivagraph.js"></script>
    	<script type="text/javascript">
		function main () 
		{
			var d3Sample = function()
			{
			
				<?php
				
					$id =trim($_POST['mydropdownlist']);
										
					$con=mysqli_connect("localhost","root","jayati","sna");
					// Check connection
					if (mysqli_connect_errno())
	  				{
	  					echo "Failed to connect to MySQL: " . mysqli_connect_error();
	  				}

					$resultnum = mysqli_query($con," SELECT phone_num FROM emails WHERE email_address =  '".trim($id)."'");
					$count = 0;
					$num = 0;
					while($row = mysqli_fetch_array($resultnum))
	  				{
			  			$num = $row['phone_num'];
			  		}
					$result = mysqli_query($con,'SELECT distinct a.from_number, a.to_number FROM cdr_data a, cdr_data b WHERE a.from_number = '.$num.' or a.from_number = b.to_number and b.from_number = '.$num);
					$count = 0;
					while($row = mysqli_fetch_array($result))
	  				{
						$Graph[] =array($row['from_number'] , $row['to_number'] );
						$count++;
			  		}		
					print "map = ".json_encode($Graph).";\n";
					print "var count = ".$count.";\n";
					
					$resultnew = mysqli_query($con,"SELECT * FROM indpepl where accno = '".trim($num)."'");
					while($row = mysqli_fetch_array($resultnew))
	  				{
						$country = $row['country'] ;
						$trans   = $row['transaction'];
						$dt		 = $row['tdate'];
						print "var country = '".$country."';\n";
						print "var trans = ".$trans.";\n";
						print "var dt = '".$dt."';\n";
					}	
			
				?>
					
					document.getElementById("one").innerHTML = '</br></br><table><tr align="left"><td>Max Transaction To &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp:  </td><td>'+country+'</td></tr><tr align="left"><td>No. Of Transaction &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp:  </td><td>'+trans+'</td></tr><tr align="left"><td>Date Of Last Transaction :  </td><td>'+dt+'</td></tr></table>';
					var graph = Viva.Graph.graph();
					for(var i =0 ; i < count ; i++)
					{	
		    				graph.addLink(map[i][0],map[i][1]);
					}
				
					return graph;
		        	};
					var colors = [
		                "#1f77b4", "#aec7e8",
		                "#ff7f0e", "#ffbb78",
		                "#2ca02c", "#98df8a",
		                "#d62728", "#ff9896",
		                "#9467bd", "#c5b0d5",
		                "#8c564b", "#c49c94",
		                "#e377c2", "#f7b6d2",
		                "#7f7f7f", "#c7c7c7",
		                "#bcbd22", "#dbdb8d",
		                "#17becf", "#9edae5"
		                ];

		         	var example = function() {
		            		var graph = d3Sample(),
		                	communities = Viva.Graph.community().slpa(graph, 60, 0.30);
		            
		            	var layout = Viva.Graph.Layout.forceDirected(graph, {
		                	springLength : 35,
		                	springCoeff : 0.00055,
		                	dragCoeff : 0.09,
		                	gravity : -1
		            	});
		            
		            	var svgGraphics = Viva.Graph.View.svgGraphics();
		            
		            	svgGraphics.node(function(node) {
		                

					var groupId = node.communities[0].name % colors.length;
		                	//console.log(groupId);
		                	var circle = Viva.Graph.svg('circle')
		                	    .attr('r', 7)
		                	    .attr('stroke', '#fff')
		                	    .attr('stroke-width', '1.5px')
		                	    .attr("fill", colors[groupId ? groupId - 2 : 5]);
		                    
		                	circle.append('title').text('Account No: '+node.id);
		                    
		                	return circle;
		                    
		            	}).placeNode(function(nodeUI, pos){
		                	nodeUI.attr( "cx", pos.x).attr("cy", pos.y); 
		            	});
		            
		            	svgGraphics.link(function(link){
		                	return Viva.Graph.svg('line')
		                        	.attr('stroke', '#999')
		                        	.attr('stroke-width', Math.sqrt(link.data));
		            	});

		            	var renderer = Viva.Graph.View.renderer(graph, {
		                	container : document.getElementById('gall'),
		                	layout : layout,
		                	graphics : svgGraphics,
		                	prerender: 0,
		                	renderLinks : true
		            	});
		            
		            	renderer.run(500);
		            	g = graph;
		    }();

	}
	</script>
    
    	<style type="text/css" media="screen">
        	html, body, svg { width: 100%; height: 100%;}
    	</style>
<style>
<!--[if IE 6]>
<style>
body {behavior: url("csshover3.htc");}
#menu li .drop {background:url("img/drop.gif") no-repeat right 8px; 
</style>
<![endif]-->
	
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
		$id =trim($_POST['mydropdownlist']);
		$pos = strrpos($id, "@");
			$name = substr($id, 0, $pos);
		echo "<h3>Network of &nbsp&nbsp Account No: $num &nbsp&nbsp&nbspof &nbsp&nbsp&nbsp Account Name : $name</h3>";
	?>
  </div>
</div>
</div>
<div id="one" class="contents" style="position:absolute; top:25%">
</div>
<div>
</body>
</html>
