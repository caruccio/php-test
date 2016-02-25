<?php
date_default_timezone_set('UTC');
for ($i=0; $i<$_GET['lines']; $i++) {
    echo '[' . date('c') . "] Log line[$i]\n";
}
?>
