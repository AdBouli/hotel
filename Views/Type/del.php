<!-- MESSAGE -->
<?php if (isset($result)) : ?>
	<!-- IF RESULST IS TRUE -->
	<?php if ($result === TRUE) : ?>
		<div class="card-panel green-text center">Type de chambre supprimé.</div>
	<?php else : ?>
		<div class="card-panel red-text center">Erreur dans la suppresion du type de chambre.</div>
	<?php endif; ?>
<?php endif; ?>