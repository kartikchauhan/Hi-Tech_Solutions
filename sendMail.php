<?php 
  
  require 'PHPMailer/PHPMailerAutoload.php';
	class fillInfo
	{
		private $name;
		private $subject;
		private $email;
		private $query;

		function setName($name)
		{
			if(empty($name))
			{
				throw new Exception('Name can not be blank');
			}

			$this->name = $name;
		}

		function getName()
		{
			return $this->name;
		}

		function setSubject($subject)
		{
			if(empty($subject))
			{
				throw new Exception('Subject can not be empty');
			}

			$this->subject = $subject;
		}

		function getSubject()
		{
			return $this->subject;
		}

		function setEmail($email)
		{
			if(empty($email))
			{
				throw new Exception('Email Address can not be empty');
			}

			$this->email = $email;
		}

		function getEmail()
		{
			return $this->email;
		}

		function setQuery($query)
		{
			if(empty($query))
			{
				throw new Exception('Query can not be empty');
			}

			$this->query = $query;
		}

		function getQuery()
		{
			return $this->query;
		}
	}

	
	$fillInformation = new fillInfo();

	try
	{
		$fillInformation->setName($_POST["name"]);
		try
		{
			$fillInformation->setSubject($_POST["subject"]);
			try
			{
				$fillInformation->setEmail($_POST["email"]);
				try
				{
					$fillInformation->setQuery($_POST["query"]);

					$mail = new PHPMailer;
					$mail->isSMTP();
					$mail->SMTPDebug = 0;
					$mail->Debugoutput = 'html';
					$mail->Host = 'smtp.gmail.com';
					$mail->Port = 587;
					$mail->SMTPSecure = 'tls';
					$mail->SMTPAuth = true;
					$mail->Username = "chauhan.kartik25@gmail.com";
					$mail->Password = "Kartik25K";

					$mail->setFrom($fillInformation->getEmail(), $fillInformation->getName());
					$mail->addAddress($fillInformation->getEmail(), $fillInformation->getName());
					$mail->subject = $fillInformation->getSubject();
					$mail->msgHTML($fillInformation->getQuery());
					if (!$mail->send())
					{
					    echo "Mailer Error: " . $mail->ErrorInfo;
					}
					else
					{
						echo 200;
					}
				}
				catch(Exception $e)
				{
					echo 403;	// forbidden
					// $json->message = "Error Message: ".$e->getMessage();
				}

			}
			catch(Exception $e)
			{
				echo 403;	// forbidden
				// $json->message = "Error Message: ".$e->getMessage();
			}

		}
		catch(Exception $e)
		{
			echo 403;	// forbidden
			// $json->message = "Error Message: ".$e->getMessage();
		}

	}
	catch(Exception $e)
	{
		echo 403;	// forbidden
		// $json->message = "Error Message: ".$e->getMessage();
	}

?>