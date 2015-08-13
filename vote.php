<?php // content="text/plain; charset=utf-8"
// Example for use of JpGraph,
require_once ('jpgraph/jpgraph.php');
require_once ('jpgraph/jpgraph_bar.php');

//从数据库
$sql="select * from eat";

$conn=mysql_connect("localhost","root","") or die ("connect fail".mysql_error());
mysql_select_db("food",$conn) or die (mysql_error());
mysql_query("set names utf8") or die (mysql_error());
$res=mysql_query($sql,$conn) or die (mysql_error());

$datax=array();
$datay=array();
$i=0;
$title="";


while($row=mysql_fetch_array($res))
{
	$datax[$i]=$row[2];
	$datay[$i]=$row[3];

	if($i==0){
		$title=$row[1];
	}
	$i++;
}

mysql_free_result($res);
mysql_close($conn);


// We need some data
//Setup title
/*$title="";
$id=$_REQUEST['id'];
if($id==1){
	$title="早餐";
}
else if($id==2){
	$title="午餐";
}
else if($id==3){
	$title="晚餐";
}

//Setup datay
$datay=array(10,25,21,35,31);


//Setup datax
$datax="";
$id=$_REQUEST['id'];
if($id==1){
	$datax=array("面包","豆浆+油条","包子","粥","面条");
}
else if($id==2){
	$datax=array("面条","回锅肉","煎饼","其他","红烧肉");
}
else if($id==3){
	$datax=array("干锅","冒菜","米线","粥","其他");
}
*/

// Setup the graph.
$graph = new Graph(400,240);
$graph->img->SetMargin(60,20,35,75);
$graph->SetScale("textlin");
$graph->SetMarginColor("lightblue:1.1");
$graph->SetShadow();

// Set up the title for the graph
$graph->title->Set("$title");
$graph->title->SetMargin(8);
$graph->title->SetFont(FF_SIMSUN,FS_BOLD,14);
$graph->title->SetColor("darkred");

// Setup font for axis
$graph->xaxis->SetFont(FF_SIMSUN,FS_BOLD,10);
$graph->yaxis->SetFont(FF_SIMSUN,FS_BOLD,10);

// Show 0 label on Y-axis (default is not to show)
$graph->yscale->ticks->SupressZeroLabel(false);

// Setup X-axis labels
$graph->xaxis->SetTickLabels($datax);
$graph->xaxis->SetLabelAngle(0);

// Create the bar pot
$bplot = new BarPlot($datay);
$bplot->SetWidth(0.6);

// Setup color for gradient fill style
$bplot->SetFillGradient("navy:0.9","navy:1.85",GRAD_LEFT_REFLECTION);

// Set color for the frame of each bar
$bplot->SetColor("white");
$graph->Add($bplot);

// Finally send the graph to the browser
$graph->Stroke();
?>