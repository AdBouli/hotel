<div class="row">
	<div class="col s10 offset-s1">
		<div class="row">
			<div class="col s11">
				<h5>Rechercher une commande :</h5>
			</div>
			<div class="col s1">
				<a href="<?= WEBROOT ?>order/create" class="btn-floating btn-large waves-effect waves-light red">
					<i class="material-icons">add</i>
				</a>
			</div>
		</div>
		<div class="row">
			<div class="input-field col s3">
				<label for="reservation">Numéro de réservation</label>
				<input type="number" name="reservation">
			</div>
			<!-- ACCOUNT INPUT -->
			<div class="input-field col s4">
				<label for="account">Ou rechercher par nom :</label>
				<input type="text" id="accountInput" name="account">
			</div>
			<!-- PAID SELECT -->
			<div class="input-field col s2">
				<select name="paid">
					<option value="">Choix</option>
					<option value="oui">Oui</option>
					<option value="non">Non</option>
				</select>
			 	<label for="paid">Commande payée :</label>
			</div>
			<!-- SUBMIT BUTTON -->
			<div class="col s3">
				<button class="btn waves-effect waves-light right" id="updateResult">
					Rechercher<i class="material-icons right">search</i>
				</button>
			</div>
			<div class="col s8">
				<a href="<?= WEBROOT ?>reservation">Rechercher une réservation</a>
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
				account:     $('input[name=account]').val(),
				reservation: $('input[name=reservation]').select().val(),
				paid:        $('select[name=paid]').select().val()
			};
			$.ajax({
				type: "POST",
				url: WEBROOT + "order/search",
				data: POST
			}).done(function (result)
			{
				$('#results').html(result);
			});
		});

		$.ajax({
			type: "POST",
			url: WEBROOT + "order/search"
		}).done(function (result)
		{
			$('#results').html(result);
		});

	});
</script>