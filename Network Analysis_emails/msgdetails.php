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
					if (mysqli_connect_errno())
	  				{
	  					echo "Failed to connect to MySQL: " . mysqli_connect_error();
	  				}

					$result = mysqli_query($con,"SELECT from_number,to_number FROM cdr_data");
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

				var size = [
                        20,18,16,14,12,10,8,6
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
                        var circle = Viva.Graph.svg('circle')
                            .attr('r', node.id==11 ?  15 : 7 )
                            .attr('stroke', '#fff')
                            .attr('stroke-width', '1.5px');
			                circle.append('title').text('id   : '+node.id);
                            return circle;
               			}).placeNode(function(nodeUI, pos){
                        	nodeUI.attr( "cx", pos.x).attr("cy", pos.y); 
                    	});
                    	svgGraphics.link(function(link){
                        	return Viva.Graph.svg('line')
                                .attr('stroke', '#111')
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
//-----------------------------------------------------------------------------------------------------------------------------------------
			//in and out degree centrality computation
			var cd = Viva.Graph.centrality().degreeCentrality(g,'both');
			var a ='';
			var cdb = new Array();
			for(var count=0 ; count<cd.length ; count++)
			{ 
				a ='';
				for (var i in cd[count])
				{
					a += i +'</td><td>'+cd[count][i]+'&nbsp&nbsp';
				}
				cdb[count] = String(a); 
			}
			
//-----------------------------------------------------------------------------------------------------------------------------------------
			//in and out degree centrality computation
			var cd2 = Viva.Graph.centrality().degreeCentrality(g,'in');
			var a ='';
			var cdc = new Array();
			for(var count=0 ; count<cd2.length ; count++)
			{ 
				a ='';
				for (var i in cd2[count])
				{
					a += ''+cd2[count][i]+'</td><td>';
				}
				cdc[count] = String(a); 
			}
//-----------------------------------------------------------------------------------------------------------------------------------------
			//in and out degree centrality computation
			var cd3 = Viva.Graph.centrality().degreeCentrality(g,'out');
			var a ='';
			var cdd = new Array();
			for(var count=0 ; count<cd3.length ; count++)
			{
				a ='';
				for (var i in cd3[count])
				{
					a += cd3[count][i]+'</td><td>';
				}
				cdd[count] = String(a); 
			}

//-----------------------------------------------------------------------------------------------------------------------------------------

			var bet = '<h4>'+'BETWEENESS CENTRALITY'+'</h4>';
			var cd1 = Viva.Graph.centrality().betweennessCentrality(g,'');			
			var cd1b = new Array();
			for(var count=0 ; count<cd1.length ; count++)
			{ 
				a ='';
				for (var i in cd1[count])
				{
					a += i +'</td><td>'+cd1[count][i]+'&nbsp&nbsp';
				}
				cd1b[count] = String(a); 
			}
			var listcd = '<table border="0" style="border:3px solid olive;" align="center"><tr align="center"><td><h4>NO. OF MESSAGE RECEIVED</h4></td><td></td><td>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</td><td><h4>NO. OF MESSAGE SENT</h4></td></tr>';
 			for(i=0; i<cdb.length; i++)
			{
 				listcd +="<tr><td>"+cdc[i]+"</td><td>"+cdd[i]+"</td></tr>";
 			}
			listcd +="</table>";
 			document.getElementById("container").innerHTML=listcd;
//-----------------------------------------------------------------------------------------------------------------------------------------
		}();
	}
	</script>

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
<h1>Top Mailers</h1>
<h3>Message Activity Details</h3>
</div>
<div id="one" class="contents" style="position:absolute; top:15%">
</div>
<div id="container" class="contents"  style="position:absolute; top:10%;left:18%">
</div>
<div id="two" style="background-color:#fff;width:100%;height:10%" >
</div>
</body>
</html>
