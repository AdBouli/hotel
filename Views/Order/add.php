<!-- MESSAGE -->
<?php if (isset($result)) : ?>
	<!-- IF RESULST IS TRUE -->
	<?php if ($result === TRUE) : ?>
		<div class="card-panel green-text center">Commande créée</div>
	<?php else : ?>
		<!-- IF RESULT IS FALSE -->
		<?php if ($result === FALSE) :?>
			<div class="card-panel red-text center">Erreur dans la création de la commande</div>
		<?php else : ?>
			<!-- ELSE RESULT IS A STRING -->
			<div class="card-panel orange-text center">Erreur: <?= $result ?></div>
		<?php endif; ?>
	<?php endif; ?>
<?php endif; ?>
