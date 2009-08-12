<?php

$module = $Params['Module'];

// login as admin
$user = eZUser::fetchByName( 'admin' );
$user->loginCurrent();

$content = '';

$parameters = array( 'nodes' => array( 2 ),
                     'count' => 1,
                     'class' => 1 ); // 1 = folder

if ( $Params['Class'] )
{
	$parameters['class'] = $Params['Class'];
}
else
{
	eZDebug::writeError( "No such class" ); 
	return $module->handleError( eZError::KERNEL_ACCESS_DENIED, 'kernel' );
}
if ( $Params['Count'] > 0 )
{
    $parameters['count'] = (int)$Params['Count'];
}
if ( $Params['Nodes'] )
{
    $parameters['nodes'] = explode( ',', trim( $Params['Nodes'] ) );
}
$success = eZLoremIpsum::generateAttributeParameters( $parameters );
if ( !$success )
{
	eZDebug::writeError( "Lorrem  ispum has problems" );
    return $module->handleError( eZError::KERNEL_ACCESS_DENIED, 'kernel' );
}
$parameters = eZLoremIpsum::createObjects( $parameters );

$Result = array();
$Result['content'] = $content;
$Result['path'] = array( array( 'url' => false,
                                'text' => 'Benchmark' )
                        );

?>