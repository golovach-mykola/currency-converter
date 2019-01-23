<?php
	header('Content-Type: application/json; charset=UTF-8');
	require_once('CursConverter.php');
	require_once('Exchangerate.php');
	if(isset($_POST['start_curr']) && isset($_POST['finish_curr'])&& isset($_POST['amount'])){
		
		$start_curr	= trim($_POST['start_curr']);
		$finish_curr = trim($_POST['finish_curr']);
		$amount		= trim($_POST['amount']);
		
		if(!empty($start_curr) && !empty($finish_curr) && !empty($amount)){
			$curs= new CursConverter(new Exchangerate($start_curr,$finish_curr,$amount));
			$data = $curs->convert();
			$result = array(
				'success'	=> true,
				'message'	=> 'Success',
				'data'		=> $data[$finish_curr]
			);
		}else{
			$result = array(
				'success' => false,
				'message' => 'Bad request!'
			);
		}
	}else{
		$result = array(
			'success' => false,
			'message' => 'Bad request!'
		);
	}
	echo json_encode($result); die();
?> 