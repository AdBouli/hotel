<div class="row" id="result">
	
</div>
<div class="row">
	<div class="col s10 offset-s1">
		<h5 class="center-align">Détail du type de chambre</h5>
		<div class="row">
			<div class="col s6">
				<ul class="collection with-header">
					<!-- NAME FIRSTNAME -->
					<li class="collection-header"><h5><?= $datas['name'] ?></h5></li>
				</ul>
				<!-- DELETED BUTTON -->
				<a class="btn-floating btn-large waves-effect waves-light right red" id="delType">
					<i class="material-icons">delete</i>
				</a>
				<!-- MODIFIED BUTTON -->
				<a href="<?= WEBROOT ?>type/modify/<?= $datas['id'] ?>" class="btn-floating btn-large waves-effect waves-light right orange">
					<i class="material-icons">mode_edit</i>
				</a>
			</div>
			<div class="col s6">
				<h6>Chambres :</h6>
				<table class="striped">
					<thead>
						<th data-field="num">Num.</th>
						<th data-field="num">Pers.</th>
						<th data-field="floor">Etage</th>
						<th data-field="price">Prix</th>
					</thead>
					<tbody>
						<?php foreach ($rooms as $room) : ?>
						<tr>
							<td><?= $room['num'] ?></td>
							<td><?= $room['person'] ?></td>
							<td><?= $room['floor'] ?></td>
							<td><?= $room['price'] ?></td>
							<td>
				        <a href="<?= WEBROOT ?>room/view/<?= $room['id'] ?>" class="btn-floating btn-small waves-effect waves-light green">
				          <i class="material-icons">send</i>
				        </a>
			        </td>
						</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<script>
	$(function ()
	{
		var WEBROOT = '<?= str_replace('index.php', '', $_SERVER['SCRIPT_NAME']); ?>';

		$('#delType').click(function ()
		{
			$.ajax({
				type: 'POST',
				url: WEBROOT + 'type/del/<?= $datas['id'] ?>',
			}).done(function (result)
			{
				$('#result').html(result);
			});
		});
	});
</script>