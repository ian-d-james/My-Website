<!DOCTYPE HTML>
<!--
	Boiled Frog - Climate Change Awareness and Strategy
	Ian D James
-->
<html>
	<head>
 		<title>Boiled Frog - Climate Change Resources - Searchable Database</title>
		<meta name="description" content="Climate Change Resources">
		<meta name="author" content="Ian James">
		<meta charset="utf-8" />
		<meta name="keywords" content="environment, climate, change, global, warming, greenhouse, enhanced, effect, accountability, criminality, cuplability, IPCC, NASA">
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="assets/css/main.css" />
		<link rel="stylesheet" href="assets/css/table.css" />

		<!-- Global site tag (gtag.js) - Google Analytics -->
		<script async src="https://www.googletagmanager.com/gtag/js?id=UA-58191121-2"></script>
		<script>
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());

		gtag('config', 'UA-58191121-2');
		</script>

	</head>

	<?php

	include('connection.php');
	include('function.php');
	
	$myCondition = Array();
	if(isset($_REQUEST["name"]) && strlen($_REQUEST["name"]) > 0){
		$name = $_REQUEST["name"];
		array_push($myCondition," name LIKE '%".trim($name)."%' OR id LIKE '%".trim($name)."%'");
	}
	else
		$name = "";
	
	if(count($myCondition) > 0)
		$myCondition = " WHERE (".implode(" AND ", $myCondition).")";
	else
		$myCondition = "";
	
	if(!isset($_REQUEST["cpage"]) || intval($_REQUEST["cpage"])==0)
	$cpage=1;
	else
		$cpage = $_REQUEST["cpage"];

	$pagesize = 10;

	$startdisp = $pagesize*($cpage-1);
	
	$qry .= "select * from names $myCondition";
	$qry .= " LIMIT $startdisp,$pagesize";
	$count = "select count(*) from names $myCondition";
	
	$res = mysql_query($qry) or die ('Error :: in fetch data<br>'.mysql_error());
	$total_res = mysql_num_rows($res);
	$res_count = mysql_query($count) or die ('Error :: in count result<br>'.mysql_error());
	
	if($tcount=mysql_fetch_array($res_count))
		$fcount = $tcount[0];
	else
		$fcount = 1;
	
	$TotalPages = ceil(($fcount)/$pagesize);
	mysql_free_result($res_count);

?>

<body class="subpage">

<!-- Header -->
<?php include 'header.html';?>

<!-- Nav -->
<?php include 'navigation.html';?>

	<!-- One -->

	<section id="One" class="wrapper style3">
		<div class="inner">
			<header class="align-center">
				<p>Online References</p>
				<h2>Links to Climate Change Sites and Articles</h2>
			</header>
		</div>
	</section>

		<!-- Two -->

	<section id="two" class="wrapper style2">
			<div class="inner">
				<div class="box">
					<div class="content">
						<header class="align-center">
							<p>Chinonye J. Chidolue</p>
							<h2>"The river of knowledge has no depth"</h2>
						</header>

							<!-- user filter template -->
						<form name="search_frm" id="search_frm" method="get" action="references.php" enctype="multipart/form-data">
							<div>
								<h3 style="margin-bottom:0px;">&nbsp;Article Search</h3>
								<input style="width:500px; float:left; margin-top:10px; margin-right:10px;" type="text" name="name" value="<?php echo setGPC($name,"display"); ?>"/>
								<button style="margin-top:10px;" type="submit">Search</button>
								<input name="btnfilter" type="button" class="btn-blue" value="Clear" onclick="javascript:window.location='references.php';">
							</div>
						</form>
						<br>
						<form name="frm1" method="get" id="frm1" action="references.php" enctype="multipart/form-data">
							<table class="blueTable">
								<tr>
									<th>ID</th>
									<th>Article Name</th>
									<th>Article URL</th>
									<th>Category</th>
								</tr>
								<?php if($total_res>0){ ?>
								<?php while($row = mysql_fetch_array($res)){ ?>
								<tr>
									<td><?php echo $row['id']; ?></td>
									<td style="width:500px;"><?php echo $row['name']; ?></td>
									<td><a style="text-decoration:none;" target="_blank" href="<?php echo $row['url']; ?>"><?php echo $row['url']; ?></a></td>
									<td><?php echo $row['category']; ?></td>
								</tr>
								<?php }}else{ ?>
								<tr>
									<td colspan="2" align="center">No results found</td>
								</tr>
								<?php } ?>
								<input type="hidden" name="cpage">
								<input type="hidden" name="name" value="<?php echo setGPC($name,"display")?>" />
							</table>
						
						</form>

						<?php DisplayPages($cpage,$TotalPages, "frm1","Admin_Link"); ?>


					</div>
				</div>
			</div>
	</section>							

<!-- One -->
	<section id="One" class="wrapper style3">
		<div class="inner">
			<header class="align-center">
				<p>Knowledge is Power</p>
				<h2>Resources to Educate, Embolden and Empower</h2>
			</header>
		</div>
	</section>

<!-- Footer -->
<?php include 'footer.html';?>

</body>
</html>