<?php

$Module = array( 
    'name' => 'Benchmark' 
);

$ViewList = array();
$ViewList['create'] = array( 
    'functions' => array( 'create' ),
    'script' => 'create.php' , 
    'default_navigation_part' => 'ezcontentnavigationpart' , 
    'params' => array( 
        'Class', 
        'Count',
        'Nodes' 
    ) 
);
$FunctionList = array();
$FunctionList['create'] = array();
?>
