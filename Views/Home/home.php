<div class="row">
	<div class="col s4 offset-s4">
		<div class="row">
			<div class="col s12">
				<p class="red-text center-align hide" id="msgError">Identifiant ou mot de passe incorrect.</p>
			</div>
			<div class="input-field col s12">
				<label for="username">Identifiant :</label>
				<input type="text" name="username">
			</div>
			<div class="input-field col s12">
				<label for="password">Mot de passe :</label>
				<input type="password" name="password">
			</div>
			<div class="col s12">
				<button class="btn waves-effect waves-light right" id="btnLogin">
					Se connecter<i class="material-icons right">send</i>
				</button>
			</div>
		</div>
	</div>
</div>

<script>
	$(function ()
	{
		var WEBROOT = '<?= str_replace('index.php', '', $_SERVER['SCRIPT_NAME']); ?>';

		$('#btnLogin').click(function ()
		{
			var POST = {
				username: $('input[name=username]').val(),
				password: $('input[name=password]').val()
			};
			$.ajax({
				type: 'POST',
				url: WEBROOT + 'user/login',
				data: POST
			}).done(function (result) {
				console.log(result);
				if (result == 'success')
				{
					$(location).attr('href', WEBROOT+'reservation');
				} else
				{
					$('#msgError').removeClass('hide');
				}
			});
		});
	});
</script>