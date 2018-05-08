<?php
	// workaround to activate php error reporting
    error_reporting(E_ALL); ini_set('display_errors', '1');
	require 'php/utilFunctions.php';
?>
<!DOCTYPE html>
<html>
	<head>
	<meta charset='utf-8'>
	<title>  Pesquisa de Pacientes
	</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="libs/bootstrap/css/bootstrap.min.css">
	<script type="text/JavaScript" src="js/utilFunctions.js"></script>
	<script type="text/JavaScript" src="libs/jquery/jquery-1.11.1.min.js"></script>
	<script type="text/JavaScript" src="libs/bootstrap/js/bootstrap.min.js"></script>
	</head>

	<body>
	<div class="container">
		<div class="row">
			<div class="col-sm-6">
				<h1> Search Interface
				</h1><br>
				<img src="img/blue-line.jpg" width="975" height="25">
			</div>
			<div class="pull-right" >
				<img src="img/cern_logo.jpg" width="150" height="150">
			</div>
		</div> <br>
		<h4> Search for a patient here:
		</h4><br>
		<form class="form-inline" action="resultado.php" method="POST">
		<div class="row">
			<div class="divContainer">
				<div id='0' class="row form-group col-sm-8 divbase">
					<select name="select0" class="dropdown form-control">
						<option value="allparameters">All parameters</option>
						<?php
							$configs = loadRawConfigs();

							// prints the dropdown options
							$optionStr = "";
							foreach ($configs as $key => $key_value) {
								$optionStr .= "<option value=\"";
								$optionStr .= $key;
								$optionStr .= "\">";
								$optionStr .= $key;
								$optionStr .= "</option>";
							}
							echo $optionStr;
		                ?>
					</select>
					<input name="input0" type="text" class="form-control">
					<button  name= '0' id="hide" type="button" class="btn btn-danger form-control" onclick="delLine(this.name)" data-toggle="tooltip" data-placement="right" title="Click here to delete this line">-</button>
				</div>
			</div>
			<div class="col-sm-4">
				<button  id="plus" type="button" class="btn btn-success btn-lg" onclick="addLine()" data-toggle="tooltip" data-placement="right" title="Click here do add one more line">+</button>
			</div>
		</div>
		<br>
		<br>
		<div class="row">
			<div class="col-sm-4">
				<div class="row">
					<div class="col-sm-4">
						<button  type="submit" class="btn btn-success btn-lg">Search</button>
					</div>
					<div class="col-sm-4">
						<a href="configs.php" class="btn btn-default btn-lg glyphicon glyphicon-wrench" data-toggle="tooltip" data-placement="right" title="Click here to configure the search result "></a>
					</div>
				</div>
			</div>
			<div class="col-sm-8">
			</div>
		</div>
		</form>
	</div>
		<script type="text/javascript"> // essa parte do código é necessária para o tooltip funcionar
		$(function () {
		  $('[data-toggle="tooltip"]').tooltip();
		});
		</script>
	</body>
</html>