<?php

class Usuario{

	private $id;
	private $login;
	private $senha;
	private $email;

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


	//este metodo é chamado quando alguem tenta dar um echo no objeto da sua classe usuario
	public function __toString() {

		return json_encode(array(
			'id' => $this->getId(),
			'login' => $this->getLogin(),
			'senha' => $this->getSenha(),
			'email' => $this->getEmail()
		));

	}



	//metodo construtor
	public function __construct($login = "", $password=""){
		$this->setLogin($login);
		$this->setSenha($password);
	}


	//deleta um usuario
	public function delete(){

		$sql = new Sql();
		$sql->query("DELETE FROM usuarios WHERE id = :ID" ,array(
			":ID" => $this->getIdusuario()
		));

		$this->setId(0);
		$this->setSenha("");
		$this->setLogin("");
		$this->setEmail("");

	}


	//atualiza um usuario existente
	public function update($login, $senha){
		$this->setLogin($login);
		$this->setSenha($password);

		$sql = new Sql();
		$sql->query("UPDATE tb_usuarios SET login = :LOGIN, senha = :PASSWORD WHERE id = :ID", array(
			":LOGIN" => $this->getLogin(),
			":PASSWORD" => $this->getSenha(),
			":ID" => $this->getId()
		));


	}


	//carrega pelo id
	public function loadById($id){
		$sql = new Sql();
		$results = $sql->select("SELECT * FROM usuarios WHERE id = :ID",array(
			":ID" => $id
		));

		if (count($results[0]) > 0) {
			
			$this->setData($results[0])	;

		}
	}


	//pega tudo da tabela tb_usuarios e orderna pelo login
	public static function getList(){
		$sql = new Sql();
		return $sql->select("SELECT * FROM tb_usuarios ORDER BY login");
	}


	//pesquisa pelo nome 
	public static function search($login){
		$sql = new Sql();
		return $sql->select("SELECT * FROM tb_usuarios WHERE login LIKE :SEARCH ORDER BY login", array(
			"SEARCH" =>  "%".$login."%"
		));
	}


	//função para fazer login
	public function login($login, $password){

		$sql = new Sql();
		$results = $sql->select("SELECT * FROM tb_usuarios WHERE login = :LOGIN AND senha = :PASSWORD",array(
			":LOGIN" => $login,
			":PASSWORD" => $password
		));

		if (count($results[0]) > 0) {
			
			$this->setData($results[0]);			

		} else {

			throw new Exception("Login e/ou senha inválidos.");
			
		}

	}

	public function setData($data){

		$this->setId($data['id']);
		$this->setLogin($data['login']);
		$this->setSenha($data['senha']);
		$this->setEmail($data['email']);

	}

	public function insert(){
		$sql = new Sql();
		$results = $sql->select("CALL sp_usuarios_insert(:LOGIN, :PASSWORD)",array(
			":LOGIN" => $this->getlogin(),
			":PASSWORD" => $this->getsenha()
		));

		if (count($results) > 0) {
			
			$this->setData($results[0]);	

		}
	}


}
	


?>