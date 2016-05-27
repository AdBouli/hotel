<div class="row" id="result">
	
</div>
<div class="row">
	<div class="col s10 push-s1">
		<div class="row">
			<h5>Création d'une réservation</h5>
		</div>
		<div class="row">
			<!-- ACCOUNT START -->
			<div class="col s6">
				<div class="row">
					<!-- Switch -->
					<div class="col s12 switch">
						<label>
							Selectionner un compte existant <input type="checkbox" id="accountSwitch" name="createAccount" checked> <span class="lever"></span> Créer un nouveau compte
						</label>
					</div>
					<!-- SELECT ACCOUNT -->
					<div class="col s12" id="selectAccount">
						<div class="row">
							<div class="input-field col s12">
								<label for="names">Rechercher un compte</label>
								<input type="text" name="names" placeholder="Nom, prénom...">
							</div>
							<div class="input-field col s12" id="divSelectAccount">
								<select name="account">
									<option value="" disabled selected>Choisir un compte</option>
									<?php foreach ($accounts as $key => $value) : ?>
										<option value="<?= $value['id'] ?>"> <?= $value['firstName'].' '.$value['name'].' - '.$value['address']  ?> </option>
									<?php endforeach; ?>
								</select>
							 	<label for="account_id">Compte :</label>
							</div>
						</div>
					</div>
					<!-- CREATE ACCOUNT -->
					<div class="col s12 hide" id="createAccount">
						<div class="row">
							<!-- NAME INPUT -->
							<div class="input-field col s6">
								<label for="name">Nom :</label>
								<input type="text" name="name">
							</div>
							<!-- FISRTNAME INPUT -->
							<div class="input-field col s6">
								<label for="firstName">Prénom :</label>
								<input type="text" name="firstName">
							</div>
							<!-- ADDRESS INPUT -->
							<div class="input-field col s12">
								<label for="address">Adresse :</label>
								<input type="text" name="address">
							</div>
							<!-- PHONE INPUT -->
							<div class="input-field col s6">
								<label for="phone">Numéro de téléphone :</label>
								<input type="text" name="address">
							</div>
							<!-- MAIL INPUT -->
							<div class="input-field col s6">
								<label for="mail">Adresse e-mail :</label>
								<input type="email" name="mail">
							</div>
							<!-- ADD ACCOUNT BUTTON -->
							<div class="input-field col s12">
								<button class="btn waves-effect waves-light right" id="addAccount">
									Créer compte<i class="material-icons right">send</i>
								</button>						
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- ACCOUNT END -->

			<!-- RESERVATION START -->
			<div class="col s6">
				<div class="row">
					<!-- DATE INPUT -->
					<div class="input-field col s6">
						<label for="date1">Date de début :</label>
						<input type="text" id="datepicker1" name="date1" value="<?= date('Y-m-d') ?>">
					</div>
					<!-- DATE INPUT -->
					<div class="input-field col s6">
						<label for="date2">Date de fin :</label>
						<input type="text" id="datepicker2" name="date2" value="<?= date('Y-m-d') ?>">
					</div>
					<!-- TYPE SELECT -->
					<div class="input-field col s6">
						<select name="type" id="selectType">
							<option value="0">Choisir type de chambre</option>
						<?php foreach ($types as $type) : ?>
							<option value="<?= $type['id'] ?>"><?= $type['name'] ?></option>
						<?php endforeach; ?>
						</select>
						<label for="type">Type de chambre :</label>
					</div>
					<!-- PERSON INPUT -->
					<div class="input-field col s6">
						<label for="person">Personnes :</label>
						<input type="number" name="person" id="inputPerson">
					</div>
					<!-- ROOM SELECT -->
					<div class="input-field col s12" id="divSelectFreeRoom">
						
					</div>
					<div class="input-field col s12">
						<button class="btn waves-effect waves-light right" id="addReservation">
							Valider<i class="material-icons right">send</i>
						</button>						
					</div>
				</div>
			</div>
			<!-- RESERVATION END -->
		</div>
	</div>
</div>

<script>
	$(function()
	{
		// If refresh with checkbox checked
		var Switch = $('#accountSwitch');
		Switch.prop('checked', false);
		
		// ACCOUNT DIVS
		Switch.change(function()
		{
			switchFormAccount();
		});

		function switchFormAccount()
		{
			var divSelect = $('#selectAccount');
			var divCreate = $('#createAccount');
			if (divCreate.hasClass('hide'))
			{
				divCreate.removeClass('hide');
				divSelect.addClass('hide');
			} else
			{
				divSelect.removeClass('hide');
				divCreate.addClass('hide');
			}
		}

		// DATEPICKER
		$('#datepicker1').datepicker({
			dateFormat: "yy-mm-dd",
			defaultDate: "#actualDate"
		});

		$('#datepicker2').datepicker({
			dateFormat: "yy-mm-dd",
			defaultDate: "#actualDate"
		});

		// SELECT
		$('select').material_select();

		// SEARCH FREE ROOMS
		$('#datepicker1').change(function()
		{
			searchRoom();
		});
		$('#datepicker2').change(function()
		{
			searchRoom();
		});
		$('#selectType').change(function()
		{
			searchRoom();
		});
		$('#inputPerson').change(function()
		{
			searchRoom();
		});
		
		var WEBROOT = '<?= str_replace('index.php', '', $_SERVER['SCRIPT_NAME']); ?>';

		function searchRoom()
		{
			var POST = {
				date1:  $('input[name=date1]').val(),
				date2:  $('input[name=date2]').val(),
				type:   $('select[name=type]').select().val(),
				person: $('input[name=person]').val()
			}
			$.ajax({
				type: "POST",
				url:  WEBROOT + "room/select_free_room",
				data: POST
			}).done(function (result)
			{
				$('#divSelectFreeRoom').html(result);
			});
		};

		// UP ACCOUNT LIST
		$('input[name=names]').change(function ()
		{
			var POST = {
				names: $('input[name=names]').val()
			};
			$.ajax({
				type: 'POST',
				url: WEBROOT + 'account/select_account',
				data: POST
			}).done(function (result)
			{
				$('#divSelectAccount').html(result);
			});
		});

		// ADD ACCOUNT
		$('#addAccount').click(function ()
		{
			var POST= {
				name:       $('input[name=name]').val(),
				firstName:  $('input[name=firstName]').val(),
				address:    $('input[name=address]').val(),
				phone:      $('input[name=phone]').val(),
				mail:       $('input[name=mail]').val()
			};
			$.ajax({
				type: 'POST',
				url:  WEBROOT + 'account/add',
				data: POST
			}).done(function (result) {
				$('#result').html(result);
			});
			Switch.prop('checked', false);
			switchFormAccount();
			$.ajax({
				type: 'POST',
				url:  WEBROOT + 'account/select_account'
			}).done(function (result) {
				$('#divSelectAccount').html(result);
			})
		});

		// ADD RESERVATION
		$('#addReservation').click(function ()
		{
			var POST = {
				account_id: $('select[name=account]').select().val(),
				dateStart:  $('input[name=date1]').val(),
				dateEnd:    $('input[name=date2]').val(),
				room_id:    $('select[name=room]').select().val()
			};
			$.ajax({
				type: 'POST',
				url:  WEBROOT + 'reservation/add',
				data: POST
			}).done(function (result)
			{
				$('#result').html(result);
			});
		});

		searchRoom();
		
	});
</script>