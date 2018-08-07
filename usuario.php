<?php
    include "ws-security.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Usuário</title>
</head>
<body>

<?php
try 
{
    $options = array( 'location' => 'https://servicoshm.saude.gov.br/cadsus/CadsusService/v5r0', 
                    'encoding' => 'utf-8', 
                    'soap_version' => SOAP_1_2,
                    'connection_timeout' => 180,
                    'trace'        => 1, 
                    'exceptions'   => 1 );

    $client = new SoapClient('https://servicoshm.saude.gov.br/cadsus/CadsusService/v5r0?wsdl', $options);   
    $client->__setSoapHeaders(soapClientWSSecurityHeader('CADSUS.CNS.PDQ.PUBLICO', 'kUXNmiiii#RDdlOELdoe00966'));

    $function = 'Consultar';

    $arguments= array( 'cnes' => array(
                            'CNESUsuario' => array(
                                'CNES'      => 'CADSUS',
                                'Usuario'   => 'CNS.PDQ.PUBLICO',
                                'Senha'     => 'kUXNmiiii#RDdlOELdoe00966'
                            ),
                            'CNS' => array(
                                'numeroCNS' => '703404696479515'
                            )
                        )
                    );

    $result = $client->__soapCall($function, $arguments);


    print("<pre>".print_r($result,true)."</pre>");
} 
catch (Exception $e) 
{
    echo "<h2>Exception Error!</h2>";
    print("<pre>".print_r($e,true)."</pre>");
}
?>
	
</body>
</html>