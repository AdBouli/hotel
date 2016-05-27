<ul id="admin-dropdown" class="dropdown-content">
	<li><a href="<?= WEBROOT ?>account">Comptes<i class="material-icons right">face</i></a></li>
	<li><a href="<?= WEBROOT ?>product">Produits<i class="material-icons right">local_bar</i></a></li>
	<li><a href="<?= WEBROOT ?>room">Chambres<i class="material-icons right">hotel</i></a></li>
	<li><a href="<?= WEBROOT ?>type">Types<i class="material-icons right">hotel</i></a></li>
	<li><a href="<?= WEBROOT ?>user">Utilisateurs<i class="material-icons right">face</i></a></li>
</ul>
<nav>
    <div class="nav-wrapper">
		<ul id="nav-mobile" class="left hide-on-med-and-down">
			<li><a href="<?= WEBROOT ?>reservation">Réservations<i class="material-icons right">hotel</i></a></li>
			<li><a href="<?= WEBROOT ?>order">Commmandes<i class="material-icons right">assignment</i></a></li>
		</ul>
		<ul id="nav-mobile" class="right hide-on-med-and-down">
			<li><a class="dropdown-button" id="admin-menu" data-activates="admin-dropdown">Administration<i class="material-icons right">arrow_drop_down</i></a></li>
			<li><a id="btn-logout">Déconnexion (<?= $_SESSION['name'] ?>)<i class="material-icons right">exit_to_app</i></a></li>
		</ul>
	</div>
</nav>

<script>
	$(function()
	{

		$(".dropdown-button").dropdown();

		// LOGOUT
		$('#btn-logout').click(function()
		{
			var WEBROOT = '<?= str_replace('index.php', '', $_SERVER['SCRIPT_NAME']); ?>';
			$.ajax({
				url: WEBROOT + "user/logout"
			}).done(function()
			{
				location.reload();
			});
		});
	});
</script>