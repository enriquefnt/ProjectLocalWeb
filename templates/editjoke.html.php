<form action="" method="post">
	
		<input type="hidden" name="jokeid" value="<?=$joke['id'] ?? ''?>">

	<label for="joketext">Edita acá:</label>

	<textarea id="joketext" name="joketext" rows="5" cols="160"><?=$joke['joketext']?></textarea>

	<input type="submit" value="Guardar cambios">

</form>