<div class="row" id="result">
	
</div>
<div class="row">
	<div class="col s10 offset-s1">
		<h4 class="center-align">Détail de la réservation</h4>
		<div class="row">
			<div class="col s6">
				<div class="row">
					<div class="col s12">
						<ul class="collection with-header">
							<!-- NUM -->
							<li class="collection-header"><h5>Numéro <?= $datas['id'] ?></h5></li>
							<!-- DATES -->
							<li class="collection-item">Dates :<div class="right">du <?= $datas['dateStart'].' au '.$datas['dateEnd'] ?></div></li>
							<!-- ACCOUNT -->
							<li class="collection-item">Compte :<div class="right">
								<a href="<?= WEBROOT ?>account/view/<?= $account['id'] ?>">
									<?= $account['firstName'].' '.$account['name'] ?>
								</a>
							 </div></li>
							<!-- ROOM -->
							<li class="collection-item">Chambre :<div class="right">
								<a href="<?= WEBROOT ?>room/view/<?= $room['id'] ?>">
									Numéro <?= $room['num'] ?>
								</a>
							</div></li>
							<!-- TOTAL -->
							<li class="collection-item">Total :<div class="right"><?= $datas['total'] ?></div></li>
							<!-- PAID -->
							<li class="collection-item">Payée :<div class="right"><?= $datas['paid'] ?></div></li>
							<!-- REST -->
							<li class="collection-item">Reste :<div class="right"><?= round(floatval($datas['total'])-floatval($datas['paid']), 2) ?></div></li>
							<!-- CREATED -->
							<li class="collection-item">Créé le :<div class="right"><?= $datas['created'] ?></div></li>
							<!-- MODIFIED -->
							<li class="collection-item">Modifié le :<div class="right"><?= $datas['modified'] ?></div></li>
						</ul>
					</div>
					<div class="col s9">
						<a href="<?= WEBROOT ?>log/reservation/<?= $datas['id'] ?>">Consulter son historique</a>
					</div>
					<div class="col s3">
						<!-- DELETED BUTTON -->
						<a class="btn-floating btn-large waves-effect waves-light right red" id="delReservation">
							<i class="material-icons">delete</i>
						</a>
					</div>
					<!-- MODIFY PAID -->
					<div class="row">
						<div class="col s12">
							<button class="btn waves-effect waves-light left" id="btnModifyPaid">
								Mettre à jour le paiement<i class="material-icons right">euro_symbol</i>
							</button>
						</div>
						<div class="col s12 hide" id="divModifyPaid">
							<div class="input-field col s4">
								<input type="number" step="0.01" max="<?= $datas['total'] ?>" name="paid" value="<?= $datas['paid'] ?>">
								<label for="paid">Payé :</label>
							</div>
							<div class="input-field col s4">
								<input type="number" step="0.01" name="total" value="<?= $datas['total'] ?>" disabled>
								<label for="total">Total :</label>
							</div>
							<div class="input-field col s4">
								<button class="btn waves-effect waves-light right" id="upPaid">
									<i class="material-icons right">send</i>
								</button>
							</div>
						</div>
					</div>
					<!-- MODIFY DATES -->
					<div class="row">
						<div class="col s12">
							<button class="btn waves-effect waves-light left" id="btnModifyDates">
								Modifier les dates<i class="material-icons right">date_range</i>
							</button>
						</div>
						<div class="col s12 hide" id="divModifyDates">
							<div class="input-field col s4">
								<label for="date1">Date de début :</label>
								<input type="text" id="datepicker1" name="date1" value="<?= $datas['dateStart'] ?>">
							</div>
							<div class="input-field col s4">
								<label for="date2">Date de fin :</label>
								<input type="text" id="datepicker2" name="date2" value="<?= $datas['dateEnd'] ?>">
							</div>
							<div class="input-field col s4">
								<button class="btn waves-effect waves-light right" id="upDates">
									<i class="material-icons right">send</i>
								</button>						
							</div>
						</div>
					</div>
					<!-- MODIFY ROOM -->
					<div class="row">
						<div class="col s12">
							<button class="btn waves-effect waves-light left" id="btnModifyRoom">
								Changer la chambre<i class="material-icons right">hotel</i>
							</button>
						</div>
						<div class="col s12 hide" id="divModifyRoom">
							<div class="input-field col s7">
								<select name="type" id="selectType">
									<option value="0">Choisir type de chambre</option>
								<?php foreach ($types as $type) : ?>
									<option value="<?= $type['id'] ?>"><?= $type['name'] ?></option>
								<?php endforeach; ?>
								</select>
								<label for="type">Type de chambre :</label>
							</div>
							<div class="input-field col s5">
								<label for="person">Personnes :</label>
								<input type="number" name="person" id="inputPerson">
							</div>
							<div class="input-field col s9" id="divSelectFreeRoom">
								
							</div>
							<div class="input-field col s3">
								<button class="btn waves-effect waves-light right" id="upRoom">
									<i class="material-icons right">send</i>
								</button>						
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col s6">
				<div class="row">
					<div class="col s6">
						<h5>Commandes :</h5>						
					</div>
					<div class="col s6">
						<!-- ADD ORDER -->
						<a href="<?= WEBROOT ?>order/create/<?= $datas['id'] ?>" class="btn-floating btn-large waves-effect waves-light right red">
							<i class="material-icons">add</i>
						</a>
					</div>
				</div>
				<table class="striped">
					<thead>
						<th data-field="num">Num.</th>
						<th data-field="total">Total</th>
						<th data-field="paid">Payée</th>
					</thead>
					<tbody>
						<?php foreach ($orders as $order) : ?>
						<tr>
							<td><?= $order['id'] ?></td>
							<td><?= $order['total'] ?></td>
							<td><?= $order['paid'] ?></td>
							<td>
								<a href="<?= WEBROOT ?>order/view/<?= $order['id'] ?>" class="btn-floating btn-small waves-effect waves-light green">
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
		// DATEPICKER
		$('#datepicker1').datepicker({
			dateFormat: "yy-mm-dd",
			defaultDate: "#actualDate"
		});

		$('#datepicker2').datepicker({
			dateFormat: "yy-mm-dd",
			defaultDate: "#actualDate"
		});

		$('select').material_select();

		var WEBROOT = '<?= str_replace('index.php', '', $_SERVER['SCRIPT_NAME']); ?>';

		$('#delReservation').click(function ()
		{
			$.ajax({
				type: 'POST',
				url: WEBROOT + 'reservation/del/<?= $datas['id'] ?>',
			}).done(function (result)
			{
				$('#result').html(result);
			});
		});

		$('#btnModifyPaid').click(function ()
		{
			showHideDivs('divModifyPaid');
		});

		$('#btnModifyDates').click(function ()
		{
			showHideDivs('divModifyDates');
		});

		$('#btnModifyRoom').click(function ()
		{
			showHideDivs('divModifyRoom');
			searchRoom();
		});

		function showHideDivs(id)
		{
			var div_ids = ['divModifyPaid', 'divModifyDates', 'divModifyRoom'];
			var div = $('#'+id);
			if (div.hasClass('hide'))
			{
				div.removeClass('hide');
				for(i in div_ids)
				{
					var tmp_div = $('#'+div_ids[i]);
					if (div_ids[i] != id && !tmp_div.hasClass('hide'))
					{
						tmp_div.addClass('hide');
					}
				}
			} else
			{
				div.addClass('hide');
			}
		}

		$('selectType').click(function ()
		{
			searchRoom();
		});

		$('inputPerson').click(function ()
		{
			searchRoom();
		});

		function searchRoom()
		{
			var POST = {
				date1:  '<?= $datas['dateStart'] ?>',
				date2:  '<?= $datas['dateEnd'] ?>',
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

		function hideDiv(id)
		{
			var div = $('#'+id);
			if (!div.hasClass('hide'))
			{
				div.addClass('hide');
			}
		}



		//
		// UP 
		//

		$('#upPaid').click(function ()
		{
			var POST = {
				paid: $('input[name=paid]').val()
			};
			$.ajax({
				type: "POST",
				url:  WEBROOT + 'reservation/up/paid/<?= $datas['id'] ?>',
				data: POST
			}).done(function (result)
			{
				$('#result').html(result);
			});
			location.reload();
		});

		$('#upDates').click(function ()
		{
			var POST = {
				dateStart: $('input[name=date1]').val(),
				dateEnd:   $('input[name=date2]').val()
			};
			$.ajax({
				type: "POST",
				url:  WEBROOT + 'reservation/up/dates/<?= $datas['id'] ?>',
				data: POST
			}).done(function (result)
			{
				$('#result').html(result);
			});
			location.reload();
		});

		$('#upRoom').click(function ()
		{
			var POST = {
				'room_id': $('select[name=room]').select().val()
			};
			$.ajax({
				type: "POST",
				url:  WEBROOT + 'reservation/up/room/<?= $datas['id'] ?>',
				data: POST
			}).done(function (result)
			{
				$('#result').html(result);
			});
			location.reload();
		});

		//

	});
</script>