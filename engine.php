<?php

require '/home/dakornev2/CORE/db_ora.php';

 if(!empty($_REQUEST)){
	if(function_exists($_REQUEST['action']))
	{
	  call_user_func($_REQUEST['action']);
	}
	die();
}

function getPrivs()
{
	$namePriv = $_REQUEST['txt_priv'];
	$notIn = $_POST['without'];
	!$notIn ? $notIn = 0 : $notIn;
	$scheme = $_POST['sheme'];
/* 	$notIn = json_decode($_POST['without'], JSON_OBJECT_AS_ARRAY);
	$notIn = implode(",", $notIn);
	!$notIn ? $notIn = 0 : $notIn; */
	$answer = array();
	$sql = ora_query("select a.ID_PRIV, a.SHORT_NAME, a.FULL_NAME, a.DLIN, 
					MAX(a.DLIN) OVER (PARTITION BY a.f) AS maxval
					from (select au_priv_id id_priv, 
					au_priv_name short_name, 
					'['||to_char(au_priv_id,'000009')||'] '||au_priv_name full_name,
					length('['||to_char(au_priv_id,'000009')||'] '||au_priv_name) dlin,
					'1' f
					from mgts_spri.auth_priv
					where au_priv_status = 1
					order by decode('id_priv','short_name',au_priv_name,to_char(id_priv,'0000000000009'))) a
					where UPPER(a.FULL_NAME) like UPPER('%'||'$namePriv'||'%')
					and a.ID_PRIV not in ($notIn)
					and rownum < 20");
	if(!$sql)
	{
		$answer[0]['TXT'] = "Подходящих привилегий не найдено или они уже выбраны!";
	}
	else
	{	
		for($i = 0; $i < count($sql); $i++)	
		{
			$answer[$i]['TXT'] = $sql[$i]['FULL_NAME'];
			$answer[$i]['ID_PRIV'] = $sql[$i]['ID_PRIV'];
		}
	}	 
	//echo $notIn;
	echo json_encode($answer);
}





function getUser()
{
	$username = $_REQUEST['user'];
	$answer = array();
	$sql = ora_query("select a.full_username, a.state, a.au_login from (
					select '['||au.au_login||'] '||au.au_name full_username, au.au_status_id state, au.au_login
					from mgts_spri.auth_user au 
					order by au.au_status_id) a
					where UPPER(a.full_username) like UPPER('%'||'$username'||'%')
					and rownum < 10");
	for($i = 0; $i < count($sql); $i++)	
	{
		$answer[$i]['USR'] = $sql[$i]['FULL_USERNAME'];
		$answer[$i]['LOGIN'] = $sql[$i]['AU_LOGIN'];
		$answer[$i]['STATE'] = $sql[$i]['STATE'];
	}
	echo json_encode($answer);
}



















function writeLog($textLog)
{
		$filename = __DIR__."/logs.log";
		$fd = fopen($filename, "a");
		fwrite($fd, $textLog."\n");
		fclose($fd);
}
?>

