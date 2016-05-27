<div class="row" id="result">
	
</div>
<div class="row">
	<div class="col s10 push-s1">
		<div class="row">
			<h5>Modification d'une chambre</h5>
		</div>
		<div class="row">
			<!-- NUM INPUT -->
			<div class="input-field col s3">
				<label for="num">Numero :</label>
				<input type="number" name="num" value="<?= $datas['num'] ?>">
			</div>
			<!-- PERSON INPUT -->
			<div class="input-field col s3">
				<label for="person">Personne :</label>
				<input type="number" name="person" value="<?= $datas['person'] ?>">
			</div>
			<!-- FLOOR INPUT -->
			<div class="input-field col s3">
				<label for="floor">Etage :</label>
				<input type="number" name="floor" value="<?= $datas['floor'] ?>">
			</div>
			<!-- PRICE INPUT -->
			<div class="input-field col s3">
				<label for="price">Prix :</label>
				<input type="number" step="0.01" min="0" name="price" value="<?= $datas['price'] ?>">
			</div>
			<!-- TYPE INPUT -->
			<div class="input-field col s6">
				<select name="type" required>
					<option value="" disabled>Choose type</option>
						<?php foreach ($types as $value) : ?>
							<?php if ($value['id'] == $datas['type_id']) : ?>
							<option value="<?= $value['id'] ?>" selected> <?= $value['name'] ?> </option>
							<?php else : ?>
							<option value="<?= $value['id'] ?>"> <?= $value['name'] ?> </option>
							<?php endif; ?>
						<?php endforeach; ?>
				</select>
				<label for="type">Type :</label>
			</div>
			<!-- SUBMIT BUTTON -->
			<div class="col s2 offset-s4">
				<button class="btn waves-effect waves-light" id="upRoom">
					Save<i class="material-icons right">send</i>
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

		$('#upRoom').click(function ()
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
				url:  WEBROOT + 'room/up/<?= $datas['id'] ?>',
				data: POST
			}).done(function (result)
			{
				$('#result').html(result);
			});
		});
	});
</script>
