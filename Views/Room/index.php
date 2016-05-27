<div class="row">
	<div class="col s10 offset-s1">
		<div class="row">
			<div class="col s11">
				<h5>Recherche une chambre :</h5>
			</div>
			<div class="col s1">
				<a href="<?= WEBROOT ?>room/create" class="btn-floating btn-large waves-effect waves-light red">
					<i class="material-icons">add</i>
				</a>
			</div>
		</div>
		<div class="row">
			<!-- NUM INPUT -->
			<div class="input-field col s3">
				<label for="num">Numéro :</label>
				<input type="number" name="num">
			</div>
			<!-- FLOOR INPUT -->
			<div class="input-field col s3">
				<label for="floor">Etage :</label>
				<input type="number" name="floor">
			</div>
			<!-- PERSON INPUT -->
			<div class="input-field col s2">
				<label for="person">Personne(s) :</label>
				<input type="number" name="person">
			</div>
			<!-- TYPE INPUT -->
			<div class="input-field col s4">
				<select name="type">
					<option value="0" selected>Choix</option>
					<?php foreach ($types as $value) : ?>
						<option value="<?= $value['id'] ?>"> <?= $value['name'] ?> </option>
					<?php endforeach; ?>
				</select>
				<label for="type">Type de chambre :</label>
			</div>
		</div>
		<div class="row">
			<!-- SUBMIT BUTTON -->
			<div class="col s12">
				<button class="btn waves-effect waves-light right" id="updateResult">
					Rechercher<i class="material-icons right">search</i>
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

		$('select').material_select();

		var WEBROOT = '<?= str_replace('index.php', '', $_SERVER['SCRIPT_NAME']); ?>';

		$('#updateResult').click(function ()
		{
			var POST = {
				num:    $('input[name=num]').val(),
				person: $('input[name=person]').val(),
				floor:  $('input[name=floor]').val(),
				type:   $('select[name=type]').select().val(),
			};
			$.ajax({
				type: "POST",
				url:  WEBROOT + "room/search",
				data: POST
			}).done(function (result)
			{
				$('#results').html(result);
			});
		});

		$.ajax({
			type: "POST",
			url: WEBROOT + "room/search"
		}).done(function (result)
		{
			$('#results').html(result);
		});
	});
</script>