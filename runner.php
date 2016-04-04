<?php
	/*
		This script is for the purpose of analysis of time and memory consumption of mutable and nonmutable objects.
		Note, that we sacrifice code quality for the sake on proper measurements, e.g. no call_user_method - calls.
		This sadly results in a lot of copy-paste - code.

		Importantly: we only measure the difference in ressource-consumption between object-operations and not the absolute values.
	*/


	require_once 'class.immutableSample.php';
	function applySetAndMeasure(array $set, immutableSample &$obj) {
		$func = array_rand($set);
		switch($func) {
			case 'setInt1':
				$a = $set[$func];
				$obj = $obj->setInt1($a);
				break;
			case 'NOsetInt1':
				$a = $set[$func];
				$obj = $obj;
				break;
			case 'setInt2':
				$a = $set[$func];
				$obj = $obj->setInt2($a);
				break;
			case 'NOsetInt2':
				$a = $set[$func];
				$obj = $obj;
				break;
			case 'setInt3':
				$a = $set[$func];
				$obj = $obj->setInt3($a);
				break;
			case 'NOsetInt3':
				$a = $set[$func];
				$obj = $obj;
				break;
			case 'setStr1':
				$a = $set[$func];
				$obj = $obj->setStr1($a);
				break;
			case 'NOsetStr1':
				$a = $set[$func];
				$obj = $obj;
				break;
			case 'setStr2':
				$a = $set[$func];
				$obj = $obj->setStr2($a);
				break;
			case 'NOsetStr2':
				$a = $set[$func];
				$obj = $obj;
				break;
			case 'setStr3':
				$a = $set[$func];
				$obj = $obj->setStr3($a);
				break;
			case 'NOsetStr3':
				$a = $set[$func];
				$obj = $obj;
				break;
			case 'setDat1':
				$a = $set[$func];
				$obj = $obj->setDat1($a);
				break;
			case 'NOsetDat1':
				$a = $set[$func];
				$obj = $obj;
				break;
			case 'setDat2':
				$a = $set[$func];
				$obj = $obj->setDat2($a);
				break;
			case 'NOsetDat2':
				$a = $set[$func];
				$obj = $obj;
				break;
			case 'setDat3':
				$a = $set[$func];
				$obj = $obj->setDat3($a);
				break;
			case 'NOsetDat3':
				$a = $set[$func];
				$obj = $obj;
				break;
			default:
				die($func);
		}
	}

/*	function statistics(array $data) {
		$n = count($data);
		$s_val = 0;
		$s_val_sq = 0;
		foreach ($data as $value) {
			$s_val += $value;
			$s_val_sq += $value * $value;
		}
		$avg = $s_val / $n; //average.
		$sigma = sqrt(($s_val_sq - $s_val*$s_val/$n)/($n - 1)); //standart deviation.
		return array("avg"=>$avg,"sigma"=>$sigma);
	}*/

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

	$sets_offs = array(
				array('NOsetInt1' => 1, 'NOsetInt2' => 2, 'NOsetInt3' => 3
						,'NOsetStr1' => 'a' ,'NOsetStr2'=> 'b', 'NOsetStr3' => 'c'
						,'NOsetDat1'=> new DateTime('2016-01-01'), 'NOsetDat2' => new DateTime('2016-01-02'), 'NOsetDat3' => new DateTime('2016-01-03'))
				,array('NOsetInt1' => 2000, 'NOsetInt2' => 3, 'NOsetInt3' => 20
						,'NOsetStr1' => 'foo', 'NOsetStr2' => 'bar', 'NOsetStr3' => 'baz'
						,'NOsetDat1' => new DateTime('2012-01-01'), 'NOsetDat2' => new DateTime('2012-01-02'), 'NOsetDat3' => new DateTime('2012-01-02'))
				,array('NOsetInt1' => 10, 'NOsetInt2' => 3, 'NOsetInt3' => 20
						,'NOsetStr1' => 'fqoo', 'NOsetStr2' => 'bwar', 'NOsetStr3' => 'baxz'
						,'NOsetDat1' => new DateTime('2012-02-01'), 'NOsetDat2' => new DateTime('1922-02-01'), 'NOsetDat3' =>  new DateTime('2012-11-02'))
				,array('NOsetInt1' => 3, 'NOsetInt2' => 23, 'NOsetInt3' => 220
						,'NOsetStr1' => 'foso', 'NOsetStr2' => 'null' , 'NOsetStr3' => 'bsaz'
						,'NOsetDat1' => new DateTime('2012-02-01'), 'NOsetDat2' => new DateTime('2013-02-01'), 'NOsetDat3' => new DateTime('2012-12-01'))
				,array('NOsetInt1' =>  21, 'NOsetInt2' => 42, 'NOsetInt3' => 220
						,'NOsetStr1' => 'foo', 'NOsetStr2' => 'basadasr', 'NOsetStr3' => 'null'
						,'NOsetDat1' => new DateTime('2012-02-01'), 'NOsetDat2' => new DateTime('2013-02-01'), 'NOsetDat3' => new DateTime('2012-12-01'))
				,array('NOsetInt1' => 1111, 'NOsetInt2' => 11212, 'NOsetInt3' => 220
						,'NOsetStr1' => 'foo', 'NOsetStr2' => 'bar', 'NOsetStr3' => 'baz'
						,'NOsetDat1' => new DateTime('2012-02-01'), 'NOsetDat2' => new DateTime('2013-02-01'), 'NOsetDat3' => new DateTime('2012-12-01'))
				,array('NOsetInt1' => 2221, 'NOsetInt2' => 0, 'NOsetInt3' => 3
						,'NOsetStr1' => 'a' ,'NOsetStr2'=> 'b', 'NOsetStr3' => 'c'
						,'NOsetDat1'=> new DateTime('2016-11-01'), 'NOsetDat2' => new DateTime('2016-01-22'), 'NOsetDat3' => new DateTime('2023-01-03'))
					);

	$num_tr = 100000;
	$mut = $_GET["mut"];
	$ref = $_GET["ref"];
	echo $mut ? "mutable" : "nonmutable";
	echo "<br>";
	echo $ref ? "reference" : "measurement";
	echo "<br>";
	$obj = new immutableSample(1,2,3,'a','b','c',new DateTime('2016-11-01'), new DateTime('2016-01-22'), new DateTime('2023-01-03'), $mut);

	$sets_u = $ref ? $sets_offs : $sets;


	$t_i = microtime(true);
	$b_i = memory_get_usage();
	for($i = 0; $i < $num_tr; $i++) {
		$set = $sets[rand(0,count($sets_u) - 1)];
		applySetAndMeasure($set, $obj);
	}
	$db = memory_get_usage() - $b_i;
	$dt = microtime(true) - $t_i;


	echo "memory: ".$db." time: ".$dt;

	die("<br>finished");
