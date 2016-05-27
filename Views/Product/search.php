<table class="striped">
  <thead>
    <tr>
      <th data-field="name">Nom</th>
      <th data-field="price">Prix</th>
    </tr>
  </thead>

  <tbody>
  <?php foreach ($results as $result) : ?>
    <tr>
      <td><?= $result['name'] ?></td>
      <td><?= $result['price'] ?>€</td>
      <td>
        <a href="<?= WEBROOT ?>product/view/<?= $result['id'] ?>" class="btn-floating btn-medium waves-effect waves-light green">
          <i class="material-icons">send</i>
        </a>
      </td>
    </tr>
  <?php endforeach; ?>
  </tbody>
</table>
