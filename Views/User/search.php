<table class="striped">
  <thead>
    <tr>
      <th data-field="username">Utilisateur</th>
      <th data-field="username">Droit</th>
    </tr>
  </thead>

  <tbody>
  <?php foreach ($results as $result) : ?>
    <tr>
      <td><?= $result['username'] ?></td>
      <td><?= $result['right'] ?></td>
      <td>
        <a href="<?= WEBROOT ?>user/view/<?= $result['id'] ?>" class="btn-floating btn-medium waves-effect waves-light green">
          <i class="material-icons">send</i>
        </a>
      </td>
    </tr>
  <?php endforeach; ?>
  </tbody>
</table>