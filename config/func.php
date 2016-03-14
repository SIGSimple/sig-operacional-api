<?php
	function baseUrl(){
		return $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['SERVER_NAME'];
	}

	function serverName(){
		return $_SERVER['SERVER_NAME'];
	}

	function removeMaskNumber($number){
		//$punctuation = preg_quote( "," );
		if( strstr($number,",")){
		$number = preg_replace( array("/[\(\)\- _\.R\$%]/","/[,]/"), array('','.'),$number);
		}
		return (float)$number;
	}

	/*function prepareWhere($busca){
		foreach ($busca as $key => $value) {
			$key = str_replace("->",'.',$key);
			if(is_array($value)){
				$aux[] = $key.' '.$value['exp'];
			}else{
				$aux[] = $key." = '$value'";
			}
		}
		return stripslashes(join(' AND ',$aux));
	}*/

	function cast($destination, $sourceObject)
	{
		if (is_string($destination)) {
			$destination = new $destination();
		}
		$sourceReflection = new ReflectionObject($sourceObject);
		$destinationReflection = new ReflectionObject($destination);
		$sourceProperties = $sourceReflection->getProperties();
		foreach ($sourceProperties as $sourceProperty) {
			$sourceProperty->setAccessible(true);
			$name = $sourceProperty->getName();
			$value = $sourceProperty->getValue($sourceObject);
			if ($destinationReflection->hasProperty($name)) {
				$propDest = $destinationReflection->getProperty($name);
				$propDest->setAccessible(true);
				$propDest->setValue($destination,$value);
			} else {
				$destination->$name = $value;
			}
		}
		return $destination;
	}

	function array_orderby() {
		$args = func_get_args();
		$data = array_shift($args);
		foreach ($args as $n => $field) {
			if(is_string($field)) {
				$tmp = array();
				foreach ($data as $key => $row)
					$tmp[$key] = $row[$field];
				$args[$n] = $tmp;
			}
		}
		$args[] = &$data;
		call_user_func_array('array_multisort', $args);
		return array_pop($args);
	}
	
	function prepareWhere($busca){
		foreach ($busca as $key => $value) {
			$key = str_replace("->",'.',$key);
			if(is_array($value)){
				if(array_key_exists('exp', $value))
					$aux[] = $key.' '.$value['exp'];
				else if(array_key_exists('literal_exp', $value))
					$aux[] = $value['literal_exp'];
			} else {
				$aux[] = $key." = '$value'";
			}
		}

		return stripslashes(join(' AND ',$aux));
	}

	function parse_arr_values($arr,$arr_key=null,$tipo = null){
		$default_tipo = $tipo ;
		foreach ($arr as $key => $value) {
			if(is_array($value)){
				$arr[$key] = parse_arr_values($value,$arr_key,$tipo);	
			}else{
				if(!function_exists($tipo)){
					if($default_tipo == null){
						if($value === 'true' || $value === 'false') {
							$tipo = 'boolean';
						}
						elseif(is_numeric($value))
							$tipo = 'double';
						elseif (is_null($value)) {
							$tipo = 'null';
						}
						else{
							$tipo = 'string';
						}
							
					}
					if($arr_key == 'all' || in_array($key, $arr_key)){
						switch($tipo){
							case 'boolean':
								if($value === 'true')
									$arr[$key] = true;
								elseif($value === 'false')
									$arr[$key] = false;
								break;
							case 'float':
								$arr[$key] = (float)$value ;
								break;
							case 'int':
								$arr[$key] = (int)$value ;
								break;
							case 'double':
								$arr[$key] = (double)$value ;
								break;
							case 'string':
								$arr[$key] = (string)$value ;
								break;
							case 'null':
								$arr[$key] = null ;
								break;
						} 
					}
				}else{
					if($arr_key == 'all' || in_array($key, $arr_key)){
						$arr[$key] = $tipo($value) ;
					}
				}
			}
		}

		return $arr ;
	}

	function formateDateFY($value){
		$arrMonth     = array("Janeiro","Fevereiro","Marco","Abril","Maio","Junho","Julho","Agosto","Setembro","Outubro","Novembro","Dezembro");
		$mes          = (int)date('m',strtotime($value));
		$ano          = date('Y',strtotime($value));
		return $arrMonth[$mes-1].'/'.$ano ;
	}

	function formateDateDMY($value){
		return date('d-m-Y',strtotime($value));
	}


	function ultimoDiaMes($data=""){
		if (!$data) {
			$dia = date("d");
			$mes = date("m");
			$ano = date("Y");
		} else {
			$dia = date("d",$data);
			$mes = date("m",$data);
			$ano = date("Y",$data);
		}

		$data = mktime(0, 0, 0, $mes, 1, $ano);
		return date("d",$data-1);
	}

	 function sendMail($assunto, $corpo, $destinatarios=array(0=>array("nome"=>"", "email"=>"")), $form_data=array(), $bodyContent=false) {
		//extract($form_data);
		foreach($form_data as $var => $value):
			${"$var"} = $value;
		endforeach;

		unset($form_data);

		$mail = new PHPMailer();
		$mail->IsSMTP();
		$mail->IsHTML(true);
		$mail->CharSet = "UTF-8";
		$mail->Host     = "smtp.programaagualimpa.net";                  
		$mail->SMTPAuth = true;
		$mail->Username = 'no-reply@programaagualimpa.net';
		$mail->Password = '*Cons@InterM!*';
		$mail->Port     = 587;
		$mail->From     = 'no-reply@programaagualimpa.net';
		$mail->Sender   = "no-reply@programaagualimpa.net";
		$mail->FromName = 'SIG Operacional'; 

		foreach($destinatarios as $var=>$value):
			$mail->AddAddress($value['email'], $value['nome']);
		endforeach;

		$body = $corpo;

		if(!$bodyContent) {
			ob_start();
			include("util/email_templates/".$corpo);
			$body = ob_get_contents();
			ob_end_clean();
		}

		$mail->Subject  = $assunto; 
		$mail->Body 	= $body   ;

		$enviado = $mail->Send();

		$mail->ClearAllRecipients();
		$mail->ClearAttachments();

		if ($enviado):
			return true;
		else:
			return false;
		endif;
    }

    function mascara_string($mascara,$string)
	{
	   $string = str_replace(" ","",$string);
	   for($i=0;$i<strlen($string);$i++)
	   {
	      $mascara[strpos($mascara,"#")] = $string[$i];
	   }
	   return $mascara;
	}
?>