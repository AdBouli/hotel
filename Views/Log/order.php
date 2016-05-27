<div class="row">
	<div class="col s12">
		<h5>Historique de la commande</h5>
	</div>
	<table class="col s12 striped">
		<thead>
			<tr>
				<th>Action</th>
				<th>Utilisateur</th>
				<th>Reservation</th>
				<th>Total</th>
				<th>Payée</th>
				<th>Créée le</th>
				<th>Mofifiée le</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($logs['order_logs'] as $log) : ?>
			<tr>
				<td><?= $log['action'] ?></td>
				<td><?= $log['user'] ?></td>
				<td><?= $log['reservation'] ?></td>
				<td><?= $log['total'] ?></td>
				<td><?= $log['paid'] ?></td>
				<td><?= $log['created'] ?></td>
				<td><?= $log['modified'] ?></td>
			</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
	<div class="col s12">
		<h5>Historique de ses lignes</h5>
	</div>
	<table class="col s12 striped">
		<thead>
			<tr>
				<th>Action</th>
				<th>User</th>
				<th>Produit</th>
				<th>Quantité</th>
				<th>Total</th>
				<th>Créée le</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($logs['lines_logs'] as $log) : ?>
			<tr>
				<td><?= $log['action'] ?></td>
				<td><?= $log['user'] ?></td>
				<td><?= $log['product'] ?></td>
				<td><?= $log['quantity'] ?></td>
				<td><?= $log['total'] ?></td>
				<td><?= $log['created'] ?></td>
			</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</div>
