<div class="row" id="result">
	
</div>
<div class="row">
	<div class="col s10 offset-s1">
		<div class="row">
			<h5>Création d'un compte :</h5>
		</div>
		<div class="row">
			<!-- NAME INPUT -->
			<div class="input-field col s6">
				<label for="name">Nom :</label>
				<input type="text" name="name">
			</div>
			<!-- FISRTNAME INPUT -->
			<div class="input-field col s6">
				<label for="firstName">Prénom :</label>
				<input type="text" name="firstName">
			</div>
			<!-- ADDRESS INPUT -->
			<div class="input-field col s12">
				<label for="address">Adresse :</label>
				<input type="text" name="address">
			</div>
			<!-- PHONE INPUT -->
			<div class="input-field col s6">
				<label for="phone">Num. téléphone</label>
				<input type="text" name="phone">
			</div>
			<!-- MAIL INPUT -->
			<div class="input-field col s6">
				<label for="mail">e-mail</label>
				<input type="email" name="mail">
			</div>
			<!-- SUBMIT BUTTON -->
			<div class="col s12">
				<button class="btn waves-effect waves-light right" id="addAccount">
					Nouveau<i class="material-icons right">send</i>
				</button>
			</div>
		</div>
	</div>
</div>

<script>
	$(function ()
	{
		var WEBROOT = '<?= str_replace('index.php', '', $_SERVER['SCRIPT_NAME']); ?>';

		$('#addAccount').click(function ()
		{
			var POST = {
				name: $('input[name=name]').val(),
				firstName: $('input[name=firstName]').val(),
				address: $('input[name=address]').val(),
				phone: $('input[name=phone]').val(),
				mail: $('input[name=mail]').val()
			};
			$.ajax({
				type: 'POST',
				url: WEBROOT + 'account/add',
				data: POST
			}).done(function (result)
			{
				$('#result').html(result);
			});
		});
	});
</script>