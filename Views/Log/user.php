<div class="row">
	<div class="col s12">
		<h5>Historique des reservations de l'utilisateur</h5>
	</div>
	<table class="col s12 striped">
		<thead>
			<tr>
				<th>Action</th>
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
			<?php foreach ($logs['reservations_logs'] as $log) : ?>
			<tr>
				<td><?= $log['action'] ?></td>
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
		<h5>Historique des commandes de l'utilisateur</h5>
	</div>
	<table class="col s12 striped">
		<thead>
			<tr>
				<th>Action</th>
				<th>Num</th>
				<th>Réservation</th>
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
				<td><?= $log['order_id'] ?></td>
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
		<h5>Historique des lignes de commande de l'utilisateur</h5>
	</div>
	<table class="col s12 striped">
		<thead>
			<tr>
				<th>Action</th>
				<th>Produit</th>
				<th>Num</th>
				<th>Commande</th>
				<th>Quantité</th>
				<th>Total</th>
				<th>Créée le</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($logs['lines_logs'] as $log) : ?>
			<tr>
				<td><?= $log['action'] ?></td>
				<td><?= $log['product'] ?></td>
				<td><?= $log['order_id'] ?></td>
				<td><?= $log['order'] ?></td>
				<td><?= $log['quantity'] ?></td>
				<td><?= $log['total'] ?></td>
				<td><?= $log['created'] ?></td>
			</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</div>
