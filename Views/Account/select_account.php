<select name="account" id="accountSelect">
	<option value="" selected>Choisir un compte</option>
	<?php foreach ($accounts as $value) : ?>
		<option value="<?= $value['id'] ?>"> <?= $value['firstName'].' '.$value['name'].' - '.$value['address']  ?> </option>
	<?php endforeach; ?>
</select>
<label for="reservation">Compte :</label>

<script>
	$(function()
	{
		$('select').material_select();
	});
</script>