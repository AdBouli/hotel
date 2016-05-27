<div class="row">
	<div class="col s10 offset-s1">
		<div class="row">
			<div class="col s11">
				<h5>Recherche un compte :</h5>
			</div>
			<div class="col s1">
				<a href="<?= WEBROOT ?>account/create" class="btn-floating btn-large waves-effect waves-light red">
					<i class="material-icons">add</i>
				</a>
			</div>
		</div>
		
		<div class="row">
			<!-- NAMES INPUT -->
			<div class="input-field col s5">
				<label for="name">Compte :</label>
				<input type="text" name="name" placeholder="Nom, prénom...">
			</div>
			<!-- NAMES INPUT -->
			<div class="input-field col s7">
				<label for="address">Adresse :</label>
				<input type="text" name="address">
			</div>
			<!-- PHONE INPUT -->
			<div class="input-field col s4">
				<label for="phone">Num. téléphone :</label>
				<input type="text" name="phone">
			</div>
			<!-- MAIL INPUT -->
			<div class="input-field col s4">
				<label for="mail">e-mail :</label>
				<input type="text" name="mail">
			</div>
			<!-- SUBMIT BUTTON -->
			<div class="col s4">
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
	$(function()
	{
		var WEBROOT = '<?= str_replace('index.php', '', $_SERVER['SCRIPT_NAME']); ?>';
		
		$('#updateResult').click(function ()
		{
			var POST = {
				name: $('input[name=name]').val(),
				address: $('input[name=address]').val(),
				phone: $('input[name=phone]').val(),
				mail: $('input[name=mail]').val(),
			};
			$.ajax({
				type: "POST",
				url: WEBROOT + "account/search",
				data: POST
			}).done(function (result)
			{
				$('#results').html(result);
			});
		});

		$.ajax({
			type: "POST",
			url: WEBROOT + "account/search"
		}).done(function (result)
		{
			$('#results').html(result);
		});
	});
</script>