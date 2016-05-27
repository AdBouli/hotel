<table class="striped">
  <thead>
    <tr>
      <th data-field="date">Num.</th>
      <th data-field="date">Du</th>
      <th data-field="days">Au</th>
      <th data-field="date">Compte</th>
      <th data-field="num">Chambre</th>
      <th data-field="floor">Etage</th>
      <th data-field="type">Type de chambre</th>
      <th data-field="total">Total</th>
      <th data-field="rest">Payé</th>
    </tr>
  </thead>

  <tbody>
  <?php foreach ($results as $result) : ?>
    <tr>
      <td><?= $result['id'] ?></td>
      <td><?= $result['dateStart'] ?></td>
      <td><?= $result['dateEnd'] ?></td>
      <td><?= $result['firstname'] ?> <?= $result['name'] ?></td>
      <td><?= $result['num'] ?></td>
      <td><?= $result['floor'] ?></td>
      <td><?= $result['type'] ?></td>
      <td><?= $result['total'] ?></td>
      <td><?= $result['paid'] ?></td>
      <td>
        <a href="<?= WEBROOT ?>order/create/<?= $result['id'] ?>" class="btn-floating btn-medium waves-effect waves-light red">
          <i class="material-icons">add</i>
        </a>
      </td>
    </tr>
  <?php endforeach; ?>
  </tbody>
</table>