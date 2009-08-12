#!/usr/bin/env php
<?php

require 'config.php';
require 'autoload.php';

$cli = eZCLI::instance();
$script = eZScript::instance( array( 'description' => ( "eZ Publish Benchmark Script \n\n" .
                                                        "Allows execution of simple PHP scripts which uses eZ Publish functionality,\n" .
                                                        "when the script is called all necessary initialization is done\n" .
                                                        "\n" .
                                                        "benchmark.php --class=1" ),
                                     'use-session' => false,
                                     'use-modules' => true,
                                     'use-extensions' => true ) );

$script->startup();

$options = $script->getOptions( "[class:][nodes:][count:]",
                                "",
                                array() );
$script->initialize();

if ( !$options['class'] )
{
	$script->showHelp();
    $script->shutdown( 1, "Missing class parameter" );
}


$user = eZUser::fetchByName( 'admin' );
$user->loginCurrent();

if ( $options['class'] )
{
    $parameters['class'] = $options['class'];
}
else
{
    $cli->error( "No such class" );
    $script->shutdown( 1 ); 
}
if ( $options['count'] > 0 )
{
    $parameters['count'] = (int)$options['count'];
}
else 
{
   $parameters['count'] = 1;
}
if ( $options['nodes'] )
{
    $parameters['nodes'] = explode( ',', trim( $options['nodes'] ) );
}
else
{
	$parameters['nodes'] = array( 2 );
}
$success = eZLoremIpsum::generateAttributeParameters( $parameters );
if ( !$success )
{
    $cli->error( "Lorrem ispum has problems" );
}
$parameters['cli'] = $cli;
$parameters = eZLoremIpsum::createObjects( $parameters );

$persec = $parameters['created_count']/$parameters['used_time'];
$cli->output( "Created " . $parameters['created_count'] . " Objects in " . $parameters['used_time'] . " seconds. " . $persec . ' Objects/sec'  );
$script->shutdown();

?>