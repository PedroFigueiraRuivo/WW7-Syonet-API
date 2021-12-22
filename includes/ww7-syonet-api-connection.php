<?php

$options = get_option( 'ww7_syonet_api' );

// Start -> Get ajax data

$pfr__wsa__idEmpres = $_POST[ 'idEmpresa' ];
$pfr__wsa__vehicle = $_POST[ 'vehicle' ];
$pfr__wsa__nameUser = $_POST[ 'nameUser' ];
$pfr__wsa__mensage = $_POST[ 'theMensage' ];
$pfr__wsa__cellphone = $_POST[ 'theCellphone' ];
$pfr__wsa__ddd = $_POST[ 'theDDD' ];

// End -> Get ajax data

$arrValidate = [
    $options[ 'login_name' ],
    $options[ 'login_pass' ],
    $options[ 'client_domain' ],
    $options[ 'event_group' ],
    $options[ 'event_type' ],
    $options[ 'media' ],
    $options[ 'origin' ],
    $pfr__wsa__idEmpres,
    $pfr__wsa__vehicle,
    $pfr__wsa__nameUser,
    $pfr__wsa__cellphone,
    $pfr__wsa__ddd
    
];

for( $II = 0; $II < count( $arrValidate ); $II++ ){
    
    if( $arrValidate[ $II ] == null || $arrValidate[ $II ] == '' ){

        exit( 'Empty parameters' );

    }

}

// Start -> push to syonet
$client = new SoapClient( $options[ 'url_wsdl' ] );
 
$err = 0;

if ( $err ) {
    
    echo '<h2>Constructor error</h2><pre>' . $err . '</pre>';
    echo '<h2>Debug</h2><pre>' . htmlspecialchars( $client->getDebug(), ENT_QUOTES ) . '</pre>';
    exit();
    
}

$dados = Array();

$dados[ 'usuario' ]           =  $options[ 'login_name' ];
$dados[ 'senha' ]             =  $options[ 'login_pass' ];
$dados[ 'dominio' ]           =  $options[ 'client_domain' ];
$dados[ 'nome' ]              =  $pfr__wsa__nameUser;
$dados[ 'dddCelular' ]        =  $pfr__wsa__ddd;
$dados[ 'telefoneCelular' ]   =  $pfr__wsa__cellphone;
$dados[ 'observacao' ]        =  $pfr__wsa__mensage;
$dados[ 'grupoEvento' ]       =  $options[ 'event_group' ];
$dados[ 'tipoEvento' ]        =  $options[ 'event_type' ];
$dados[ 'midia' ]             =  $options[ 'media' ];
$dados[ 'idEmpresa' ]         =  $pfr__wsa__idEmpres;
$dados[ 'origem' ]            =  $options[ 'origin' ];
$dados[ 'assunto' ]           =  $pfr__wsa__vehicle;

$result = $client->gerarEventoV2( $dados );
 
if( $client->fault ) {

    echo '<h2>Fault ( Expect - The request contains an invalid SOAP body )</h2><pre>';
    print_r( $result );
    echo '</pre>';

}else{

    $err = 0;

    if( $err ){

        echo '<h2>Erro :</h2><pre>' . $err . '</pre>';
    
    }else{

        echo '<h2>Resultado : </h2><pre>';
        print_r( $result );
        echo '</pre>';
    
    }

}

?>