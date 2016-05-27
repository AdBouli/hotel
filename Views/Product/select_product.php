<select name="product" id="selectProduct">
	<option value="0" selected>Choisir un produit</option>
	<?php foreach ($products as $product) : ?>
		<option value="<?= $product['id'] ?>"><?= $product['name'].' - '.$product['price'].'€' ?></option>
	<?php endforeach; ?>
</select>
<label for="product">Produit :</label>

<script>
	$(function ()
	{
		$('select').material_select();
	});
</script>