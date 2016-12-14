<?php
class Menu extends model {
 // chama os menus do site no painel adm
	public function getMenu($id=0) {
		$array = array();
                //pega todos os menus do banco
		$sql = "SELECT * FROM menu";
		if($id > 0) {
			$sql .= " WHERE id = '$id'";
		}

		$sql = $this->db->query($sql);

		if($sql->rowCount() > 0) {
			if($id > 0) {
				$array = $sql->fetch();
			} else {
				$array = $sql->fetchAll();
			}
		}

		return $array;
	}
        //para o botão de deletar menu
	public function delete($id) {

		$this->db->query("DELETE FROM menu WHERE id = '$id'");

	}
         //update do atualizar menu. que vem do model 
	public function update($nome, $url, $id) {

		$this->db->query("UPDATE menu SET nome = '$nome', url = '$url' WHERE id = '$id'");

	}
             //inserindo um menu
	public function insert($nome, $url) {
		$this->db->query("INSERT INTO menu SET nome = '$nome', url = '$url'");
	}

}