<div class="modal fade" id="Medium-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title" id="myLargeModalLabel">Ajouter un élève</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
            <form id = "eleve" method="post" enctype="multipart/form-data">
                      
               <div class="input-group custom">
                <input type="text" class="form-control form-control-lg" name="nom" id="nom" placeholder="Nom" required=""/>
                
              </div>
              <div class="input-group custom">
                <input type="text" class="form-control form-control-lg" name="postnom" id="postnom" placeholder="Postnom" required=""/>
                
              </div>
              <div class="input-group custom">
                <input type="text" class="form-control form-control-lg" name="prenom" id="prenom" placeholder="Prenom" required=""/>
                
              </div>
              <div class="input-group custom">
                <input type="text" class="form-control form-control-lg" name="adresse" id="adresse" placeholder="Adresse" required=""/>
                
              </div><div class="input-group custom">
                <input type="file" class="form-control form-control-lg" name="photo" id="photo" required=""/>
                
              </div>
              <input type="hidden" name="action" id="action" value="insert" />
              <div class="row">
                <div class="col-sm-12">
                  <div class="input-group mb-0">
                    <!--
                      use code for form submit
                      <input class="btn btn-primary btn-lg btn-block" type="submit" value="Sign In">
                    -->
                    <button type="submit" name="insert" id="insert" class="btn btn-primary btn-lg btn-block">Valider</button>
                     
                  </div>
                  
                </div>
              </div>
            </form>
                    </div>
                    
                  </div>
                </div>
              </div>

            <!-- -->
            <div class="modal fade" id="Modif-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title" id="myLargeModalLabel">Modifier élève</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                      <form id = "modifeleve" method="post" enctype="multipart/form-data">
              
              <input type="text" name="l_id" id="l_id"/>
              <div class="input-group custom">
                <input type="text" class="form-control form-control-lg" name="l_nom" id="l_nom"  required=""/>
                
              </div>
              <div class="input-group custom">
                <input type="text" class="form-control form-control-lg" name="l_postnom" id="l_postnom"  required=""/>
                
              </div>
              <div class="input-group custom">
                <input type="text" class="form-control form-control-lg" name="l_prenom" id="l_prenom"  required=""/>
                
              </div>
              <div class="input-group custom">
                <input type="text" class="form-control form-control-lg" name="l_adresse" id="l_adresse"  required=""/>
                
              </div>
             <div class="input-group custom">
                <input type="file" class="form-control form-control-lg" name="new_photo" id="new_photo"  />
                
              </div>
             
              <div class="row">
                <div class="col-sm-12">
                  <div class="input-group mb-0">
                    <!--
                      use code for form submit
                      <input class="btn btn-primary btn-lg btn-block" type="submit" value="Sign In">
                    -->
                    <button type="submit" name="insert" id="insert" class="btn btn-primary btn-lg btn-block" >Valider</button>
                     
                  </div>
                  
                </div>
              </div>
               <input type="hidden" name="action" id="action" value="update" />
            </form>
                    </div>
                    
                  </div>
                </div>
           </div>
            
            <!-- -->
              
              <div class="modal fade" id="confirmation-modal" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                  <div class="modal-content">
                    <div class="modal-body text-center font-18">
                      <h4 class="padding-top-30 mb-30 weight-500">Voulez-effacer ? (Cette id est lié à d'autres elements)</h4>
                      <div class="padding-bottom-30 row" style="max-width: 170px; margin: 0 auto;">
                        <form id = "deleteeleve" action="dataoperation/elevedataoperation.php" method="post">
                          <input type="hidden" id="ideleve" name=""/>
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
            