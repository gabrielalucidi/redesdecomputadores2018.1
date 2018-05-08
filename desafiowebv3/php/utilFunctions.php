<?php
// loads all the patients properties from the xml document
function loadRawConfigs(){
    // loading the xml document
    $xmlFileName = "xml/xml_pacientes.xml";
    $doc = new DOMDocument();
    $doc->load($xmlFileName);

    // get ALL the xml tags, except "doc" and "paciente"
    $xpath = new DOMXpath( $doc );
    $nodes = $xpath->query( '//*' );
    $configs = array();
    foreach( $nodes as $node )
    {
        $configs[ $node->nodeName ] = false;  // associentive array mode
    }
    unset($configs["doc"]);
    unset($configs["paciente"]);

    return $configs;
}

// does the same loadRawConfigs functions, plus load user's preferences from DB
function loadConfigs(){
    // loading the xml document
    $xmlFileName = "xml/xml_pacientes.xml";
    $doc = new DOMDocument();
    $doc->load($xmlFileName);

    // get ALL the xml tags, except "doc" and "paciente"
    $xpath = new DOMXpath( $doc );
    $nodes = $xpath->query( '//*' );
    $configs = array();
    foreach( $nodes as $node )
    {
        $configs[ $node->nodeName ] = false;  // associentive array mode
    }
    unset($configs["doc"]);
    unset($configs["paciente"]);

    // get preferences of the user from the DB
    global $conn;
    $sql = "SELECT setting FROM preference WHERE user = 1";
    $result = $conn->query($sql);

    // update all the container of the configs with the preferences
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $configs[$row["setting"]] = true;
        }
    }

    return $configs;
}

//function returnArrayOrder (){
	//$configs = loadConfigs();
	//$array= Array();
	//foreach($configs as $x => $x_value) {
	//	if($x_value){
	//	$pos = echo <script type="text/JavaScript"> console.log(document.getElementById($x).rowIndex);</script>;
	//	array_push($array,$pos);
	//	}
	//}
	//return $array;
//}

//return an array with the index number of the patients with the chosen parameters
function returnPatientsArray($post){
	$doc = simplexml_load_file("xml/xml_pacientes.xml");
	$postParameterArray= array();
	$postValueArray= array();
	$patientsArray = array();
	$configs = loadRawConfigs();
	$i=0;
	foreach($post as $x => $x_value) {
		if($i%2 == 0){
			array_push($postParameterArray, $x_value );
		}
		else{
			array_push($postValueArray, $x_value );
		}
		$i++;
	}
	for ($y = 0; $y < count($postParameterArray); $y++) {
		if ( $postParameterArray[$y] == 'allparameters'){
			foreach ($configs as $key => $key_value) {
			$j=0;
				foreach($doc->children() as $patient) { 
					if($patient->$key == $postValueArray[$y]){
						array_push($patientsArray, $j);
					}
					$j++;
				}
			}
		}
		else{
			$j=0;
			foreach($doc->children() as $patient) { 
				if($patient->$postParameterArray[$y] == $postValueArray[$y]){
					array_push($patientsArray, $j);
				}
				$j++;
			}
		}
	}
	return $patientsArray;
}

?>