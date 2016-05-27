<div class="row">
	<div class="col s10 offset-s1">
		<div class="row">
			<div class="col s12">
				<h5>Recherche une réservation :</h5>
			</div>
		</div>
		<div class="row">
			<!-- ACCOUNT INPUT -->
			<div class="input-field col s6">
				<label for="account">Compte :</label>
				<input type="text" name="account" placeholder="Non, prénom....">
			</div>
			<!-- DATE INPUT 1 -->
			<div class="input-field col s3">
				<label for="date">Date de début :</label>
				<input type="text" id="datepicker1" name="date1">
			</div>
			<!-- DATE INPUT 2 -->
			<div class="input-field col s3">
				<label for="date">Date de fin :</label>
				<input type="text" id="datepicker2" name="date2">
			</div>
			<!-- TYPE INPUT -->
			<div class="input-field col s4">
				<select name="type" id='typeSelect'>
					<option value="0" selected>Choisir un type de chambre</option>
					<?php foreach ($types as $value) : ?>
						<option value="<?= $value['id'] ?>"> <?= $value['name'] ?> </option>
					<?php endforeach; ?>
				</select>
			 	<label for="type">Type de chambre :</label>
			</div>				
			<!-- FLOOR INPUT -->
			<div class="input-field col s3">
				<label for="floor">Etage :</label>
				<input type="number" name="floor" id='floorInput'>
			</div>
			<!-- ROOM INPUT -->
			<div class="input-field col s5" id="selectRoom">
				<select name="room">
					<option value="" disabled selected>Choisir une chambre</option>
					<?php foreach ($rooms as $room) : ?>
						<?php extract($room) ?>
						<option value="<?= $id ?>"><?= 'C'.$num.' - '.$person.'p - '.$floor.'e étage - '.$price.'€' ?></option>
					<?php endforeach; ?>
				</select>
			 	<label for="room">Chambre :</label>
			</div>
			<!-- SUBMIT BUTTON -->
			<div class="col s12">
				<button class="btn waves-effect waves-light right" id="updateResult">
					Search<i class="material-icons right">search</i>
				</button>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col s12" id="results">
		
	</div>
</div>

<script>

	$(function() {
		$( "#datepicker1" ).datepicker({
			dateFormat: "yy-mm-dd",
			defaultDate: "#actualDate"
		});

		$( "#datepicker2" ).datepicker({
			dateFormat: "yy-mm-dd",
			defaultDate: "#actualDate"
		});

		$('select').material_select();

		$('#typeSelect').change(function ()
		{
			updateRoom();
		});

		$('#floorInput').change(function ()
		{
			updateRoom();
		});

		function updateRoom()
		{
			var WEBROOT = '<?= str_replace('index.php', '', $_SERVER['SCRIPT_NAME']); ?>';
			var POST = {
				type: $('#typeSelect').select().val(),
				floor: $('#floorInput').val()
			};
			$.ajax({
				type: "POST",
				url :  WEBROOT + "room/select_room",
				data : POST
			}).done(function (result)
			{
				$('#selectRoom').html(result);
			});
		}

		var WEBROOT = '<?= str_replace('index.php', '', $_SERVER['SCRIPT_NAME']); ?>';
		
		$('#updateResult').click(function ()
		{
			var POST = {
				account: $('input[name=account]').val(),
				date1:   $('input[name=date1]').val(),
				date2:   $('input[name=date2]').val(),
				type:    $('select[name=type]').select().val(),
				floor:   $('input[name=floor]').val(),
				room:    $('select[name=room]').select().val(),
			};
			$.ajax({
				type: "POST",
				url: WEBROOT + "reservation/search_for_create_order",
				data: POST
			}).done(function (result)
			{
				$('#results').html(result);
			});
		});

		$.ajax({
			type: "POST",
			url: WEBROOT + "reservation/search_for_create_order"
		}).done(function (result)
		{
			$('#results').html(result);
		});

	});
</script>