<select name="reservation" id="reservationSelect">
	<option value="" selected>Choisir une réservation</option>
	<?php foreach ($reservations as $reservation) : ?>
		<?php extract($reservation); ?>
		<option value="<?= $id ?>"><?= 'n°'.$id.' - du '.$dateStart.' au '.$dateEnd.' - chambre n°'.$num.' - '.$firstname.' '.$name.' - total:'.$total.'€' ?> </option>
	<?php endforeach; ?>
</select>
<label for="reservation">Reservation :</label>

<script>
	$(function()
	{
		$('select').material_select();
	});
</script>