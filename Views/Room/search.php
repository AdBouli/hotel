<table class="striped">
  <thead>
    <tr>
      <th data-field="num">Number</th>
      <th data-field="person">Person</th>
      <th data-field="floor">Floor</th>
      <th data-field="type">Type</th>
    </tr>
  </thead>

  <tbody>
  <?php foreach ($results as $result) : ?>
    <tr>
      <td><?= $result['num'] ?></td>
      <td><?= $result['person'] ?></td>
      <td><?= $result['floor'] ?></td>
      <td><?= $result['name'] ?></td>
      <td>
        <a href="<?= WEBROOT ?>room/view/<?= $result['id'] ?>" class="btn-floating btn-medium waves-effect waves-light green">
          <i class="material-icons">send</i>
        </a>
      </td>
    </tr>
  <?php endforeach; ?>
  </tbody>
</table>