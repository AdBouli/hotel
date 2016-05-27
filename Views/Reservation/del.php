<!-- MESSAGE -->
<?php if (isset($result)) : ?>
	<!-- IF RESULST IS TRUE -->
	<?php if ($result === TRUE) : ?>
		<div class="card-panel green-text center">Réservation supprimée.</div>
	<?php else : ?>
		<div class="card-panel red-text center">Erreur dans la suppression de la réservation.</div>
	<?php endif; ?>
<?php endif; ?>