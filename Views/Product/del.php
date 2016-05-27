<!-- MESSAGE -->
<?php if (isset($result)) : ?>
	<!-- IF RESULST IS TRUE -->
	<?php if ($result === TRUE) : ?>
		<div class="card-panel green-text center">Produit supprimé.</div>
	<?php else : ?>
		<div class="card-panel red-text center">Erreur dans la suppression du produit.</div>
	<?php endif; ?>
<?php endif; ?>