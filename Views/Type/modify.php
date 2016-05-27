<div class="row" id="result">
	
</div>
<div class="row">
	<div class="col s10 offset-s1">
		<div class="row">
			<h5>Modification d'un type de chambre :</h5>
		</div>
		<div class="row">
			<!-- NAME INPUT -->
			<div class="input-field col s10">
				<label for="date">Name :</label>
				<input type="text" name="name" value="<?= $datas['name'] ?>">
			</div>
			<!-- SUBMIT BUTTON -->
			<div class="col s2">
				<button class="btn waves-effect waves-light" id="upType">
					Save<i class="material-icons right">send</i>
				</button>
			</div>
		</div>
	</div>
</div>

<script>
	$(function ()
	{
		var WEBROOT = '<?= str_replace('index.php', '', $_SERVER['SCRIPT_NAME']); ?>';
		
		$('#upType').click(function ()
		{
			var POST = {
				name: $('input[name=name]').val()
			};
			$.ajax({
				type: 'POST',
				url: WEBROOT + 'type/up/<?= $datas['id'] ?>',
				data: POST
			}).done(function (result)
			{
				$('#result').html(result);
			});
		});
	});
</script>
