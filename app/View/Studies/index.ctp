<div class="row-fluid">
    <div class="request-description">Données extraites du système de gestion des études de l'Université Laval, le <?php echo date('d/m/Y, à H:i', $timestamp ); ?>.</div>
</div>
<div class="row-fluid">
    <div class="span8">
    <?php foreach ( $programs[ 'Program' ] as $program ) : ?>
        <div class="widget-box">
            <div class="widget-title">
    			<span class="icon"><i class="icon-th"></i></span>
                <h5>Programme d'études</h5>
            </div>
            <div class="widget-content nopadding">
                <table class="table table-bordered table-striped">
                    <tbody>
                    <tr>
                        <th style="vertical-align: middle;">Programme</th>
                        <td>
                            <?php
                                echo $program[ 'name' ];

                                if ( !empty( $program['diploma'] ) )
                                    echo ' (' . $program[ 'diploma' ] . ')' ;
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <th style="vertical-align: middle;">Cycle</th>
                        <td>
                            <?php
                                if ( $program[ 'cycle' ] == 1 ) :
                                    echo 'Premier cycle';
                                elseif ( $program[ 'cycle' ] == 2 ) :
                                    echo 'Deuxième cycle';
                                elseif ( $program[ 'cycle' ] == 3 ):
                                    echo 'Troisième cycle';
                                endif;
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <th style="vertical-align: middle;">Admission</th>
                        <td>
                            <?php echo $this->App->convertSemester( $program[ 'adm_semester' ] ); ?>&nbsp;&nbsp;|&nbsp;&nbsp;<?php echo $program['adm_type'] ; ?>
                        </td>
                    </tr>
                    <?php if ( !empty( $program[ 'faculty' ] ) ) : ?>
                        <tr>
                            <th style="vertical-align: middle;">Faculté</th>
                            <td><?php echo $program[ 'faculty' ] ; ?></td>
                        </tr>
                    <?php endif; ?>
                    <tr>
                        <th style="vertical-align: middle;">Majeure</th>
                        <td><?php echo $program[ 'major' ] ; ?></td>
                    </tr>
                    <?php if ( $program[ 'concentrations' ] != array() ) : ?>
                        <tr>
                            <th style="vertical-align: middle;">Concentration(s)</th>
                            <td><?php echo implode( ', ', $program[ 'concentrations' ] ); ?></td>
                        </tr>
                    <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<div class="span4">
    <div class="widget-box">
        <div class="widget-title">
            <span class="icon"><i class="icon-th"></i></span>
            <h5>Statut</h5>
        </div>
        <div class="widget-content nopadding">
            <table class="table table-bordered table-striped">
                <tbody>
                <tr>
                    <th style="vertical-align: middle;">Statut</th>
                    <td><?php echo $user[ 'status' ] ; ?></td>
                </tr>
                <tr>
                    <th style="vertical-align: middle;">Inscrit actuellement</th>
                    <td><?php if ( $user[ 'registered' ] ) echo 'Oui'; else echo 'Non'; ?></td>
                </tr>
                <tr>
                    <th style="vertical-align: middle;">1ère session</th>
                    <td><?php if ( !empty( $user[ 'first_sem' ] ) ) echo $this->App->convertSemester( $user[ 'first_sem' ] ); ?></td>
                </tr>
                <?php if ( !empty( $user[ 'last_sem' ] ) ) : ?>
                    <tr>
                        <th style="vertical-align: middle;">Dernière session</th>
                        <td><?php echo $this->App->convertSemester($user['last_sem']); ?></td>
                    </tr>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

</div><!-- End of row-fluid -->