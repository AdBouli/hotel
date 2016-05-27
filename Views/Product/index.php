<div class="row">
	<div class="col s10 offset-s1">
		<div class="row">
			<div class="col s11">
				<h5>Rechercher un produit :</h5>
			</div>
			<div class="col s1">
				<a href="<?= WEBROOT ?>product/create" class="btn-floating btn-large waves-effect waves-light red">
					<i class="material-icons">add</i>
				</a>
			</div>
		</div>
		<div class="row">
			<!-- NAME INPUT -->
			<div class="input-field col s9">
				<label for="name">Nom :</label>
				<input type="text" name="name">
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

		$('#updateResult').click(function ()
		{
			var POST = {
				name: $('input[name=name]').val(),
			};
			$.ajax({
				type: "POST",
				url: WEBROOT + "product/search",
				data: POST
			}).done(function (result)
			{
				$('#results').html(result);
			});
		});

		$.ajax({
			type: "POST",
			url: WEBROOT + "product/search"
		}).done(function (result)
		{
			$('#results').html(result);
		});
	});
</script>