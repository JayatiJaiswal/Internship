<html>
<head>
<title>check out centrality.</title>
        <script type="text/javascript" src="lib/vivagraph.js"></script>
	<script type="text/javascript" src="lib/centrality.js"></script>
  	<script type="text/javascript">
        function main() 
	{
			//create an empty graph
			var g = Viva.Graph.graph();
			var svgGraphics = Viva.Graph.View.svgGraphics(), nodeSize = 24;
//-----------------------------------------------------------------------------------------------------------------------------------------
	
var d3Sample = function(){
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
					for(var i =0 ; i < count ; i++)
					{	
		    				g.addLink(map[i][0],map[i][1]);
					}
					return g;
		        	};
                

//-----------------------------------------------------------------------------------------------------------------------------------------
			//in and out degree centrality computation
			var inout = '<br><br><h4 align="left" style="color=red;">'+"&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspWATCH LIST"+'</h4></br>';
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
 				listcd +="<tr><td>"+cdb[i]+"</td></tr>";
 			}
			listcd +="</table>";
//-----------------------------------------------------------------------------------------------------------------------------------------
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

			var size = [6,16,15,14,12,10,9,8];
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
                    var flag = 0, si =0;
                    svgGraphics.node(function(node) {
	                var groupId = node.communities[0].name % colors.length;
			for(var chk=0 ;chk<10;chk++)
			{
				if(node.id== chkarr[chk])
				{
					flag = 1;
					si = ++chk;
					break;
				}
				else
					flag =0;
				 
			}                        
			var circle = Viva.Graph.svg('circle')
				    .attr('r', size[flag == 1 ? si: 0 ])
               		.attr('stroke', '#fff')
                    .attr('stroke-width', '1.5px')
					.attr("fill", colors[flag==1 ?  10 : groupId - 1 ]);
                    circle.append('title').text('id   : '+node.id);
					return circle;
                    }).placeNode(function(nodeUI, pos){
                        	nodeUI.attr( "cx", pos.x).attr("cy", pos.y); 
                    	});
                    svgGraphics.link(function(link){
                       	return Viva.Graph.svg('line')
                            .attr('stroke', '#C0C0C0')
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
</head>
<body onload='main()'>
<div class="header" style="background-color:#fff;text-align:center; width:100%;height:10% ">
<h1>Threat Network</h1>
</div>
</body>
</html>

