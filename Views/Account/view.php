<div class="row" id="result">
	
</div>
<div class="row">
	<div class="col s10 offset-s1">
		<h5 class="center-align">Détail du compte</h5>
		<div class="row">
			<div class="col s6">
				<ul class="collection with-header">
					<!-- NAME FIRSTNAME -->
					<li class="collection-header"><h5><?= $datas['firstName'].' '.$datas['name'] ?></h5></li>
					<!-- ADDRESS -->
					<li class="collection-item">Adresse<div class="right"><?= $datas['address'] ?></div></li>
					<!-- PHONE -->
					<li class="collection-item">Num. téléphone<div class="right"><?= $datas['phone'] ?></div></li>
					<!-- MAIL -->
					<li class="collection-item">e-mail<div class="right"><?= $datas['mail'] ?></div></li>
					<!-- CREATED -->
					<li class="collection-item">Created<div class="right"><?= $datas['created'] ?></div></li>
					<!-- MODIFIED -->
					<li class="collection-item">Modified<div class="right"><?= $datas['modified'] ?></div></li>
				</ul>
				<a href="<?= WEBROOT ?>log/account/<?= $datas['id'] ?>">Consulter son historique</a>
				<!-- DELETED BUTTON -->
				<a class="btn-floating btn-large waves-effect waves-light right red" id="delAccount">
					<i class="material-icons">delete</i>
				</a>
				<!-- MODIFIED BUTTON -->
				<a href="<?= WEBROOT ?>account/modify/<?= $datas['id'] ?>" class="btn-floating btn-large waves-effect waves-light right orange">
					<i class="material-icons">mode_edit</i>
				</a>
			</div>
			<div class="col s6">
				<h6>Reservations :</h6>
				<table class="striped">
					<thead>
						<th data-field="num">Num.</th>
						<th data-field="date1">Du</th>
						<th data-field="date2">Au</th>
						<th data-field="total">Total</th>
						<th data-field="rest">Payée</th>
					</thead>
					<tbody>
						<?php foreach ($reservations as $reservation) : ?>
						<tr>
							<td><?= $reservation['id'] ?></td>
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

		$('#delAccount').click(function ()
		{
			$.ajax({
				type: 'POST',
				url: WEBROOT + 'account/del/<?= $datas['id'] ?>',
			}).done(function (result)
			{
				$('#result').html(result);
			});
		});
	});
</script>