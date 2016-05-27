<div class="row">
	<div class="col s12">
		<h5>Historique de la réservation</h5>
	</div>
	<table class="col s12 striped">
		<thead>
			<tr>
				<th>Action</th>
				<th>Utilisateur</th>
				<th>Compte</th>
				<th>Chambre</th>
				<th>Dates</th>
				<th>Total</th>
				<th>Payé</th>
				<th>Créée le</th>
				<th>Mofifiée le</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($logs['reservation_logs'] as $log) : ?>
			<tr>
				<td><?= $log['action'] ?></td>
				<td><?= $log['user'] ?></td>
				<td><?= $log['account'] ?></td>
				<td><?= $log['room'] ?></td>
				<td><?= $log['dates'] ?></td>
				<td><?= $log['total'] ?></td>
				<td><?= $log['paid'] ?></td>
				<td><?= $log['created'] ?></td>
				<td><?= $log['modified'] ?></td>
			</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
	<div class="col s12">
		<h5>Historique de ses commandes</h5>
	</div>
	<table class="col s12 striped">
		<thead>
			<tr>
				<th>Action</th>
				<th>User</th>
				<th>Num</th>
				<th>Total</th>
				<th>Payée</th>
				<th>Créée le</th>
				<th>Modifiée le</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($logs['orders_logs'] as $log) : ?>
			<tr>
				<td><?= $log['action'] ?></td>
				<td><?= $log['user'] ?></td>
				<td><?= $log['order_id'] ?></td>
				<td><?= $log['total'] ?></td>
				<td><?= $log['paid'] ?></td>
				<td><?= $log['created'] ?></td>
				<td><?= $log['modified'] ?></td>
			</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</div>
