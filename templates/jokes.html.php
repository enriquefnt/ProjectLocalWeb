
<p> Hay <?=$totalJokes?> chistes en la base. </p>
<?php foreach ($jokes as $joke): ?>
<blockquote>
	<p>
	<?=htmlspecialchars($joke['joketext'], ENT_QUOTES, 'UTF-8')?>

    (by <a href="mailto:<?=htmlspecialchars($joke['email'], ENT_QUOTES,
                    'UTF-8'); ?>">
                <?=htmlspecialchars($joke['name'], ENT_QUOTES,
                    'UTF-8'); ?></a> el día 
<?php
                $date = new DateTime($joke['jokedate']);

                echo $date->format('d/m/y');
?>)
    
  
  <a href="editjoke.php?id=<?=$joke['id']?>">Edit</a>
  <form action="deletejoke.php" method="post">
    <input type="hidden" name="id" value="<?=$joke['id']?>">
    <input type="submit" value="Eliminar">
		</form>
	</p>
</blockquote>
<?php endforeach; ?>