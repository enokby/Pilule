<div class="alert alert-block capsule-offline<?php if ( $capsule_offline ) echo ' offline'; ?>">
    <h4>Important !</h4> Le serveur de Capsule est actuellement indisponible. Les données affichées seront actualisées lorsque Capsule sera de nouveau opérationnel. Notez que certaines fonctions peuvent ne pas être disponibles.
</div>

<div class="row-fluid" style="margin-top: 10px;">

    <div class="span12 center" style="text-align: left;">
        <ul class="quick-actions dashboard">
<?php
// Sélection des modules de l'utilisateur
$number = 1;

foreach ( $modules as $module ) {
	$allowed = true;
	
	switch ( $module[ 'alias' ] ) {
		case 'registration':
			if ( !$user[ 'registration' ] ) $allowed = false;
		break;
		case 'admin':
			if ( !$user[ 'admin' ] ) $allowed = false;
		break;
		default:
			$allowed = true;
		break;
	}

	if ( $allowed and $module['active'] ) {
	?>
    <li>
        <a href="<?php if (strpos($module['url'], "s_connect")>0) echo "javascript:app.dashboard.connectTo('".$module['url']."');"; elseif ($module['external']) echo "javascript:app.dashboard.openExternalWebsite('".$module['url']."');"; else echo $module['url']; ?>"<?php if (isset($module['target'])) echo ' target="'.$module['target'].'"'; ?>>
            <img src="<?php echo site_url(); ?>img/modules/<?php echo $module['icon']; ?>" />
            <div class="title"><?php echo $module['name']; ?></div>
        </a>
    </li>
	<?php
		$number++;
	}
}
?>

        </ul>
    </div>
</div>

</div><!-- End of row-fluid -->