<div class="row">
	<div class="col s10 offset-s1">
		<div class="row">
			<div class="col s11">
				<h5>Recherche un utilisateur :</h5>
			</div>
			<div class="col s1">
				<a href="<?= WEBROOT ?>user/create" class="btn-floating btn-large waves-effect waves-light red">
					<i class="material-icons">add</i>
				</a>
			</div>
		</div>
		<div class="row">
			<!-- USERNAME INPUT -->
			<div class="input-field col s5">
				<label for="name">Nom d'utilisateur :</label>
				<input type="text" name="name">
			</div>
			<!-- RIGHT INPUT -->
			<div class="input-field col s4">
				<select name="right">
					<option value="">Choix</option>
					<option value="all">Tous</option>
					<option value="hotel">Hotel</option>
					<option value="bar">Bar</option>
				</select>
				<label for="right">Droit :</label>
			</div>
			<!-- SUBMIT BUTTON -->
			<div class="col s3">
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
		var WEBROOT = '<?= str_replace('index.php', '', $_SERVER['SCRIPT_NAME']); ?>';

		$('select').material_select();

		$('#updateResult').click(function ()
		{
			var POST = {
				username: $('input[name=name]').val(),
				right:    $('select[name=right]').select().val(),
			};
			$.ajax({
				type: "POST",
				url: WEBROOT + "user/search",
				data: POST
			}).done(function (result)
			{
				$('#results').html(result);
			});
		});

		$.ajax({
			type: "POST",
			url: WEBROOT + "user/search"
		}).done(function (result)
		{
			$('#results').html(result);
		});
	});
</script>