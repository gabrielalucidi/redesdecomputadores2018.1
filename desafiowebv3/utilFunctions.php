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

?>