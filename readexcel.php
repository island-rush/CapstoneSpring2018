<?php
$filename = 'resources/adjacency_matrix.csv';
if (($handle = fopen($filename, "r")) !== FALSE) {
    $counter = 0;
    $_SESSION['test2'] = array();
    while(($data = fgetcsv($handle, 0, ",")) !== FALSE) {
        $_SESSION['test2'][$counter] = array();
        $arraySize = count($data);
        for ($i=0; $i < $arraySize; $i++) {
            $_SESSION['dist'][$counter][$i] = $data[$i];
        }
        $counter++;
    }
}
fclose($handle);
$n = $arraySize;
for ($k = 0; $k < $n; ++$k) {
    for ($i = 0; $i < $n; ++$i) {
        for ($j = 0; $j < $n; ++$j) {
            if (($_SESSION['dist'][$i][$k] * $_SESSION['dist'][$k][$j] != 0) && ($i != $j)) {
                if (($_SESSION['dist'][$i][$k] + $_SESSION['dist'][$k][$j] < $_SESSION['dist'][$i][$j]) || ($_SESSION['dist'][$i][$j] == 0)) {
                    $_SESSION['dist'][$i][$j] = $_SESSION['dist'][$i][$k] + $_SESSION['dist'][$k][$j];
                }
            }
        }
    }
}