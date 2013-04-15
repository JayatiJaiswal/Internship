<html>
<head>
    	<title>SNA GRAPH</title>
    	<script type="text/javascript" src="lib/vivagraph.js"></script>
    	<script type="text/javascript">
		function main () 
		{
			var d3Sample = function()
			{			
				<?php
				
					$id =trim($_POST['mydropdownlist']);							
					$con=mysqli_connect("localhost","root","jayati","SNANEWDB");
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

					$result = mysqli_query($con,"SELECT distinct a.from_number, a.to_number FROM cdr_data a, cdr_data b WHERE a.from_number = '".$id."' or a.from_number = b.to_number and b.from_number = '".$id."'");
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
		                "black", "#ffbb78",
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
		               	var circle = Viva.Graph.svg('circle')
		               	    .attr('r', 7)
		               	    .attr('stroke', '#fff')
		               	    .attr('stroke-width', '1.5px')
		               	    .attr("fill", colors[node.id == '<?php echo $id; ?>' ? 2 : 5]);
		                   
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

	}
	</script>
    
    	<style type="text/css" media="screen">
        	html, body, svg { width: 100%; height: 100%;}
    	</style>
<style>

#container
{
width:60%;
height:100%;
margin-top:5%;
background-color:#fff; 
position:absolute;
}

.contents
{
background-color:#fff;
text-align:center; 
width: 15%; 
height:100%;
display:inline-block;
padding:10px;
	
}

</style>

</head>
<body onload='main()'>
<div class="header" style="background-color:#fff;text-align:center; width:100%;height:10% ">

<?php
$id =trim($_POST['mydropdownlist']);
echo "<h1>Network of $id</h1>";
?>
</div>
</body>
</html>
