<form action="" method="post">
	
		<input type="hidden" name="joke[id]" value="<?=$joke['id'] ?? ''?>">

	<label for="joketext">Edita acá:</label>

	
	<textarea id="joketext" name="joke[joketext]" rows="3" cols="40"><?= $joke['joketext'] ?? ''?></textarea>

	<input type="submit" value="Guardar cambios">

</form>