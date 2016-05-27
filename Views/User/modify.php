<div class="row" id="result">
	
</div>
<div class="row">
	<div class="col s10 offset-s1">
		<div class="row">
			<h5>Modification d'un utilisateur :</h5>
		</div>
		<div class="row">
			<!-- USERNAME INPUT -->
			<div class="input-field col s6">
				<label for="username">Nom d'utilisateur :</label>
				<input type="text" name="username" value="<?= $datas['username'] ?>" required>
			</div>
			<div class="input-field col s3">
				<?php $rights = ['all' => 'Tous', 'hotel' => 'Hotel', 'bar' => 'Bar']; ?>
				<select name="right">
					<option value="">Choix</option>
					<?php foreach ($rights as $key => $value) : ?>
						<?php if ($key == $datas['right']) : ?>
						<option value="<?= $key ?>" selected><?= $value ?></option>
						<?php else : ?>
						<option value="<?= $key ?>"><?= $value ?></option>
						<?php endif; ?>
					<?php endforeach; ?>
				</select>
				<label for="right">Right :</label>
			</div>
			<!-- SUBMIT BUTTON -->
			<div class="col s3">
				<button class="btn waves-effect waves-light right" id="upUser">
					Enregistrer<i class="material-icons right">send</i>
				</button>
			</div>
		</div>
	</div>
</div>

<script>
	$(function ()
	{
		$('select').material_select();

		var WEBROOT = '<?= str_replace('index.php', '', $_SERVER['SCRIPT_NAME']); ?>';

		$('#upUser').click(function ()
		{
			var POST = {
				username: $('input[name=username]').val(),
				right:    $('select[name=right]').select().val()
			};
			$.ajax({
				type: 'POST',
				url:  WEBROOT + 'user/up/<?= $datas['id'] ?>',
				data: POST
			}).done(function (result)
			{
				$('#result').html(result);
			});
		});
	});
</script>