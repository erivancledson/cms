<?php
class Paginas extends model {
           //pega todas as paginas do banco de dados
    //para o paginas do menu do painel adm
	public function getPaginas() {
		$array = array();

		$sql = "SELECT id, url, titulo FROM paginas";
		$sql = $this->db->query($sql);

		if($sql->rowCount() > 0) {
			$array = $sql->fetchAll();
		}

		return $array;
	}

	public function getPagina($url) {
		$array = array();

		$sql = "SELECT titulo, corpo FROM paginas WHERE url = '$url'";
		$sql = $this->db->query($sql);

		if($sql->rowCount() > 0) {
			$array = $sql->fetch();
		}

		return $array;
	}
        //utilizado no pagina_edit
             //recebe o id da pagina para procurar a pagina
	public function getPaginaById($id) {
		$array = array();

		$sql = "SELECT titulo, corpo, url FROM paginas WHERE id = '$id'";
		$sql = $this->db->query($sql);

		if($sql->rowCount() > 0) {
			$array = $sql->fetch();
		}

		return $array;
	}
        //deletando 1 pagina no  painel no menu paginas
	public function delete($id) {

		$this->db->query("DELETE FROM paginas WHERE id = '$id'");

	}
        //pagina_edit
	public function update($titulo, $url, $corpo, $id) {

		$this->db->query("UPDATE paginas SET titulo = '$titulo', url = '$url', corpo = '$corpo' WHERE id = '$id'");

	}
          //pagina_add
	public function insert($titulo, $url, $corpo) {

		$this->db->query("INSERT INTO paginas SET titulo = '$titulo', url = '$url', corpo = '$corpo'");
		
	}

}