<div class="row" id="result">
	
</div>
<div class="row">
	<div class="col s10 offset-s1">
		<div class="row">
			<h5>Edition d'une commande</h5>
		</div>
		<div class="row">
			<div class="col s12">
				<table class="centered">
					<thead>
						<tr>
							<th>N° commande</th>
							<th>N° reservation</th>
							<th>N° chambre</th>
							<th>Compte</th>
							<th>Total reservation</th>
							<th>Total commande</th>
						</tr>
					</thead>

					<tbody>
						<tr>
							<td><?= $datas['id'] ?></td>
							<td><?= $reservation['id'] ?></td>
							<td><?= $room['num'] ?></td>
							<td><?= $account['firstName'].' '.$account['name'] ?></td>
							<td><?= $reservation['total'] ?></td>
							<td id="tdTotalOrder"><?= $datas['total'] ?></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
		<div class="row">
			<div class="col s12">
				<table class="striped">
					<thead>
						<tr>
							<th>Produit</th>
							<th>Prix</th>
							<th>Quantité</th>
							<th>Montant</th>
						</tr>
					</thead>
					<tbody id="resumeOrder">
					</tbody>
				</table>
			</div>
			<p id="resultAddLine"></p>
		</div>
		<div class="row" id="createLine">
			<div class="input-field col s4">
				<label for="searchProduct">Rechercher dans les produits :</label>
				<input type="text" name="searchProduct" id="inputProduct">
			</div>
			<div class="input-field col s6" id="selectProduct">

			</div>
			<div class="input-field col s2">
				<label for="quantity">Quantité :</label>
				<input type="number" min="1" name="quantity" value="1">
			</div>
			<div class="input-field col s12">
				<button class="btn waves-effect waves-light right" id="addLine">
					Ajouter
				</button>
			</div>
		</div>
		<div class="input-field col s12">
			<p class="right">
				<input type="checkbox" name="paid" id="paid"/>
				<label for="paid">Payée</label>
			</p>
		</div>
		<div class="col s12">
			<button class="btn waves-effect waves-light left red" id="delOrder">
				Supprimer<i class="material-icons right">delete</i>
			</button>
			<button class="btn waves-effect waves-light right" id="upOrder">
				Enregistrer<i class="material-icons right">send</i>
			</button>
		</div>
	</div>
</div>

<script>
	$(function() {

		$('select').material_select();

		var WEBROOT = '<?= str_replace('index.php', '', $_SERVER['SCRIPT_NAME']); ?>';

		$('#inputProduct').change(function ()
		{
			var POST = {
				name: $('input[name=searchProduct]').val()
			};
			$.ajax({
				type: 'POST',
				url:  WEBROOT + 'product/select_product',
				data: POST
			}).done(function (result)
			{
				$('#selectProduct').html(result);
			});
		});

		$('#addLine').click(function ()
		{
			var POST = {
				order_id:   '<?= $datas['id'] ?>',
				product_id: $('select[name=product]').select().val(),
				quantity:   $('input[name=quantity]').val()
			};
			$.ajax({
				type: 'POST',
				url:  WEBROOT + 'productorder/add',
				data: POST
			}).done(function (result)
			{
				if (result == 'add' || result == 'up')
				{
					if (result == 'add')
					{
						$('#resultAddLine').html('Ajout réussi');
					} else
					{
						$('#resultAddLine').html('Modification réussie');
					}
					upResumeOrder();
					upTotalOrder();
				} else
				{
					$('#resultAddLine').html('Echec de l\'ajout');
				}
			});
		});

		function upResumeOrder()
		{
			$.ajax({
				url: WEBROOT + 'order/up_resume/<?= $datas['id'] ?>'
			}).done(function (result) {
				$('#resumeOrder').html(result);
			});
		}

		function upTotalOrder()
		{
			$.ajax({
				url: WEBROOT + 'order/get_total/<?= $datas['id'] ?>'
			}).done(function (result) {
				$('#tdTotalOrder').html(result);
			});
		}

		$('#upOrder').click(function ()
		{
			var POST = {
				paid: $('input[name=paid]').prop('checked')
			};
			$.ajax({
				type: 'POST',
				url:  WEBROOT + 'order/up/<?= $datas['id'] ?>',
				data: POST
			}).done(function (result)
			{
				if (result == 'paid')
				{
					$(location).attr('href', WEBROOT+'order');
				} else
				{
					$('#result').html(result);					
				}
			})
		});

		$('#delOrder').click(function ()
		{
			$.ajax({
				url:  WEBROOT + 'order/del/<?= $datas['id'] ?>',
			}).done(function (result)
			{
				$('#result').html(result);
			})
		});

		upResumeOrder();

		$.ajax({
			url: WEBROOT + 'product/select_product'
		}).done(function (result)
		{
			$('#selectProduct').html(result);
		});

	});
</script>