<!-- MESSAGE -->
<?php if (isset($result)) : ?>
	<!-- IF RESULST IS TRUE -->
	<?php if ($result === TRUE) : ?>
		<div class="card-panel green-text center">Compte supprimé.</div>
	<?php else : ?>
		<div class="card-panel red-text center">Erreur dans la suppression du compte.</div>
	<?php endif; ?>
<?php endif; ?>