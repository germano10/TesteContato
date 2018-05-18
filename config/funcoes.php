<?php

function debug($array){
	echo "<pre>";
	print_r($array);
	echo "</pre>";
}

function mysqli_prepared_query(&$link, $sql, $params = FALSE, $debug = FALSE){
	if ($debug){
		echo '<pre>';
		echo preparedQuery($sql,$params);
		echo '</pre>';
	}

	$typeDef = FALSE;
	if (!empty($params)) {
		foreach ($params as $item) {
			if (trim($item) == '') {
				$item = null;
			}
		}
	}

	if ($typeDef == FALSE && $params !== FALSE) {
		$qnt = '';
		for ($i = 1; $i <= count($params); $i++) {
			$qnt .= 's';
		}
		$typeDef = $qnt;
	}

	$link->set_charset("utf8");
	if ($stmt = mysqli_prepare($link, $sql) or die($link->error)) {
		if (count($params) == count($params, 1)) {
			$params     = array(
				$params
				);
			$multiQuery = FALSE;
		} else {
			$multiQuery = TRUE;
		}

		if ($typeDef) {
			$bindParams           = array();
			$bindParamsReferences = array();
			$bindParams           = array_pad($bindParams, (count($params, 1) - count($params)) / count($params), "");
			foreach ($bindParams as $key => $value) {
				$bindParamsReferences[$key] =& $bindParams[$key];
			}
			array_unshift($bindParamsReferences, $typeDef);
			$bindParamsMethod = new ReflectionMethod('mysqli_stmt', 'bind_param');
			$bindParamsMethod->invokeArgs($stmt, $bindParamsReferences);
		}

		$result = array();
		foreach ($params as $queryKey => $query) {
			if ($typeDef && $params) {
				foreach ($bindParams as $paramKey => $value) {
					$bindParams[$paramKey] = $query[$paramKey];
				}
			}
			$queryResult = array();
			if (mysqli_stmt_execute($stmt) or die($link->error)) {
				$resultMetaData = mysqli_stmt_result_metadata($stmt);
				if ($resultMetaData) {
					$stmtRow       = array();
					$rowReferences = array();
					while ($field = mysqli_fetch_field($resultMetaData)) {
						$rowReferences[] =& $stmtRow[$field->name];
					}
					mysqli_free_result($resultMetaData);
					$bindResultMethod = new ReflectionMethod('mysqli_stmt', 'bind_result');
					$bindResultMethod->invokeArgs($stmt, $rowReferences);
					while (mysqli_stmt_fetch($stmt)) {
						$row = array();
						foreach ($stmtRow as $key => $value) {
							$row[$key] = $value;
						}
						$queryResult[] = $row;
					}
					mysqli_stmt_free_result($stmt);
				} else {
					$queryResult[] = mysqli_stmt_affected_rows($stmt);
				}
			} else {
				$queryResult[] = FALSE;
			}
			$result[$queryKey] = $queryResult;
		}
		mysqli_stmt_close($stmt);
	} else {
		$result = FALSE;
	}
	
	if($multiQuery){
		if ($debug){
			echo '<pre>';
			print_r($result);
			print_r($link);
			echo '</pre>';
		}
		$link->affect_rows= $linhas;
		return $result;
	} else {
		if ($debug){
			echo '<pre>';
			print_r($result[0]);
			print_r($link);
			echo '</pre>';
		}
		$link->affect_rows= $linhas;
		return $result[0];
	}
}


?>