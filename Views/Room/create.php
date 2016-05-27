<div class="row" id="result">
	
</div>
<div class="row">
	<div class="col s10 push-s1">
		<div class="row">
			<h5>Création d'une chambre</h5>
		</div>
		<div class="row">
			<!-- NUM INPUT -->
			<div class="input-field col s3">
				<label for="num">Numéro :</label>
				<input type="number" name="num">
			</div>
			<!-- PERSON INPUT -->
			<div class="input-field col s3">
				<label for="person">Personne :</label>
				<input type="number" name="person">
			</div>
			<!-- FLOOR INPUT -->
			<div class="input-field col s3">
				<label for="floor">Etage :</label>
				<input type="number" name="floor">
			</div>
			<!-- PRICE INPUT -->
			<div class="input-field col s3">
				<label for="price">Prix :</label>
				<input type="number" step="0.01" min="0" name="price">
			</div>
			<!-- TYPE INPUT -->
			<div class="input-field col s6">
				<select name="type" required>
					<option value="" disabled selected>Choix</option>
					<?php foreach ($types as $value) : ?>
						<option value="<?= $value['id'] ?>"> <?= $value['name'] ?> </option>
					<?php endforeach; ?>
				</select>
				<label for="type">Type :</label>
			</div>
			<!-- SUBMIT BUTTON -->
			<div class="col s6">
				<button class="btn waves-effect waves-light right" id="addRoom">
					New<i class="material-icons right">send</i>
				</button>
			</div>
		</div>
	</div>
</div>

<script>
	$(function() {
		$( "#datepicker" ).datepicker({
			dateFormat: "yy-mm-dd",
			defaultDate: "#actualDate"
		});

		$('select').material_select();

		var WEBROOT = '<?= str_replace('index.php', '', $_SERVER['SCRIPT_NAME']); ?>';

		$('#addRoom').click(function ()
		{
			var POST = {
				num:     $('input[name=num]').val(),
				person:  $('input[name=person]').val(),
				floor:   $('input[name=floor]').val(),
				price:   $('input[name=price]').val(),
				type_id: $('select[name=type]').select().val()
			};
			$.ajax({
				type: 'POST',
				url: WEBROOT + 'room/add',
				data: POST
			}).done(function (result)
			{
				$('#result').html(result);
			});
		});
	});
</script>
