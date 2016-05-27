<select name="user">
	<option value="" selected>Choisir un utilisateur</option>
	<?php foreach ($users as $user) : ?>
		<?php extract($user) ?>
		<option value="<?= $id ?>"><?= $username.' ['.$right.']' ?></option>
	<?php endforeach; ?>
</select>

<script>
	$(function ()
	{
		$('select').material_select();
	});
</script>