<div class="row-fluid">
    <div class="span6">
        <h5><i class="icon-time"></i> Stockage des données</h5>
        <p>Pour accélérer le chargement de Pilule, le système garde une copie de certaines données de votre dossier scolaire sur le serveur de l'Université Laval. Ces données sont automatiquement actualisées lorsqu'elles ont été enregistrées depuis un délai supérieur au délai indiqué ci-dessous.</p>

        <hr>

        <?php echo $this->Form->create( 'Settings' ); ?>
                <?php
                    echo $this->Form->input( 'data-expiration-delay', array( 'type' => 'select', 'label' => 'Délai d\'expiration des données :', 'options' => array(
                        ( 3600 * 24 )   =>  '24 heures',
                        ( 3600 * 12 )   =>  '12 heures',
                        ( 3600 * 6 )    =>  '6 heures',
                        ( 3600 * 5 )    =>  '5 heures',
                        ( 3600 * 2 )    =>  '2 heures',
                        ( 60 * 60 )     =>  '1 heure',
                        ( 60 * 30 )     =>  '30 min',
                        ( 60 * 15 )     =>  '15 min'
                    ), 'class' => 'input-small js-expiration-delay' ) );
                ?>
        <?php echo $this->Form->end(); ?>
    </div>

    <?php if ( $user['idul'] != 'demo' ) : ?>

    <div class="span6">
        <h5><i class="icon-remove-circle"></i> Suppression des données</h5>
        <p>Vous avez la possibilité de supprimer toutes vos données enregistrées sur le serveur de Pilule. Cela peut être utile si vous avez des problèmes d'utilisation de Pilule ou si les données stockées sont corrompues.</p>
        <p><strong>Attention : vous serez automatiquement déconnecté de Pilule après la suppression de vos données.</strong></p>
        
        <div style="text-align: center; padding: 5px;">
            <?php
                echo $this->Html->link( '<i class="icon-remove icon-white"></i> Supprimer les données', array( 'controller' => 'users', 'action' => 'eraseData' ), array( 'class' => 'btn btn-danger js-erase-data-btn', 'escape' => false ) );
            ?></div>
    </div>

    <?php endif; ?>
</div>

<?php if ( isset( $autologon ) && $autologon == 'yes' ) : ?>

<div class="row-fluid">
   <div class="span6">
        <div class="widget-box">
            <div class="widget-title">
                <span class="icon"><i class="icon-lock"></i></span>
                <h5>Connexion automatique</h5>
            </div>
            <div class="widget-content no-padding">
                <p>Pilule permet la connexion automatique en utilisant Facebook Connect ou Google Accounts. Lorsque vous serez connecté à un de ces deux services avec un compte autorisé, vous pourrez accéder directement à Pilule sans avoir besoin d'entrer votre IDUL et votre NIP. L'authentification aura déjà eu lieu lors de votre connexion à votre compte Facebook ou Google.</p>
                <p><strong>Ce service est encore en phase expérimentale.</strong></p>
                <hr>
                <form action="/settings/configure.json" method="post" id="form-configure-autologon" target="frame">
                <div style="float: left;"><input type="checkbox" id="autologon" name="autologon" value="yes"<?php if ($autologon == 'yes') echo ' checked="checked"'; ?> />&nbsp;&nbsp;<label for="autologon" style="font-style: normal; color: black; display: inline;">Activer la connexion automatique</label></div>
                    <div style="float: right; margin-left: 10px;"><a href="javascript:app.Settings.submitForm( 'autologon' );" class='btn btn-success'><i class="icon-ok icon-white"></i> Enregistrer</a></div>
                    <div style="clear: both;"></div>
                    <input type="hidden" name="param" value="autologon" />
                </form>
            </div>
        </div>
   </div>

    <div class="span6">
        <div class="widget-box">
            <div class="widget-title">
                                    <span class="icon">
                                        <i class="icon-user"></i>
                                    </span>
                <h5>Comptes autorisés</h5>
            </div>
            <div class="widget-content no-padding">
                <div style="float: left; width: 130px;"><img src="<?php echo site_url(); ?>images/facebook-logo.jpg" alt="Facebook" height="40" /></div>
                <div id="fb-account">
                    <?php if (isset($fbuid) and $fbuid) { ?>
                    <div style="float: left; margin-top: 10px; margin-right: 20px;"><a href="http://www.facebook.com/profile.php?id=<?php echo $fbuid; ?>" target="_blank"><?php echo $fbname; ?></a></div>
                    <div style="float: right; margin-top: 5px;"><a href="javascript:app.settings.unlinkAccount('facebook');" class='btn btn-danger'><i class="icon-remove icon-white"></i> Supprimer</a></div>
                    <?php } else { ?>
                    <div style="float: left; margin-top: 10px; margin-right: 20px;">Aucun compte autorisé</div>
                    <div style="float: right; margin-top: 5px;"><a href="javascript:document.location='<?php echo site_url()."cfacebook/auth/u/".base64_encode(site_url()."settings/s_linkaccount/account/facebook"); ?>';" class='btn'><i class="icon-plus"></i> Ajouter</a></div>
                    <?php } ?>
                    <div style="clear: both;"></div>
                </div>
            </div>
        </div>
    </div>

</div>
<?php endif; ?>
<iframe name="frame" style="width: 0px; height: 0px;" frameborder="0"></iframe>