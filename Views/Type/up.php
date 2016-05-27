<!-- MESSAGE -->
<?php if (isset($result)) : ?>
	<!-- IF RESULST IS TRUE -->
	<?php if ($result === TRUE) : ?>
		<div class="card-panel green-text center">Type de chambre mis à jour.</div>
	<?php else : ?>
		<!-- IF RESULT IS FALSE -->
		<?php if ($result === FALSE) :?>
			<div class="card-panel red-text center">Erreur dans la mise à jour du type de chambre.</div>
		<?php else : ?>
			<!-- ELSE RESULT IS A STRING -->
			<div class="card-panel orange-text center">Erreur: <?= $result ?></div>
		<?php endif; ?>
	<?php endif; ?>
<?php endif; ?>
