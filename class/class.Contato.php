<?php

/**
 * Contatos
 */

class Contato extends Sistema{
    
	public function listarContatos($busca = array()){
		$mysqli = new mysqli(HOST, USER, PASS, DB);

		$sql = "SELECT con.* 
					FROM contato AS con
				WHERE 1=1";

		if($busca['nome'] != ""){
			$sql .= " AND con.con_nome LIKE ?";
			$dados[] = "%".$busca['nome']."%";
		}

		$resultado = mysqli_prepared_query($mysqli,$sql,$dados);
		
		$mysqli->close();
		
		return $resultado;
	}

	public function carregarContatos(){
		$mysqli = new mysqli(HOST, USER, PASS, DB);

		$sql = "SELECT con.*
					FROM contato AS con
				WHERE con.con_id = ?";		

		$dados = array($this->con_id);

		$resultado = mysqli_prepared_query($mysqli,$sql,$dados);
		
		$mysqli->close();
		
		return $resultado[0];
	}

	public function carregarTelefones(){
		$mysqli = new mysqli(HOST, USER, PASS, DB);

		$sql = "SELECT tel.* 
					FROM telefone AS tel
				WHERE tel.con_id = ?";		

		$dados = array($this->con_id);

		$resultado = mysqli_prepared_query($mysqli,$sql,$dados);
		
		$mysqli->close();
		
		return $resultado;
	}

	public function gravarContato($campos){
		$mysqli = new mysqli(HOST, USER, PASS, DB);

		$sql = "INSERT INTO contato (
					con_id, 
					con_nome
				) VALUES (
					?,
					?
				) ON DUPLICATE KEY UPDATE
					con_id = ?, 
					con_nome = ?
				";

		$dados = array(
			$this->con_id,
			$campos['nome'],
			$this->con_id,
			$campos['nome']
		);

		if($this->con_id > 0){
			$sqlDelTel = "DELETE FROM telefone WHERE con_id = ?";
			$dadosDel = array($this->con_id);
			mysqli_prepared_query($mysqli,$sqlDelTel,$dadosDel);
		}

		if(mysqli_prepared_query($mysqli,$sql,$dados)){
			if($this->con_id > 0){
				$contato = $this->con_id;
			}else{
				$contato = $mysqli->insert_id;
			}			

			$sqlTel = "INSERT INTO telefone (con_id,tel_telefone) VALUES (?,?)";

			foreach ($campos['telefones'] as $value) {
				$dadosTel = array($contato,$value);
				mysqli_prepared_query($mysqli,$sqlTel,$dadosTel);
			}

			$retorno = array('resposta' => true, 'msg' => 'Adicionado com sucesso!');
		}else{
			$retorno = array('resposta' => false, 'msg' => 'Erro ao adicionar!');
		}
		
		$mysqli->close();
		return $retorno;
	}

	public function apagarNumero($campo){
		$mysqli = new mysqli(HOST, USER, PASS, DB);

		$sql = "DELETE FROM telefone WHERE tel_id = ?";

		$dados = array($campo['numero']);

		if(mysqli_prepared_query($mysqli,$sql,$dados)){
			$retorno = array('resposta' => true, 'msg' => 'Apagado com sucesso!');
		}else{
			$retorno = array('resposta' => false, 'msg' => 'Erro ao Apagar!');
		}

		$mysqli->close();
		return $retorno;
	}

	public function apagarContato($campo){
		$mysqli = new mysqli(HOST, USER, PASS, DB);

		$sql = "DELETE FROM contato WHERE con_id = ?";

		$dados = array($campo['contato']);

		if(mysqli_prepared_query($mysqli,$sql,$dados)){
			$retorno = array('resposta' => true, 'msg' => 'Apagado com sucesso!');
		}else{
			$retorno = array('resposta' => false, 'msg' => 'Erro ao Apagar!');
		}

		$mysqli->close();
		return $retorno;
	}

}

?>