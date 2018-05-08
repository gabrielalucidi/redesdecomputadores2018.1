
<?php
	$doc = simplexml_load_file("xml/xml_pacientes.xml");
	$patientsArray = array();
	$i=0;
	foreach($doc->children() as $patient){ 
		if($patient->freezer == ''){
			array_push($patientsArray, $i);
		};
		$i++;
	};
	print_r ($patientsArray);
?>