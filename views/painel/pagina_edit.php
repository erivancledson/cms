<h1>Editar Página</h1>
<form method="POST">
	Titulo da página:<br/>
	<input type="text" name="titulo" value="<?php echo utf8_encode($pagina['titulo']); ?>" /><br/><br/>

	URL do Menu:<br/>
	<input type="text" name="url" value="<?php echo $pagina['url']; ?>" /><br/><br/>
<!--id=corpo é para o ckeditor -->
	Corpo da página:<br/>
	<textarea name="corpo" id="corpo"><?php echo $pagina['corpo']; ?></textarea><br/><br/>

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