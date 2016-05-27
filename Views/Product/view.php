<div class="row" id="result">
	
</div>
<div class="row">
	<div class="col s10 offset-s1">
		<h5 class="center-align">Détail du produit</h5>
		<div class="row">
			<div class="col s6">
				<ul class="collection with-header">
					<!-- NAME FIRSTNAME -->
					<li class="collection-header"><h5><?= $datas['name'] ?></h5></li>
					<!-- Price -->
					<li class="collection-item">Prix<div class="right"><?= $datas['price'] ?></div></li>
				</ul>
				<!-- DELETED BUTTON -->
				<a class="btn-floating btn-large waves-effect waves-light right red" id="delProduct">
					<i class="material-icons">delete</i>
				</a>
				<!-- MODIFIED BUTTON -->
				<a href="<?= WEBROOT ?>product/modify/<?= $datas['id'] ?>" class="btn-floating btn-large waves-effect waves-light right orange">
					<i class="material-icons">mode_edit</i>
				</a>
			</div>
		</div>
	</div>
</div>

<script>
	$(function ()
	{
		var WEBROOT = '<?= str_replace('index.php', '', $_SERVER['SCRIPT_NAME']); ?>';

		$('#delProduct').click(function ()
		{
			$.ajax({
				type: 'POST',
				url: WEBROOT + 'product/del/<?= $datas['id'] ?>',
			}).done(function (result)
			{
				$('#result').html(result);
			});
		});
	});
</script>