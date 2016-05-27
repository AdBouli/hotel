<?php foreach ($lines as $line) : ?>
	<tr>
		<td><?= $line['name'] ?></td>
		<td><?= $line['price'] ?></td>
		<td><?= $line['quantity'] ?></td>
		<td><?= $line['total'] ?></td>
		<td>
			<a class="btn-floating btn-large waves-effect waves-light right red" onclick="delProductOrder(<?= $line['id'] ?>)">
				<i class="material-icons">delete</i>
			</a>
		</td>
	</tr>
<?php endforeach; ?>

<script>
	function delProductOrder(id)
	{
		var WEBROOT = '<?= str_replace('index.php', '', $_SERVER['SCRIPT_NAME']); ?>';
		$.ajax({
			url: WEBROOT + 'productorder/del/' + id
		}).done(function () {
			location.reload();
		});
	};
</script>