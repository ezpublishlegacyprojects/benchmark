<?php
echo "First argument should be the amount of iterations.\n";
echo "A reasonable value is for example 1000000: ~20 seconds -> lousy Lenovo laptop\n";
if ( $argc == 2 )
{
$start = time();
for ( $i = 0; $i < $argv[1]; ++$i )
{
    $content = file_get_contents( 'testfile.txt' );
}
$total = time() - $start;
echo "Test took $total seconds\n";
}
?>
