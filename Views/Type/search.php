<table class="striped">
  <thead>
    <tr>
      <th data-field="name">Nom</th>
    </tr>
  </thead>

  <tbody>
  <?php foreach ($results as $result) : ?>
    <tr>
      <td><?= $result['name'] ?></td>
      <td>
        <a href="<?= WEBROOT ?>type/view/<?= $result['id'] ?>" class="btn-floating btn-medium waves-effect waves-light green">
          <i class="material-icons">send</i>
        </a>
      </td>
    </tr>
  <?php endforeach; ?>
  </tbody>
</table>