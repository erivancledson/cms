<h1>Adicionar Página</h1>
<form method="POST">
	Titulo da página:<br/>
	<input type="text" name="titulo" /><br/><br/>

	URL da Página:<br/>
	<input type="text" name="url" /><br/><br/>
        <!--cria o menu automatico -->
	Criar Menu Automaticamente:<br/>
	<input type="checkbox" name="add_menu" value="sim" /><br/><br/>
       <!--id=corpo é para o ckeditor -->
	Corpo da página:<br/>
	<textarea name="corpo" id="corpo"></textarea><br/><br/>

	<input type="submit" value="Salvar" />
</form>
<!--inserindo o ckeditor no site -->
<script type="text/javascript" src="<?php echo BASE; ?>ckeditor/ckeditor.js"></script>
<!--rodando o ckeditor, tem que passar o id corpo que é aonde ele vai ficar -->
<script type="text/javascript">
window.onload = function() {
	CKEDITOR.replace("corpo");
}
</script>