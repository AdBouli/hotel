<div class="row">
	<div class="col s12">
		<h5>Historique des reservation du compte</h5>
	</div>
	<table class="col s12 striped">
		<thead>
			<tr>
				<th>Action</th>
				<th>Utilisateur</th>
				<th>Chambre</th>
				<th>Dates</th>
				<th>Total</th>
				<th>Payé</th>
				<th>Créée le</th>
				<th>Mofifiée le</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($logs['reservations_logs'] as $log) : ?>
			<tr>
				<td><?= $log['action'] ?></td>
				<td><?= $log['user'] ?></td>
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
</div>
