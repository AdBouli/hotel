<div class="row" id="result">
	
</div>
<div class="row">
	<div class="col s10 offset-s1">
		<div class="row">
			<h5>Création d'un utilisateur :</h5>
		</div>
		<div class="row">
			<!-- NAME INPUT -->
			<div class="input-field col s6">
				<label for="username">Nom d'utilisateur :</label>
				<input type="text" name="username" required>
			</div>
			<!-- PASSWORD INPUT -->
			<div class="input-field col s6">
				<label for="password">Mot de passe :</label>
				<input type="password" name="password" required>
			</div>
			<!-- RIGHT INPUT -->
			<div class="input-field col s3">
				<select name="right">
					<option value="">Choix</option>
					<option value="all">Tous</option>
					<option value="hotel">Hotel</option>
					<option value="bar">Bar</option>
				</select>
				<label for="right">Droit :</label>
			</div>
			<!-- SUBMIT BUTTON -->
			<div class="col s9">
				<button class="btn waves-effect waves-light right" id="addUser">
					Créer<i class="material-icons right">send</i>
				</button>
			</div>
		</div>
	</div>
</div>

<script>
	$(function ()
	{
		var WEBROOT = '<?= str_replace('index.php', '', $_SERVER['SCRIPT_NAME']); ?>';
		
		$('select').material_select();

		$('#addUser').click(function ()
		{
			var POST = {
				username: $('input[name=username]').val(),
				password: $('input[name=password]').val(),
				right   : $('select[name=right]').select().val()
			};
			$.ajax({
				type: 'POST',
				url:  WEBROOT + 'user/add',
				data: POST
			}).done(function (result)
			{
				$('#result').html(result);
			});
		});
	});
</script>
