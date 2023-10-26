
<div class="modal fade" id="Medium-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
								<div class="modal-dialog modal-dialog-centered">
									<div class="modal-content">
										<div class="modal-header">
											<h4 class="modal-title" id="myLargeModalLabel">Lier un bracelet à un élève</h4>
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
										</div>
										<div class="modal-body">
											<form id = "gps_eleve" action="dataoperation/gps_elevedataoperation.php" method="post">
							
							<div class="input-group custom">
								<select class="form-control form-control-lg" id="id_bracelet" required="">
									<option value="0">Id du bracelet</option>
									<?php 
									include './models/bdmodel.php';
									include './models/braceletmodel.php';
										 $model = new Bracelet();
										 	$rows = $model->fetch_brac_eleve();
											
												  if(!empty($rows)){
													foreach ($rows as $row) {
											
													$id = $row["id"];
													$nom = $row["id_bracelet"];
												  
										?>
									
									<option value="<?php echo $id;?>"><?php echo $nom;?></option>
									<?php }} ?>
								</select>
								
								
							</div>

							<div class="input-group custom">
								<select class="form-control form-control-lg" id="id_eleve" required="">
									<option value="0">Non de l'élèves</option>
									<?php 
									
									include './models/elevemodel.php';
										 $model = new Eleve();
										 	$rows = $model->fetch_eleve_brac();
											
												  if(!empty($rows)){
													foreach ($rows as $row) {
											
													$id = $row["id"];
													$nom = $row["nom"];
												  
										?>
									
									<option value="<?php echo $id;?>"><?php echo $nom;?></option>
									<?php }} ?>
								</select>
								
								
							</div>
							
							<div class="row">
								<div class="col-sm-12">
									<div class="input-group mb-0">
										<!--
											use code for form submit
											<input class="btn btn-primary btn-lg btn-block" type="submit" value="Sign In">
										-->
										<button type="submit" name="ajoutgpseleve" class="btn btn-primary btn-lg btn-block">Valider</button>
										 
									</div>
									
								</div>
							</div>
						</form>
										</div>
										
									</div>
								</div>
							</div>

					<div class="modal fade" id="Modif-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
								<div class="modal-dialog modal-dialog-centered">
									<div class="modal-content">
										<div class="modal-header">
											<h4 class="modal-title" id="myLargeModalLabel">Modifier bracelet</h4>
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
										</div>
										<div class="modal-body">
											<form id = "modifbracelet" action="dataoperation/braceletdataoperation.php" method="post">
							
							<input type="hidden" id="id"/>
							<div class="input-group custom">
								<input type="text" class="form-control form-control-lg" id="bracelet_id"  required=""/>
								
							</div>
							
							<div class="row">
								<div class="col-sm-12">
									<div class="input-group mb-0">
										<!--
											use code for form submit
											<input class="btn btn-primary btn-lg btn-block" type="submit" value="Sign In">
										-->
										<button type="submit" class="btn btn-primary btn-lg btn-block" >Valider</button>
										 
									</div>
									
								</div>
							</div>
						</form>
										</div>
										
									</div>
								</div>
							</div>
						
							
							<div class="modal fade" id="confirmation-modal" tabindex="-1" role="dialog" aria-hidden="true">
								<div class="modal-dialog modal-dialog-centered" role="document">
									<div class="modal-content">
										<div class="modal-body text-center font-18">
											<h4 class="padding-top-30 mb-30 weight-500">Voulez-effacer ?</h4>
											<div class="padding-bottom-30 row" style="max-width: 170px; margin: 0 auto;">
												<form id = "delete_id_gpseleve" action="dataoperation/gps_elevedataoperation.php" method="post">
													<input type="hidden" id="idgpseleve" name=""/>
													<di class="row" >
												<div class="col-8">
													<button type="button" class="btn btn-secondary border-radius-100 btn-block confirmation-btn" data-dismiss="modal"><i class="fa fa-times"></i></button>
													Non
												</div>
												<div class="col-4">
													<button type="submit" class="btn btn-primary border-radius-100 btn-block confirmation-btn"><i class="fa fa-check"></i></button>
													Oui
												</div>
											</di>
											</form>
											</div>
										</div>
									</div>
								</div>
							</div>
						