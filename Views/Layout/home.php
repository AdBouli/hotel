<!DOCTYPE html>
<html>
	<head>
		<?php include VIEW.'Layout/Includes/Header.php'; ?>
	</head>

	<body>
		<div class="container">

			<!-- NAVBAR START -->
			<div class="section">
				  <nav>
				    <div class="nav-wrapper">
				      <a href="#" class="brand-logo center">Hotel Manager</a>
				    </div>
				  </nav>
			</div>
			<!-- NAVBAR END -->

			<div class="divider"></div>

			<!-- CONTENT START -->
			<div class="section">
				<?= $content_for_layout ?>
			</div>
			<!-- CONTENT END -->

			<div class="divider"></div>

			<!-- FOOTER START -->
			<div class="section">
				<?php include VIEW.'Layout/Includes/Footer.php'; ?>
			</div>
			<!-- FOOTER END -->

		</div>
	</body>
</html>
