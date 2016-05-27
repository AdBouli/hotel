<!-- MESSAGE -->
<?php if (isset($result)) : ?>
	<!-- IF RESULST IS TRUE -->
	<?php if ($result === TRUE) : ?>
		<div class="card-panel green-text center">Utilisateur supprimé.</div>
	<?php else : ?>
		<div class="card-panel red-text center">Erreur dans la suppression de l'utilisateur.</div>
	<?php endif; ?>
<?php endif; ?>