<div class="row" id="result">
	
</div>
<div class="row">
	<div class="col s10 offset-s1">
		<div class="row">
			<h5>Modification d'un compte :</h5>
		</div>
		<div class="row">
			<!-- DATE INPUT -->
			<div class="input-field col s6">
				<label for="name">Name :</label>
				<input type="text" name="name" value="<?= $datas['name'] ?>" required>
			</div>
			<!-- DAYS INPUT -->
			<div class="input-field col s6">
				<label for="firstName">First name :</label>
				<input type="text" name="firstName" value="<?= $datas['firstName'] ?>" required>
			</div>
			<!-- ADDRESS INPUT -->
			<div class="input-field col s12">
				<label for="address">Address :</label>
				<input type="text" name="address" value="<?= $datas['address'] ?>">
			</div>
			<!-- PHONE INPUT -->
			<div class="input-field col s6">
				<label for="phone">Num. téléphone</label>
				<input type="text" name="phone" value="<?= $datas['phone'] ?>" required>
			</div>
			<!-- MAIL INPUT -->
			<div class="input-field col s6">
				<label for="mail">e-mail</label>
				<input type="email" name="mail" value="<?= $datas['mail'] ?>">
			</div>
			<!-- SUBMIT BUTTON -->
			<div class="col s12">
				<button class="btn waves-effect waves-light right" id="upAccount">
					Enregistrer<i class="material-icons right">send</i>
				</button>
			</div>
		</div>
	</div>
</div>

<script>
	$(function ()
	{
		var WEBROOT = '<?= str_replace('index.php', '', $_SERVER['SCRIPT_NAME']); ?>';

		$('#upAccount').click(function ()
		{
			var POST = {
				name:      $('#input[name=name]').val(),
				firstname: $('#input[name=firstName]').val(),
				address:   $('#input[name=address]').val(),
				phone:     $('#input[name=phone]').val(),
				mail:      $('#input[name=mail]').val()
			}
			$.ajax({
				type: 'POST',
				url: WEBROOT + 'account/up/<?= $datas['id'] ?>',
				data: POST
			}).done(function (result)
			{
				$('#result').html(result);
			});
		});
	});
</script>