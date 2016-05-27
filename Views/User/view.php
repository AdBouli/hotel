<div class="row" id="result">
	
</div>
<div class="row">
	<div class="col s10 offset-s1">
		<h5 class="center-align">Détail de l'utilisateur</h5>
		<div class="row">
			<div class="col s6">
				<ul class="collection with-header">
					<!-- USERNAME -->
					<li class="collection-header"><h5><?= $datas['username'] ?></h5></li>
					<!-- RIGHT -->
					<li class="collection-item">Droit<div class="right"><?= $datas['right'] ?></div></li>
				</ul>
				<a href="<?= WEBROOT ?>log/user/<?= $datas['id'] ?>">Consulter son historique</a>
				<!-- DELETED BUTTON -->
				<a class="btn-floating btn-large waves-effect waves-light right red" id="delUser">
					<i class="material-icons">delete</i>
				</a>
				<!-- MODIFIED BUTTON -->
				<a href="<?= WEBROOT ?>user/modify/<?= $datas['id'] ?>" class="btn-floating btn-large waves-effect waves-light right orange">
					<i class="material-icons">mode_edit</i>
				</a>
			</div>
			<div class="col s6">
				<div class="row">
					<button class="btn waves-effect waves-light left" id="modifyPassword">
						Modifier mot de passe<i class="material-icons right">lock</i>
					</button>
				</div>
				<div class="row hide" id="divChangePassword">
					<div class="col s6">
						<div class="input-field col s12">
							<input type="password" name="password1" placeholder="Nouveau mot de passe">
						</div>
						<div class="input-field col s12">
							<input type="password" name="password2" placeholder="Confirmez">
						</div>
					</div>
					<div class="col s6">
						<div class="input-field col s12">
							<button class="btn waves-effect waves-light left" id="upPassword">
								<i class="material-icons right">send</i>
							</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	$(function ()
	{
		var WEBROOT = '<?= str_replace('index.php', '', $_SERVER['SCRIPT_NAME']); ?>';

		$('#delUser').click(function ()
		{
			$.ajax({
				type: 'POST',
				url: WEBROOT + 'user/del/<?= $datas['id'] ?>',
			}).done(function (result)
			{
				$('#result').html(result);
			});
		});

		$('#modifyPassword').click(function ()
		{
			var div = $('#divChangePassword');
			if (div.hasClass('hide'))
			{
				div.removeClass('hide');
			} else
			{
				div.addClass('hide');
			}
		});

		$('#upPassword').click(function ()
		{
			var POST = {
				password: $('input[name=password1]').val(),
				confirm:  $('input[name=password2]').val()
			};
			$.ajax({
				type: 'POST',
				url: WEBROOT + 'user/upPassword/<?= $datas['id'] ?>',
				data: POST
			}).done(function (result)
			{
				$('#result').html(result);
				$('#divChangePassword').addClass('hide');
			});
			console.log('ok');
		});
	});
</script>