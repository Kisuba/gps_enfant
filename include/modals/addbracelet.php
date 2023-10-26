<div class="modal fade" id="Medium-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
								<div class="modal-dialog modal-dialog-centered">
									<div class="modal-content">
										<div class="modal-header">
											<h4 class="modal-title" id="myLargeModalLabel">Ajouter bracelet</h4>
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
										</div>
										<div class="modal-body">
											<form id = "bracelet" action="dataoperation/braceletdataoperation.php" method="post">
							
							
							<div class="input-group custom">
								<input type="text" class="form-control form-control-lg" id="id_bracelet" placeholder="id du bracelet" required=""/>
								
							</div>
							
							<div class="row">
								<div class="col-sm-12">
									<div class="input-group mb-0">
										<!--
											use code for form submit
											<input class="btn btn-primary btn-lg btn-block" type="submit" value="Sign In">
										-->
										<button type="submit" name="ajoutbracelet" class="btn btn-primary btn-lg btn-block">Valider</button>
										 
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
											<h4 class="padding-top-30 mb-30 weight-500">Voulez-effacer ? (Cette id est lié à d'autres elements)</h4>
											<div class="padding-bottom-30 row" style="max-width: 170px; margin: 0 auto;">
												<form id = "deletebracelet" action="dataoperation/braceletdataoperation.php" method="post">
													<input type="hidden" id="id_bra" name=""/>
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
						