<?php

class Usuario{

	//Construtor
	public function __construct($login = "", $password="", $email=""){
		
	}

	//este metodo é chamado quando alguem tenta dar um echo no objeto da sua classe usuario
	// public function __toString() {

	// 	return json_encode(array(
	// 		'id' => $this->getId(),
	// 		'login' => $this->getLogin(),
	// 		'senha' => $this->getSenha(),
	// 		'email' => $this->getEmail()
	// 	));

	// }

	

	//CRUD

	//Create
	public function create($login, $password, $email){
		$sql = new Sql();
		$results = $sql->query(
			"INSERT INTO usuarios (login, senha, email)
		 	VALUES ('$login', '$password', '$email')"
		);
	}

	//Read
	public function read($id=""){
		$sql = new Sql();
		if (isset($id) && $id != null) {			
			$results = $sql->select("SELECT * FROM usuarios WHERE ID = $id");
			return $results;
		}else {			
			$results = $sql->select("SELECT * FROM usuarios");
			return $results;
		}
	}

	//Update
	public function update($id,$dados){
		$login = $dados['login'];
		$senha = $dados['senha'];
		$email = $dados['email'];

        $usuario = new Usuario();
        $sql = new Sql();
		
		$sql->query("UPDATE usuarios 
		SET login = '$login' , senha = '$senha', email = '$email' 
		WHERE id = $id");
	}

	//Delete
	public function delete($id){
		$sql = new Sql();

		$sql->query("DELETE FROM usuarios WHERE id = $id");
	}


	//Getters e Setters
	public function getId(){
		return $this->id;
	}


	public function setId($value){
		$this->id = $value;
	}


	public function getLogin(){
		return $this->login;
	}


	public function setLogin($value){
		$this->login = $value;
	}

	public function getSenha(){
		return $this->senha;
	}


	public function setSenha($value){
		$this->senha = $value;
	}

	public function getEmail(){
		return $this->email;
	}


	public function setEmail($value){
		$this->email = $value;
	}

	
}
	


?>