<?php 
  
  require 'PHPMailer/PHPMailerAutoload.php';
	class fillInfo
	{
		private $name;
		private $contact_no;
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

		function setContactNo($contact_no)
		{
			if(empty($contact_no))
			{
				throw new Exception('Contact Number can not be empty');
			}

			$this->contact_no = $contact_no;
		}

		function getContactNo()
		{
			return $this->contact_no;
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
			$fillInformation->setContactNo($_POST["contact_no"]);
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
					$mail->Password = "softwareincubator";

					$mail->setFrom($fillInformation->getEmail(), $fillInformation->getName());
					$mail->addAddress($fillInformation->getEmail(), $fillInformation->getName());
					$mail->subject = $fillInformation->getContactNo();
					$mail->msgHTML($fillInformation->getQuery());
					if (!$mail->send())
					{
					    echo "Mailer Error: " . $mail->ErrorInfo;
					}
					else
					{
						echo $fillInformation->getName()." ";
						echo $fillInformation->getEmail()." ";
						echo $fillInformation->getContactNo()." ";
						echo $fillInformation->getQuery();

					    echo "Message sent!";
					}
				}
				catch(Exception $e)
				{
					echo "Error Message: ".$e->getMessage().'<br>';
				}

			}
			catch(Exception $e)
			{
				echo "Error Message: ".$e->getMessage().'<br>';
			}

		}
		catch(Exception $e)
		{
			echo "Error Message: ".$e->getMessage().'<br>';
		}

	}
	catch(Exception $e)
	{
		echo "Error Message: ".$e->getMessage().'<br>';
	}


	

	
	
?>