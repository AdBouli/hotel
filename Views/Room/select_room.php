<select name="room" id="roomSelect">
	<option value="" selected>Choisir une chambre</option>
	<?php foreach ($rooms as $room) : ?>
		<?php extract($room) ?>
		<option value="<?= $id ?>"><?= 'C'.$num.' - '.$person.'p - '.$floor.'e étage - '.$price.'€' ?></option>
	<?php endforeach; ?>
</select>
<label for="room">Chambre :</label>

<script>
	$(function()
	{
		$('select').material_select();
	});
</script>