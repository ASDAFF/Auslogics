<?php
error_reporting(E_ALL);
ini_set('memory_limit', '512M');

//Создаем тестовый массив
$maxValue = mt_rand(2, 1000000);
$TestArray = range(1, $maxValue);
$TestArray[] = rand(1, $maxValue);
shuffle($TestArray);

$startTime = microtime(true);
$UArray = array_count_values($TestArray);

// В тестах этот вариант показал максимум 1.20 секунды, для массива размером 1,000,0001
foreach ($UArray as $value => $count){
	if ($count > 1){
		$duplicateValue = $value;
		break;
	}
}

$finishTime = microtime(true);

echo 'Duplicate value: ' . $duplicateValue;

echo '<hr>';
echo 'Script execution time: ' . ($finishTime-$startTime) . ' sec.<br>';
echo 'Array size: ' . count($TestArray);
?>