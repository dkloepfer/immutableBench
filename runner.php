<?php
	/*
		This script is for the purpose of analysis of time and memory consumption of mutable and nonmutable objects.
		Note, that we sacrifice code quality for the sake on proper measurements, e.g. no call_user_method - calls.
		This sadly results in a lot of copy-paste - code.

		Importantly: we only measure the difference in ressource-consumption between object-operations and not the absolute values.
	*/


	require_once 'class.immutableSample.php';
	function applySetAndMeasure(array $set, immutableSample &$obj, array &$dt, array &$db, $num_op) {
		$func = array_rand($set);
		switch($func) {
			case 'setInt1':
				$b_i = memory_get_usage();
				$t_i = microtime(true);
				$obj2 = $obj->setInt1($set[$func]);
				$dt[$num_op] = microtime(true) - $t_i;
				$db[$num_op] = memory_get_usage() - $b_i;
				break;
			case 'setInt2':
				$b_i = memory_get_usage();
				$t_i = microtime(true);
				$obj2 = $obj->setInt2($set[$func]);
				$dt[$num_op] = microtime(true) - $t_i;
				$db[$num_op] = memory_get_usage() - $b_i;
				break;
			case 'setInt3':
				$b_i = memory_get_usage();
				$t_i = microtime(true);
				$obj2 = $obj->setInt3($set[$func]);
				$dt[$num_op] = microtime(true) - $t_i;
				$db[$num_op] = memory_get_usage() - $b_i;
				break;
			case 'setStr1':
				$b_i = memory_get_usage();
				$t_i = microtime(true);
				$obj2 = $obj->setStr1($set[$func]);
				$dt[$num_op] = microtime(true) - $t_i;
				$db[$num_op] = memory_get_usage() - $b_i;
				break;
			case 'setStr2':
				$b_i = memory_get_usage();
				$t_i = microtime(true);
				$obj2 = $obj->setStr2($set[$func]);
				$dt[$num_op] = microtime(true) - $t_i;
				$db[$num_op] = memory_get_usage() - $b_i;
				break;
			case 'setStr3':
				$b_i = memory_get_usage();
				$t_i = microtime(true);
				$obj2 = $obj->setStr3($set[$func]);
				$dt[$num_op] = microtime(true) - $t_i;
				$db[$num_op] = memory_get_usage() - $b_i;
				break;
			case 'setDat1':
				$b_i = memory_get_usage();
				$t_i = microtime(true);
				$obj2 = $obj->setDat1($set[$func]);
				$dt[$num_op] = microtime(true) - $t_i;
				$db[$num_op] = memory_get_usage() - $b_i;
				break;
			case 'setDat2':
				$b_i = memory_get_usage();
				$t_i = microtime(true);
				$obj2 = $obj->setDat2($set[$func]);
				$dt[$num_op] = microtime(true) - $t_i;
				$db[$num_op] = memory_get_usage() - $b_i;
				break;
			case 'setDat3':
				$b_i = memory_get_usage();
				$t_i = microtime(true);
				$obj2 = $obj->setDat3($set[$func]);
				$dt[$num_op] = microtime(true) - $t_i;
				$db[$num_op] = memory_get_usage() - $b_i;
				break;
		}
		return $obj2;
	}

	function statistics(array $data) {
		$n = count($data);
		$s_val = 0;
		$s_val_sq = 0;
		foreach ($data as $value) {
			$s_val += $value;
			$s_val_sq += $value * $value;
		}
		$avg = $s_val / $n; //average.
		$sigma = sqrt(($s_val_sq - $s_val*$s_val/$n)/($n - 1)); //standart deviation.
		return array("average" => $avg, "sigma" => $sigma);
	}

	$sets = array(
				array('setInt1' => 1, 'setInt2' => 2, 'setInt3' => 3
						,'setStr1' => 'a' ,'setStr2'=> 'b', 'setStr3' => 'c'
						,'setDat1'=> new DateTime('2016-01-01'), 'setDat2' => new DateTime('2016-01-02'), 'setDat3' => new DateTime('2016-01-03'))
				,array('setInt1' => 2000, 'setInt2' => 3, 'setInt3' => 20
						,'setStr1' => 'foo', 'setStr2' => 'bar', 'setStr3' => 'baz'
						,'setDat1' => new DateTime('2012-01-01'), 'setDat2' => new DateTime('2012-01-02'), 'setDat3' => new DateTime('2012-01-02'))
				,array('setInt1' => 10, 'setInt2' => 3, 'setInt3' => 20
						,'setStr1' => 'fqoo', 'setStr2' => 'bwar', 'setStr3' => 'baxz'
						,'setDat1' => new DateTime('2012-02-01'), 'setDat2' => new DateTime('1922-02-01'), 'setDat3' =>  new DateTime('2012-11-02'))
				,array('setInt1' => 3, 'setInt2' => 23, 'setInt3' => 220
						,'setStr1' => 'foso', 'setStr2' => 'null' , 'setStr3' => 'bsaz'
						,'setDat1' => new DateTime('2012-02-01'), 'setDat2' => new DateTime('2013-02-01'), 'setDat3' => new DateTime('2012-12-01'))
				,array('setInt1' =>  21, 'setInt2' => 42, 'setInt3' => 220
						,'setStr1' => 'foo', 'setStr2' => 'basadasr', 'setStr3' => 'null'
						,'setDat1' => new DateTime('2012-02-01'), 'setDat2' => new DateTime('2013-02-01'), 'setDat3' => new DateTime('2012-12-01'))
				,array('setInt1' => 1111, 'setInt2' => 11212, 'setInt3' => 220
						,'setStr1' => 'foo', 'setStr2' => 'bar', 'setStr3' => 'baz'
						,'setDat1' => new DateTime('2012-02-01'), 'setDat2' => new DateTime('2013-02-01'), 'setDat3' => new DateTime('2012-12-01'))
				,array('setInt1' => 2221, 'setInt2' => 0, 'setInt3' => 3
						,'setStr1' => 'a' ,'setStr2'=> 'b', 'setStr3' => 'c'
						,'setDat1'=> new DateTime('2016-11-01'), 'setDat2' => new DateTime('2016-01-22'), 'setDat3' => new DateTime('2023-01-03'))
					);

	$num_tr = 100;

	$dt = array();
	$db = array();
	$obj = new immutableSample(1,2,3,'a','b','c',new DateTime('2016-11-01'), new DateTime('2016-01-22'), new DateTime('2023-01-03'), true);

	for($i = 0; $i < $num_tr; $i++) {

		$set = $sets[rand(0,count($sets)-1)];

		$obj = applySetAndMeasure($set, $obj, $dt, $db, $i);
	}
	echo "mutable: <br>";
	var_dump($db);
	echo '<br>';
	var_dump($dt);
	echo '<hr>statistics:<br>';

	$statistics_t = statistics($dt);
	$statistics_b = statistics($db);
	echo " time: avg: ".$statistics_t["average"]." standart deviation: ".$statistics_t["sigma"]."<br>";
	echo " memory: avg: ".$statistics_b["average"]." standart deviation: ".$statistics_b["sigma"]."<br>";
	echo '<hr><hr>';
	$obj = new immutableSample(1,2,3,'a','b','c',new DateTime('2016-11-01'), new DateTime('2016-01-22'), new DateTime('2023-01-03'), false);
	$dt = array();
	$db = array();
	for($i = 0; $i < $num_tr; $i++) {

		$set = $sets[rand(0,count($sets)-1)];

		$obj = applySetAndMeasure($set, $obj, $dt, $db, $i);
	}
	echo "non-mutable: <br>";
	var_dump($db);
	echo '<br>';
	var_dump($dt);
	echo '<hr>';

	$statistics_t = statistics($dt);
	$statistics_b = statistics($db);
	echo " time: avg: ".$statistics_t["average"]." standart deviation: ".$statistics_t["sigma"]."<br>";
	echo " memory: avg: ".$statistics_b["average"]." standart deviation: ".$statistics_b["sigma"]."<br>";
	echo '<hr>';
	die();
