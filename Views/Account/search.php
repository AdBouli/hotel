<table class="striped">
  <thead>
    <tr>
      <th data-field="name">Nom</th>
      <th data-field="firstname">Prénom</th>
      <th data-field="address">Adresse</th>
      <th data-field="phone">Num. téléphone</th>
      <th data-field="mail">Adresse e-mail</th>
    </tr>
  </thead>

  <tbody>
  <?php foreach ($results as $result) : ?>
    <tr>
      <td><?= $result['name'] ?></td>
      <td><?= $result['firstName'] ?></td>
      <td><?= $result['address'] ?></td>
      <td><?= $result['phone'] ?></td>
      <td><?= $result['mail'] ?></td>
      <td>
        <a href="<?= WEBROOT ?>account/view/<?= $result['id'] ?>" class="btn-floating btn-medium waves-effect waves-light green">
          <i class="material-icons">send</i>
        </a>
      </td>
    </tr>
  <?php endforeach; ?>
  </tbody>
</table>