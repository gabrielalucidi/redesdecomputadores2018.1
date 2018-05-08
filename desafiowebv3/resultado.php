<?php
    // workaround to activate php error reporting
    error_reporting(E_ALL); ini_set('display_errors', '1');

    // open db connection
    require 'php/open_db_connection.php';

    // get util functions
    require 'php/utilFunctions.php';
	//var_dump(returnPatientsArray($_POST));
?>

<!DOCTYPE html>
<html>
	<head>
	<meta charset='utf-8'>
	<title>  Search Interface
	</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="libs/bootstrap/css/bootstrap.min.css">
	<script type="text/JavaScript" src="js/utilFunctions.js"></script>
	<script type="text/JavaScript" src="libs/jquery/jquery-1.11.1.min.js"></script>
	<script type="text/JavaScript" src="libs/bootstrap/js/bootstrap.min.js"></script>
	<script type="text/JavaScript" src="libs/jquery/jquery.cookie.js"></script>
	<script type="text/JavaScript" src="libs/tablesorter/jquery.tablesorter.min.js"></script>
	<script type="text/JavaScript" src="libs/quicksearch/jquery.quicksearch.min.js"></script>
	<script type="text/JavaScript" src="libs/dragtable/jquery.dragtable.js"></script>
	</head>

	<body>
	<div class="container">
		<div class="row">
			<div class="col-sm-6">
				<h1> Search Interface
				</h1>
				<h3> Results
				</h3>
				<br>
				<img src="img/blue-line.jpg" width="975" height="25">
			</div>
			<div class="pull-right" >
				<img src="img/cern_logo.jpg" width="150" height="150">
			</div>
		</div> <br>
		<form class="form-inline">
			<div class="row form-group">
				<button class="btn glyphicon glyphicon-info-sign "data-toggle="tooltip" data-placement="right" title="Você pode alterar a ordem das colunas arrastando-as pelo cabeçalho. "></button>
				<input id='search' type="text" class="form-control"></input>
				<a id= 'button' class="form-control btn btn-primary btn-lg" href="index.php">Back</a>
			</div>
		</form>
		<table class="table tablesorter table-striped table-bordered table-condensed draggable forget-ordering" id="myTable" >
			<thead><tr>
			<script type="text/javascript">
			var allowedKeys = [];

			// creates the columns of the table
			var configs = <?php  echo json_encode(loadConfigs()); ?>;
			for(var key in configs){
				if(configs[key]){
				allowedKeys.push(key);
				document.write("<th>" + key + "</th>");
				}
			}
			document.write("</tr></thead>");
			document.write("<tbody>");
			// populates the table with the patient
			xmlDoc = loadXMLFile("xml/xml_pacientes.xml");
			var patientsArray = uniqueArray(<?php  echo json_encode((returnPatientsArray($_POST))) ?>);
			var x = xmlDoc.getElementsByTagName("paciente");
			patientsArray.forEach(function(y){
				document.write("<tr class=\"input-sm\">");
				for (var k = 0; k < allowedKeys.length; k++) {
					document.write("<td>");
					if(typeof x[y].getElementsByTagName(allowedKeys[k])[0] != "undefined" && typeof x[y].getElementsByTagName(allowedKeys[k])[0].childNodes[0] != "undefined"){
						document.write(x[y].getElementsByTagName(allowedKeys[k])[0].childNodes[0].nodeValue);
					}
					document.write("</td>");
				};
				document.write("</tr>");
			})
			document.write("</tbody>");
			
			$(document).ready(function() {
				$("#myTable").tablesorter();
				}
			);
			
			$('input#search').quicksearch('table tbody tr');
			
			$(function () {
				$('[data-toggle="tooltip"]').tooltip();
			});
			
			</script>
		</table>
	<script>
	</script>
	</div>
	</body>
</html>

<?php
    // close db connection
    require 'php/close_db_connection.php';
?>