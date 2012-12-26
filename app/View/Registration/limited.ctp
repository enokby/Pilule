<div style="float: left; font-weight: bold; padding-top: 7px;"><?php echo $user[ 'program' ]; ?></div>

<?php
    if ( !empty( $registrationSemesters ) ) :
        echo $this->element( 'semesters_dropdown', array( 'semestersList' => $registrationSemesters, 'selectedSemester' => $registrationSemester ) );
    endif;
?>

<div style="clear: both; height: 10px;"></div>

<div class="row-fluid">
	<div class="span8">
	
	</div>
	<div class="span4">
		<div id="registered-courses" style="margin-top: 27px;">
			<div class="row-fluid">
			    <div class="span12">
			        <div class="widget-box" style="margin-bottom: 0px;">
			            <div class="widget-title">
		                    <span class="icon">
		                        <i class="icon-th"></i>
		                    </span>
			                <h5 style="margin-bottom: 5px;"><?php echo $this->App->convertSemester( $registrationSemester, true ) ?> : Cours inscrits</h5>
			            </div>
			            <div class="widget-content nopadding">
			                <table class="table courses courses-list table-bordered table-striped">
			                    <thead>
									<tr>
										<th style="font-weight: bold; text-align: left;">Cours</th>
										<th style="font-weight: bold; text-align: center; width: 25%;">NRC</th>
									</tr>
								</thead>
								<tbody>
									<?php
										$credits = 0;
										if ( is_array( $registeredCourses ) ):
											foreach ( $registeredCourses as $course ):
												?>
												<tr data-nrc="<?php echo $course[ 'nrc' ]; ?>">
													<td style="font-size: 8pt;">
														<?php
															if ( strlen( $course[ 'title' ] ) > 35 ):
																echo substr( $course[ 'title' ], 0, 30 ) . "...";
															else:
																echo $course[ 'title' ];
															endif;
														?>
														<br />
														NRC : <?php echo $course['nrc']; ?>
													</td>
													<td style="font-weight: bold; text-align: right;">
														<?php echo $course['code']; ?>
														<br />
														<a href="#" class="btn delete-link"><i class="icon-remove"></i></a>
													</td>
												</tr>
												<?php
												$credits += $course[ 'credits' ];
											endforeach;
										endif;
									?>
									<tr>
										<td colspan="2">
											<div class="courses-total" style="font-weight: bold; float: left;">
												<?php if (is_array($registeredCourses)) echo count($registeredCourses); else echo 0; ?> cours
											</div>
											<div class="credits-total" style="float: right;"><?php echo $credits; ?> crédits</div>
											<div style="clear: both;"></div>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
			        </div>
			    </div>
			</div><!-- End of row-fluid -->
		</div>
	
		<div id="selected-courses" style="margin-top: 0px; margin-bottom: 20px;">
			<div class="row-fluid">
			    <div class="span12">
			        <div class="widget-box" style="margin-bottom: 0px;">
			            <div class="widget-title">
		                    <span class="icon">
		                        <i class="icon-th"></i>
		                    </span>
			                <h5 style="margin-bottom: 5px;">Sélection de cours</h5>
			            </div>
			            <div class="widget-content nopadding">
			                <table class="table courses courses-list table-bordered table-striped">
			                    <thead>
									<tr>
										<th style="font-weight: bold; text-align: left;">Cours</th>
										<th style="font-weight: bold; text-align: center; width: 25%;">NRC</th>
									</tr>
								</thead>
								<tbody>
									<?php
										$credits = 0;
										if ( is_array( $selectedCourses ) ):
											foreach ( $selectedCourses as $course ):
												?>
												<tr data-nrc="<?php echo $course[ 'nrc' ]; ?>">
													<td style="font-size: 8pt;">
														<?php
															if ( strlen( $course[ 'title' ] ) > 35 ):
																echo substr( $course[ 'title' ], 0, 30 ) . "...";
															else:
																echo $course[ 'title' ];
															endif;
														?>
														<br />
														NRC : <?php echo $course['nrc']; ?>
													</td>
													<td style="font-weight: bold; text-align: right;">
														<?php echo $course['code']; ?>
														<br />
														<a href="#" class="btn delete-link"><i class="icon-remove"></i></a>
													</td>
												</tr>
												<?php
												$credits += $course[ 'credits' ];
											endforeach;
										endif;
									?>
									<tr>
										<td colspan="2">
											<div class="courses-total" style="font-weight: bold; float: left;">
												<?php if (is_array($selectedCourses)) echo count($selectedCourses); else echo 0; ?> cours
											</div>
											<div class="credits-total" style="float: right;"><?php echo $credits; ?> crédits</div>
											<div style="clear: both;"></div>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
			        </div>
			    </div>
			</div><!-- End of row-fluid -->
		</div>

		<?php
			if ( date( 'Ymd' ) >= $deadlines[ $registrationSemester ][ 'registration_start' ]
			  && date( 'Ymd' ) <= $deadlines[ $registrationSemester ][ 'edit_selection' ] ):
				?><div style="text-align: center;"><a href="javascript:app.Registration.registerCourses();" class='btn btn-success'><i class="icon-ok icon-white"></i> Inscription</a></div><?php
			elseif ( date( 'Ymd' ) >= $deadlines[ $registrationSemester ][ 'registration_start' ] 
				   && date( 'Ymd' ) >= $deadlines[ $registrationSemester ][ 'edit_selection' ] ):
				?>
				<div style="margin-top: 35px; line-height: 12px; text-align: center; width: 180px; margin-left: auto; margin-right: auto; margin-bottom: 10px; color: gray; font-size: 8pt;">
					La période d'inscription <?php echo $this->App->convertSemester( $registrationSemester, true ); ?><br />est terminée.
				</div>
				<?php
			elseif ( date( 'Ymd' ) <= $deadlines[ $registrationSemester ][ 'registration_start' ] ):
				?>
				<div style="margin-top: 35px; line-height: 12px; text-align: center; width: 180px; margin-left: auto; margin-right: auto; margin-bottom: 10px; color: gray; font-size: 8pt;">
					La période d'inscription <?php echo $this->App->convertSemester( $registrationSemester, true ); ?> commencera le <?php echo currentDate( $deadlines[ $registrationSemester ][ 'registration_start' ], "j F Y" ); ?>.
				</div>
				<?php
			endif;
		?>

	</div>
</div>
<div id="modal-course" class="modal hide fade" tabindex="-1" role="dialog" aria-hidden="true"></div>