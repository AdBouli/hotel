<div class="row" id="result">
	
</div>
<div class="row">
	<div class="col s10 offset-s1">
		<div class="row">
			<h5>Modification d'un produit :</h5>
		</div>
		<div class="row">
			<!-- NAME INPUT -->
			<div class="input-field col s6">
				<label for="date">Nom :</label>
				<input type="text" name="name" value="<?= $datas['name'] ?>" required>
			</div>
			<!-- PRICE INPUT -->
			<div class="input-field col s4">
				<label for="days">Prix :</label>
				<input type="number" step="0.01" min="0" name="price" value="<?= $datas['price'] ?>" required>
			</div>
			<!-- SUBMIT BUTTON -->
			<div class="col s2">
				<button class="btn waves-effect waves-light" id="upProduct">
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
		
		$('#upProduct').click(function ()
		{
			var POST = {
				name:  $('input[name=name]').val(),
				price: $('input[name=price]').val()
			};
			$.ajax({
				type: 'POST',
				url:  WEBROOT + 'product/up/<?= $datas['id'] ?>',
				data : POST
			}).done(function (result)
			{
				$('#result').html(result);
			});
		});
	});
</script>