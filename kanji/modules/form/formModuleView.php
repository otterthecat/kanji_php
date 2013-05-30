<form>
	<?php foreach ($elements as $el) : ?>
		<input type="<?php echo $el['type'] ?>" name="<?php echo $el['name'] ?>" class="<?php echo $el['class']; ?>"/>
	<?php endforeach; ?>
</form>
