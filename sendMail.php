<?php 
  
  require 'PHPMailer/PHPMailerAutoload.php';

	$json['error_status'] = false;
	$json['error'] = '';

	class fillInfo
	{
		private $_name,
				$_subject,
				$_email,
				$_query;

		function setName($_name)
		{
			if(empty($_name))
			{
				$json['error'] = true;
				return false;
			}
			$this->name = $_name;
		}

		function getName()
		{
			return $this->name;
		}

		function setSubject($_subject)
		{
			if(empty($_subject))
			{
				$json['error'] = true;
				return false;
			}
			$this->subject = $_subject;
		}

		function getSubject()
		{
			return $this->subject;
		}

		function setEmail($_email)
		{
			if(empty($_email))
			{
				$json['error'] = true;
				return false;
			}
			$this->email = $_email;
		}

		function getEmail()
		{
			return $this->email;
		}

		function setQuery($_query)
		{
			if(empty($_query))
			{
				$json['error'] = true;
				return false;
			}
			$this->query = $_query;
		}

		function getQuery()
		{
			return $this->query;
		}
	}

	$fillInformation = new fillInfo();

	$fillInformation->setName($_POST["name"]);
	$fillInformation->setSubject($_POST["subject"]);
	$fillInformation->setEmail($_POST["email"]);
	$fillInformation->setQuery($_POST["query"]);

	$mail = new PHPMailer;
	$mail->isSMTP();
	$mail->SMTPDebug = 1;
	$mail->Debugoutput = 'html';
	$mail->Host = 'smtp.gmail.com';
	$mail->Port = 587;
	$mail->SMTPSecure = 'tls';
	$mail->SMTPAuth = true;
	$mail->Username = "chauhan.kartik25@gmail.com";
	$mail->Password = "";

	$mail->setFrom($fillInformation->getEmail(), $fillInformation->getName());
	$mail->addAddress($fillInformation->getEmail(), $fillInformation->getName());
	$mail->subject = $fillInformation->getSubject();
	$mail->msgHTML($fillInformation->getQuery());
	try
	{
		if (!$mail->send())
			throw new Exception("Coudn't send mail right now. Please try after few minutes");
	}
	catch(Exception $e)
	{
		$json['error_status'] = true;
		$json['error'] = $e->getMessage();
	}

	header("Content-Type: application/json", true);
	echo json_encode($json);

?>