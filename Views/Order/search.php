<table class="striped">
  <thead>
    <tr>
      <th data-field="created">Créé le</th>
      <th data-field="created">Compte</th>
      <th data-field="lines">Nombre de lignes</th>
      <th data-field="products">Nombre de produit</th>
      <th data-field="total">Total</th>
      <th data-field="num">Payée</th>
    </tr>
  </thead>

  <tbody>
  <?php foreach ($results as $result) : ?>
    <tr>
      <td><?= $result['created'] ?></td>
      <td><?= $result['firstname'].' '.$result['name'] ?></td>
      <td><?= $result['lines'] ?></td>
      <td><?= $result['products'] ?></td>
      <td><?= $result['total'] ?>€</td>
      <td><?= ($result['paid']) ? 'Oui' : 'Non' ?></td>
      <td>
        <a href="<?= WEBROOT ?>order/view/<?= $result['id'] ?>" class="btn-floating btn-medium waves-effect waves-light green">
          <i class="material-icons">send</i>
        </a>
      </td>
    </tr>
  <?php endforeach; ?>
  </tbody>
</table>