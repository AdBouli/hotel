<div class="row" id="result">
	
</div>
<div class="row">
	<div class="col s10 offset-s1">
		<h5 class="center-align">Détail d'une commande</h5>
		<div class="row">
			<div class="col s12">
				<table class="centered">
					<thead>
						<tr>
							<th>N° commande</th>
							<th>N° reservation</th>
							<th>N° chambre</th>
							<th>Compte</th>
							<th>Total reservation</th>
							<th>Total commande</th>
						</tr>
					</thead>

					<tbody>
						<tr>
							<td><?= $datas['id'] ?></td>
							<td><a href="<?= WEBROOT ?>reservation/view/<?= $reservation['id'] ?>"><?= $reservation['id'] ?></a></td>
							<td><?= $room['num'] ?></td>
							<td><?= $account['firstName'].' '.$account['name'] ?></td>
							<td><?= $reservation['total'] ?></td>
							<td><?= $datas['total'] ?></td>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="col s6">
				<a href="<?= WEBROOT ?>log/order/<?= $datas['id'] ?>">Consulter son historique</a>
			</div>
			<div class="col s6">
				<!-- DELETED BUTTON -->
				<a class="btn-floating btn-large waves-effect waves-light right red" id="delOrder">
					<i class="material-icons">delete</i>
				</a>
				<!-- MODIFIED BUTTON -->
				<?php if ($datas['paid'] == 0) : ?>
				<a href="<?= WEBROOT ?>order/modify/<?= $datas['id'] ?>" class="btn-floating btn-large waves-effect waves-light right orange">
					<i class="material-icons">mode_edit</i>
				</a>				
				<?php else : ?>
					<p class="red-text right">Cette commande est payée, elle ne peut pas être modifiée. </p>
				<?php endif; ?>
			</div>
			<div class="col s12">
				<table class="striped">
					<thead>
						<tr>
							<th>Produit</th>
							<th>Prix</th>
							<th>Quantité</th>
							<th>Montant</th>
						</tr>
					</thead>
					<tbody>
					<?php foreach ($lines as $line) : ?>
						<tr>
							<td><?= $line['name'] ?></td>
							<td><?= $line['price'] ?></td>
							<td><?= $line['quantity'] ?></td>
							<td><?= $line['total'] ?></td>
						</tr>
					<?php endforeach; ?>
					</tbody>
				</table>
			</div>
			<div class="col s12">				
					<?php if ($datas['paid'] == 0) : ?>
						<p class="red-text right">Non payée</p>
					<?php else : ?>
						<p class="green-text right">Payée</p>
					<?php endif; ?>
				</p>
			</div>
		</div>
	</div>
</div>

<script>
	$(function ()
	{
		var WEBROOT = '<?= str_replace('index.php', '', $_SERVER['SCRIPT_NAME']); ?>';

		$('#delOrder').click(function ()
		{
			$.ajax({
				type: 'POST',
				url: WEBROOT + 'order/del/<?= $datas['id'] ?>',
			}).done(function (result)
			{
				$('#result').html(result);
			});
		});
	});
</script>

