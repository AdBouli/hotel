<div class="row" id="result">
	
</div>
<div class="row">
	<div class="col s10 offset-s1">
		<h5 class="center-align">Détail d'une chambre</h5>
		<div class="row">
			<div class="col s6">
				<ul class="collection with-header">
					<!-- NUM -->
					<li class="collection-header"><h5>Chambre numéro: <?= $datas['num'] ?></h5></li>
					<!-- PERSON -->
					<li class="collection-item">Personne<div class="right"><?= $datas['person'] ?></div></li>
					<!-- FLOOR -->
					<li class="collection-item">Etage<div class="right"><?= $datas['floor'] ?></div></li>
					<!-- PRICE -->
					<li class="collection-item">Prix<div class="right"><?= $datas['price'] ?></div></li>
					<!-- TYPE -->
					<li class="collection-item">Type<div class="right"><?= $type ?></div></li>
				</ul>
				<a href="<?= WEBROOT ?>log/room/<?= $datas['id'] ?>">Consulter son historique</a>
				<!-- DELETED BUTTON -->
				<a class="btn-floating btn-large waves-effect waves-light right red" id="delRoom">
					<i class="material-icons">delete</i>
				</a>
				<!-- MODIFIED BUTTON -->
				<a href="<?= WEBROOT ?>room/modify/<?= $datas['id'] ?>" class="btn-floating btn-large waves-effect waves-light right orange">
					<i class="material-icons">mode_edit</i>
				</a>
			</div>
			<div class="col s6">
				<h6>Reservations :</h6>
				<table class="striped">
					<thead>
						<th data-field="date">Du</th>
						<th data-field="days">Au</th>
						<th data-field="total">Total</th>
						<th data-field="rest">Payé</th>
					</thead>
					<tbody>
						<?php foreach ($reservations as $reservation) : ?>
						<tr>
							<td><?= $reservation['dateStart'] ?></td>
							<td><?= $reservation['dateEnd'] ?></td>
							<td><?= $reservation['total'] ?></td>
							<td><?= $reservation['paid'] ?></td>
							<td>
				        <a href="<?= WEBROOT ?>reservation/view/<?= $reservation['id'] ?>" class="btn-floating btn-small waves-effect waves-light green">
				          <i class="material-icons">send</i>
				        </a>
			        </td>
						</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<script>
	$(function ()
	{
		var WEBROOT = '<?= str_replace('index.php', '', $_SERVER['SCRIPT_NAME']); ?>';

		$('#delRoom').click(function ()
		{
			$.ajax({
				type: 'POST',
				url: WEBROOT + 'room/del/<?= $datas['id'] ?>',
			}).done(function (result)
			{
				$('#result').html(result);
			});
		});
	});
</script>