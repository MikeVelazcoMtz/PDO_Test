<?php 
if(!file_exists('../Server_processing/connection.php')){
	die("Bad config error. Connection file does not exist.");
} else {
	/**
	* Contact_catalog
	*/
	require '../Server_processing/connection.php';
	class Contact_catalog extends PDOConnection
	{
		public function save($email, $telephone, $company, $birth, $password)
		{

			$insert = $this->escape_strings($email, $telephone, $company, $birth, $password);
			$sql = $this->db->prepare("INSERT INTO contact(email, telephone_number, company, birth_date, password) VALUES(:email, :telephone, :company, :birth, :password);");
			if($sql->execute($insert)) {
				return true;
			} else {
				$error['status'] = "error";
				$error['message'] = "Error " . $sql->errorCode() .": " . $sql->errorInfo()[2];
				return json_encode($error);
			}
		}

		public function list_items()
		{
			$sql = $this->db->prepare("SELECT * FROM contact;");
			if ($sql->execute()){
				$rows = $sql->fetchAll(PDO::FETCH_ASSOC);
				return $rows;
			} else {
				$error['status'] = "error";
				$error['message'] = "Error " . $sql->errorCode() .": " . $sql->errorInfo()[2];
				return json_encode($error);				
			}
		}

		public function get_item($pk)
		{
			$sql = $this->db->prepare("SELECT * FROM contact WHERE id = :id;");
			$sql->bindValue(':id', $pk, PDO::PARAM_INT);
			if ($sql->execute()){
				$rows = $sql->fetchAll(PDO::FETCH_ASSOC);
				if (count($rows)) {
					return $rows[0];
				} else {
					echo "<script>window.location='../index.php';</script>";
				}
			} else {
				$error['status'] = "error";
				$error['message'] = "Error " . $sql->errorCode() . ": " . $sql->errorInfo()[2];
				return json_encode($error); 
			}
		}

		public function update($pk, $email, $telephone, $company, $birth, $password)
		{
			$query = "UPDATE contact SET email=:email, telephone_number=:telephone, company=:company, birth_date=:birth";
			$query .= (strlen($password)> 0) ? ", password=:password" : "";
			$query .= " WHERE id = :id;";
			$insert = $this->escape_strings($email, $telephone, $company, $birth, $password);
			if (strlen($password) < 1) {
				unset($insert['password']);
			}
			$insert['id'] = $pk;
			$sql = $this->db->prepare($query);
			
			if ($sql->execute($insert)){
				return true;
			} else {
				$error['status'] = "error";
				$error['message'] = "Error " . $sql->errorCode() . ": " . $sql->errorInfo()[2];
				return json_encode($error); 
			}	
		}

		public function escape_strings($email, $telephone, $company, $birth, $password)
		{
			$email = filter_var($email, FILTER_SANITIZE_EMAIL);
			$telephone = filter_var($telephone, FILTER_SANITIZE_SPECIAL_CHARS);
			$company = filter_var($company, FILTER_SANITIZE_SPECIAL_CHARS);
			$birth = preg_replace("([^0-9/])", "", $_POST['birth']);
			$password = filter_var($password, FILTER_SANITIZE_SPECIAL_CHARS);		
			return array('email' => $email, 'telephone' => $telephone, 'company' => $company, 'birth' => $birth, 'password' => crypt($password));
		}

		public function delete($pk)
		{
			$sql = $this->db->prepare("DELETE FROM contact WHERE id = :id;");
			$sql->bindValue(':id', $pk, PDO::PARAM_INT);
			if ($sql->execute()){
				return true;
			} else {
				$error['status'] = "error";
				$error['message'] = "Error " . $sql->errorCode() . ": " . $sql->errorInfo()[2];
				return json_encode($error); 
			}
		}
	}
}
?>