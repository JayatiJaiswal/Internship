<html>
<head>
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
					$con=mysqli_connect("localhost","root","jayati","SNANEWDB");
					// Check connection
					if (mysqli_connect_errno())
	  				{
	  					echo "Failed to connect to MySQL: " . mysqli_connect_error();
	  				}
					$result = mysqli_query($con,"SELECT distinct from_number, to_number FROM cdr_data");
					$count = 0;
					while($row = mysqli_fetch_array($result))
	  				{
						$Graph[] =array($row['from_number'] , $row['to_number'] );
						$count++;
			  		}		
					print "map = ".json_encode($Graph).";\n";
					print "var count = ".$count.";\n";
			
				?>
				
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
		            
		            	svgGraphics.node(function(node) 
		                	var circle = Viva.Graph.svg('circle')
		                	    .attr('r', 7)
		                	    .attr('stroke', '#fff')
		                	    .attr('stroke-width', '1.5px');
		                	
		                	circle.append('title').text(node.id);
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
		                	container : document.getElementById('container'),
		                	layout : layout,
		                	graphics : svgGraphics,
		                	prerender: 0,
		                	renderLinks : true
		            	});
		            
		            	renderer.run(500);
		            	g = graph;
		    }();
//-----------------------------------------------------------------------------------------------------------------------------------------
			//in and out degree centrality computation
			var inout = '<br><br><h4 align="left" style="color:darkblue; font-family:georgia"><b>'+"&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspWATCH LIST"+'</b></h4></br>';
			var g = d3Sample();		
			var cd = Viva.Graph.centrality().degreeCentrality(g,'both');
			var a ='';
			var chkcount = 0;
			var cdb = new Array();
			var chkarr = new Array();
			for(var count=0 ; count<5 ; count++)
			{ 
				a ='';
				for (var i in cd[count])
				{
					a += cd[count][i]+"</td><td>&nbsp</td><td>";
					chkarr[chkcount] = cd[count]['key'];
					chkcount++;
				}
				cdb[count] = String(a); 
			}
			var listcd = "<table>";
 			for(i=0; i<cdb.length; i++)
			{
 				listcd +="<tr style='color:#8AA8BD;font-family:georgia'><td>"+cdb[i]+"</td></tr>";
 			}
			listcd +="</table>";
			
//----------------
	}
	</script>
    
    	<style type="text/css" media="screen">
        	html, body, svg { width: 100%; height: 100%;}
    	</style>
</head>
<body onload='main()'>
<div class="header" style="background-color:#fff;text-align:center; width:100%;height:10% ">
<h1>Complete Network</h1>
</div>
</body>
</html>
