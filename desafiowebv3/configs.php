<?php
    // workaround to activate php error reporting
    error_reporting(E_ALL); ini_set('display_errors', '1');

    // open db connection
    require 'php/open_db_connection.php';

    // get util functions
    require 'php/utilFunctions.php';
	
	//var_dump(returnArrayOrder ());
	
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
  <head>
	<title>  Search Interface
	</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="libs/bootstrap/css/bootstrap.min.css">
    <script type="text/JavaScript" src="js/utilFunctions.js"></script>
    <script type="text/JavaScript" src="libs/jquery/jquery-1.11.1.min.js"></script>
    <script type="text/JavaScript" src="libs/jquery/jquery.cookie.js"></script>
	<script type="text/JavaScript" src="libs/jquery/jquery-ui.min.js"></script>
	<script type="text/JavaScript" src="libs/quicksearch/jquery.quicksearch.min.js"></script>
  </head>
	<body class="container">
		<div class="row">
			<div class="col-sm-6">
				<h1> Search Interface
				</h1>
				<h3> Configurations
				</h3>
				<br>
				<img src="img/blue-line.jpg" width="975" height="25">
			</div>
			<div class="pull-right" >
				<img src="img/cern_logo.jpg" width="150" height="150">
			</div>
		</div> <br>
		<form action="configs-save.php" method="POST" class="form-inline">
			<div class="row form-group btncss">
				<input type="submit" value="Save" class="form-control btn btn-success btn-submit">
				<a href="index.php" class="form-control btn btn-danger ">Cancel</a>
				<a id='setAll' href="#" onclick="setAllCheckBoxes(true);" class="form-control btn btn-default ">Select all</a>
				<a id='setNon' href="#" onclick="setAllCheckBoxes(false);" class="form-control btn btn-default">Clean</a>
				<input id='search' type="text" class="form-control">
			</div>
			<h4> Select here the visible parameters:
			</h4> <br>
			<table id="table-settings" class="table table-hover">
				<thead></thead>
				<tbody>
					<?php
						$configs = loadConfigs();

						// prints the table rows
						$rowsStr = "";
						$i= 0;
						foreach ($configs as $key => $key_value) {
							$rowsStr .= "<tr" . ((!$key_value) ? "":" class=\"success\"") . " onclick=\"check(" . $key . ")\" id='" . $key . "'>";
							$rowsStr .= "<td>" . $i . "</td>";
							$rowsStr .= "<td class=\"text-center \"><input name=\"" . $key . "\" id=\"" . $key . "\" type=\"checkbox\" ";
							if($key_value)
								$rowsStr .="checked";
							$rowsStr .= "></td>";
							$rowsStr .= "<td>" . $key . "</td>";
							$rowsStr .= "</tr>";
							$i++;
						}
						echo $rowsStr;
					?>
				</tbody>
			</table>
		</form>
		<script type="text/javascript">
			// creates the "configs" variable, used by javascript on client side
			var configs = <?php echo json_encode($configs) ?>;

			$(document).ready(function() {
				// stop propagation of it's parent click
				$("input").click(function(event){
				  event.stopPropagation();
				});

				// handles the checkbox check event
				$("input").change(function() {
					// updates the "configs" variable. It will be used to save the configs
					//configs[this.id] = this.checked;

					// change the color of the row
					var row = $(this).parent().parent()[0];
					if(this.checked)
						row.classList.add("success");
					else
						row.removeAttribute("class");
				});
			});

			// onClick event of each row
			function check(key){
				var input = key;
				input.checked = !input.checked;
				$(input).change();
			}

			function setAllCheckBoxes(checked){
				if(checked)
					$('input:checkbox').prop('checked', true);
				else
					$('input:checkbox').removeAttr('checked');
				$("input:checkbox").change();
			}
			
			$('input#search').quicksearch('table tbody tr');
			
			var fixHelper = function(e, ui) {
			ui.children().each(function() {
				$(this).width($(this).width());
			});
			return ui;
			};
			
			$("#table-settings tbody").sortable({
				helper: fixHelper
			}).disableSelection();
		</script>
	</body>
</html>

<?php
    // close db connection
    require 'php/close_db_connection.php';
?>