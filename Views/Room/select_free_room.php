<!-- ROOM INPUT -->
<select name="room" id="roomSelect">
	<option value="" disabled>Choisir une chambre</option>
<?php foreach ($types as $type) : ?>
	<optgroup label="Type <?= $type['name'] ?>">
	<?php foreach ($free_rooms as $free_room) : ?>
		<?php extract($free_room); ?>
		<!-- If room as current type -->
		<?php if ($type['id'] == $type_id) : ?>
			<option value="<?= $id ?>"><?= 'C'.$num.' - '.$person.'p - '.$floor.'e étage - '.$price.'€' ?></option>
		<?php endif; ?>
	<?php endforeach; ?>
	</optgroup>
<?php endforeach; ?>
</select>
<label for="room">Chambre :</label>

<script>
	$(function()
	{
		// SELECT
		$('select').material_select();
	});
</script>
