<?php
function fib($n)
{
    if ($n <= 2)
        return 1;
    else
        return fib($n - 1) + fib($n - 2);
}

$value = $_GET["value"];
$time = microtime(true);
echo "Fibonacci($value) = " . fib($value);
echo " in " . sprintf("%0.2f", (microtime(true) - $time)) . " secs\n";
?>
