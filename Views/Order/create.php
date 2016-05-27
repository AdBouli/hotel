<div class="row" id="result">
	
</div>
<div class="row">
	<div class="col s10 offset-s1">
		<div class="row">
			<h5>Création d'une commande</h5>
		</div>
		<div class="row">
			<div class="col s12">
				<table class="centered">
					<thead>
						<tr>
							<th>N° reservation</th>
							<th>N° chambre</th>
							<th>Compte</th>
							<th>Total reservation</th>
						</tr>
					</thead>

					<tbody>
						<tr>
							<td><?= $reservation['id'] ?></td>
							<td><?= $room['num'] ?></td>
							<td><?= $account['firstName'].' '.$account['name'] ?></td>
							<td><?= $reservation['total'] ?></td>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="col s12">
				<button class="btn waves-effect waves-light right" id="addOrder">
					Créer<i class="material-icons right">send</i>
				</button>
			</div>
		</div>
	</div>
</div>

<script>
	$(function() {

		$('select').material_select();

		var WEBROOT = '<?= str_replace('index.php', '', $_SERVER['SCRIPT_NAME']); ?>';

		$('#addOrder').click(function ()
		{
			var POST = {
				reservation_id: <?= $reservation['id'] ?>
			};
			$.ajax({
				type: 'POST',
				url:  WEBROOT + 'order/add/',
				data: POST
			}).done(function (result)
			{
				if (result == 'success')
				{
					$.ajax({
						url: WEBROOT + 'reservation/get_last_order/<?= $reservation['id'] ?>'
					}).done(function (result)
					{
						$(location).attr('href', WEBROOT+'order/modify/'+result);;
					});
				} else
				{
					$('#result').html(result);
				}
			});
		});

	});
</script>