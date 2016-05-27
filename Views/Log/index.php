<div class="row">
	<div class="col s10 offset-s1">
		<div class="row">
			<div class="col s12">
				<h5>Recherche dans l'historique :</h5>
			</div>
		</div>
		<div class="row">
			<!-- LOG SELECT -->
			<div class="input-field col s3">
				<select name="log">
					<option value="" disabled>Choix</option>
					<option value="reservations">les réservations</option>
					<option value="orders">les commandes</option>
				</select>
				<label for="log">Rechercher dans :</label>
			</div>
			<!-- ACCOUNT SEARCH -->
			<div class="input-field col s4">
				<label for="searchAccount">Recherche dans les comptes</label>
				<input type="text" name="searchAccount">
			</div>
			<!-- ACCOUNT SELECT -->
			<div class="input-field col s5" id="selectAccount">
			</div>
			<!-- TYPE SELECT -->
			<div class="input-field col s3">
				<select name="type">
					<option value="">Choisir un type</option>
					<?php foreach ($types as $type) : ?>
						<option value="<?= $type['id'] ?>"><?= $type['name'] ?></option>
					<?php endforeach; ?>
				</select>
				<label for="type">Recherche par type de chambre :</label>
			</div>
			<!-- PERSON INPUT -->
			<div class="input-field col s2">
				<input type="number" name="person">
				<label for="person">Personne :</label>				
			</div>
			<!-- FLOOR INPUT -->
			<div class="input-field col s2">
				<input type="number" name="floor">
				<label for="floor">Etage :</label>
			</div>
			<!-- ROOM SELECT -->
			<div class="input-field col s5" id="selectRoom">
				
			</div>
			<!-- DATE INPUT 1 -->
			<div class="input-field col s3">
				<label for="date">Date de début :</label>
				<input type="text" id="datepicker1" name="date1">
			</div>
			<!-- DATE INPUT 2 -->
			<div class="input-field col s3">
				<label for="date">Date de fin :</label>
				<input type="text" id="datepicker2" name="date2">
			</div>
			<!-- ACTION SELECT -->
			<div class="input-field col s4 offset-s2">
				<select name="action">
					<option value="0">Aucune</option>
					<option value="INSERT">Ajouts</option>
					<option value="UPDATE">Modifications</option>
					<option value="DELETE">Suppressions</option>
				</select>
				<label for="action">Filtrer par action :</label>
			</div>
			<!-- USER SEARCH -->
			<div class="input-field col s4">
				<label for="searchUser">Recherche dans les utilisateurs :</label>
				<input type="text" name="searchUser">
			</div>
			<!-- USER SELECT -->
			<div class="input-field col s3" id="selectUser">
				
			</div>
			<!-- SUBMIT BUTTON -->
			<div class="col s5">
				<button class="btn waves-effect waves-light right" id="updateResult">
					Rechercher<i class="material-icons right">search</i>
				</button>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col s12" id="results">
		
	</div>
</div>

<script>
	$(function()
	{
		$( "#datepicker1" ).datepicker({
			dateFormat: "yy-mm-dd",
			defaultDate: "#actualDate"
		});

		$( "#datepicker2" ).datepicker({
			dateFormat: "yy-mm-dd",
			defaultDate: "#actualDate"
		});

		$('select').material_select();

		var WEBROOT = '<?= str_replace('index.php', '', $_SERVER['SCRIPT_NAME']); ?>';

		$('#updateResult').click(function ()
		{
			var log = $('select[name=log]').select().val();
			if (log == 'reservations')
			{
				var POST = {};
			}
			if (log == 'orders')
			{
				var POST = {};
			}
			$.ajax({
				type: 'POST',
				url: WEBROOT + 'log/search/' + log,
				data: POST
			}).done(function (result)
			{
				$('#results').html(result);
			});
		});

		$('input[name=searchAccount]').change(function ()
		{
			var POST = {
				names: $('input[name=searchAccount]').val()
			};
			$.ajax({
				type: 'POST',
				url:  WEBROOT + 'account/select_account',
				data: POST
			}).done(function (result)
			{
				$('#selectAccount').html(result);
			});
		});

		$('select[name=type]').change(function ()
		{
			upRoom();
		});

		$('input[name=person]').change(function ()
		{
			upRoom();
		});

		$('input[name=floor]').change(function ()
		{
			upRoom();
		});


		function upRoom()
		{
			var POST = {
				'type':   $('select[name=type]').select().val(),
				'person': $('input[name=person]').val(),
				'floor':  $('input[name=floor]').val()
			}
			$.ajax({
				type: 'POST',
				url: WEBROOT + 'room/select_room',
				data: POST
			}).done(function (result)
			{
				$('#selectRoom').html(result);
			});
		}

		$('input[name=searchUser]').change(function ()
		{
			var POST = {
				username: $('input[name=searchUser]').val()
			};
			$.ajax({
				type: 'POST',
				url:  WEBROOT + 'user/select_user',
				data: POST
			}).done(function (result)
			{
				$('#selectUser').html(result);
			});
		});

		$.ajax({
			url: WEBROOT + 'account/select_account'
		}).done(function (result)
		{
			$('#selectAccount').html(result);
		});

		$.ajax({
			url: WEBROOT + 'room/select_room'
		}).done(function (result)
		{
			$('#selectRoom').html(result);
		});

		$.ajax({
			url: WEBROOT + 'user/select_user'
		}).done(function (result)
		{
			$('#selectUser').html(result);
		});

	});
</script>