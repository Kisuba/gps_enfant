<?php
session_start();
include './models/bdmodel.php';

?>
<?php

if(!(isset($_SESSION['nom']))){
header("Location: login.php");
}

?>
<!DOCTYPE html>
<html>
<head>
	<!-- Basic Page Info -->
	<meta charset="utf-8">
	<title>Listes bracelets</title>

	<!-- Site favicon -->
	<link rel="apple-touch-icon" sizes="180x180" href="vendors/images/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="vendors/images/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="vendors/images/favicon-16x16.png">

	<!-- Mobile Specific Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<!-- Google Font -->
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="vendors/styles/core.css">
	<link rel="stylesheet" type="text/css" href="vendors/styles/icon-font.min.css">
	<link rel="stylesheet" type="text/css" href="src/plugins/datatables/css/dataTables.bootstrap4.min.css">
	<link rel="stylesheet" type="text/css" href="src/plugins/datatables/css/responsive.bootstrap4.min.css">
	<link rel="stylesheet" type="text/css" href="vendors/styles/style.css">

	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-119386393-1"></script>
	<script>
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());

		gtag('config', 'UA-119386393-1');
	</script>
</head>
<body>
	<div class="pre-loader">
		<div class="pre-loader-box">
			<div class="loader-logo"><img src="eleve_photo/logo.png"  style="height:20%; width: 20%; text-align:center; margin-left:320px;" alt=""></div>
			<div class='loader-progress' id="progress_div">
				<div class='bar' id='bar1'></div>
			</div>
			<div class='percent' id='percent1'>0%</div>
			<div class="loading-text">
				Chargement...
			</div>
		</div>
	</div>

	<?php include 'include/design/header.php';?>

	<?php include 'include/design/sidebar.php';?>
	<!-- -------->
	<div class="mobile-menu-overlay"></div>

	<div class="main-container">
		<div class="pd-ltr-20 xs-pd-20-10">
			<div class="min-height-200px">
				
				<!-- Simple Datatable start -->
				
				<!-- Simple Datatable End -->
				<!-- multiple select row Datatable start -->
				
				<!-- multiple select row Datatable End -->
				<!-- Checkbox select Datatable start -->
				
				<!-- Checkbox select Datatable End -->
				<!-- Export Datatable start -->
				<div class="card-box mb-30">
					<div class="pd-20">
						<h4 class="text-black h4">Listes des bracelet</h4>
					</div>
					<div class="pb-20">
						<table id="table_eleve" class="data-table table stripe hover nowrap" style="text-align:center;">
							<div class="flex-wrap" >
						<button class="btn btn-secondary" data-toggle='modal' data-target='#Medium-modal'>Ajouter</button>
						</div>
							<thead>
								<tr>
									<th class="table-plus datatable-nosort">Id</th>
									<th>Bracelet</th>
									
                                    <th>Action</th>
                                    
								</tr>
							</thead>
							
						</table>
					</div>
				</div>
				<!-- Export Datatable End -->

			</div>
			
		</div>
	</div>
	<?php

  include "./include/modals/addbracelet.php";
  
   ?>
	<!-- js -->

	<script src="vendors/scripts/core.js"></script>
	<script src="vendors/scripts/script.min.js"></script>
	<script src="vendors/scripts/process.js"></script>
	<script src="vendors/scripts/layout-settings.js"></script>
	<script src="src/plugins/datatables/js/jquery.dataTables.min.js"></script>
	<script src="src/plugins/datatables/js/dataTables.bootstrap4.min.js"></script>
	<script src="src/plugins/datatables/js/dataTables.responsive.min.js"></script>
	<script src="src/plugins/datatables/js/responsive.bootstrap4.min.js"></script>
	<!-- buttons for Export datatable -->
	<script src="src/plugins/datatables/js/dataTables.buttons.min.js"></script>
	<script src="src/plugins/datatables/js/buttons.bootstrap4.min.js"></script>
	<script src="src/plugins/datatables/js/buttons.print.min.js"></script>
	<script src="src/plugins/datatables/js/buttons.html5.min.js"></script>
	<script src="src/plugins/datatables/js/buttons.flash.min.js"></script>
	<script src="src/plugins/datatables/js/pdfmake.min.js"></script>
	<script src="src/plugins/datatables/js/vfs_fonts.js"></script>
	<!-- Datatable Setting js -->
	<script src="vendors/scripts/datatable-setting.js"></script>
	<script>
    $(document).ready(function(){
    //$('#table_eleve').DataTable().destroy();
   datatypeeleve();
    
 
});
    


function datatypeeleve(){
        var myVariable = 'fetch';
        var tableprofondeur = $('#table_eleve').DataTable({
             "responsive": true, "lengthChange": false, "autoWidth": false,
              "destroy":true,
                "searching": true,
                dom: 'Bfrtip',
        buttons: [
            "copy", "csv",  "pdf", "print"
        ],
        
              "ajax":{
                  
                  url: 'dataoperation/braceletdataoperation.php',
                  type: 'POST',
                  data: {action: myVariable},
                  "error": function (xhr, error, thrown) {if(xhr.status == 404) {
          $('#example').html('<p>Aucune donnée trouvée</p>');
        }}
      
                  
              },
              columns:[
              {data:'Id'},
              {data:'Bracelet'},
              
              {data:'Action'}
              ],

        } );
       
} 

$('#bracelet').submit(function(event){
    event.preventDefault();
    var $form = $(this),
    url = $form.attr('action');
    var action = 'insert';
    insert_bracelet(url, action);
  });

  function insert_bracelet(url, action){
      var post = $.post(url,{
        bracelet:  $('#id_bracelet').val(),
       
        action: action
      });

      post.done(function(){
		$('#table_eleve').DataTable().destroy();
		datatypeeleve();
        $('#id_bracelet').val('');
       
        $('#Medium-modal').modal('hide');
        
      });
     
    }

function deletebrac(id){
    $.post("dataoperation/braceletdataoperation.php", {action:'getbracbyid', id:id}).done(function(data){

      var json = JSON.parse(data);
      $('#id_bra').val(json.id);
        
      $('#confirmation-modal').modal('show');

    })
  }

  function updatebrac(id){
    $.post("dataoperation/braceletdataoperation.php", {action:'getbracbyid', id:id}).done(function(data){

      var json = JSON.parse(data);
        $('#id').val(json.id);
        $('#bracelet_id').val(json.id_bracelet);
       

      $('#Modif-modal').modal('show');

    })
  }
  //modification
$('#modifbracelet').submit(function(event){
    event.preventDefault();
    var $form = $(this),
    url = $form.attr('action');
    var action = 'update';
    update_bracelet(url, action);
  });

  function update_bracelet(url, action){
      var post = $.post(url,{
        bracelet:  $('#bracelet_id').val(),
        id: $('#id').val(),
        action: action
      });

      post.done(function(){
		$('#table_eleve').DataTable().destroy();
		datatypeeleve();
        $('#bracelet_id').val('');
        $('#id').val('');
        $('#Modif-modal').modal('hide');
        
      });
     
    } 

  //delete
   $('#deletebracelet').submit(function(event){
    event.preventDefault();
    var $form = $(this),
    url = $form.attr('action');
    var action = 'delete';
    delete_bracelet(url, action);
  });

  function delete_bracelet(url, action){
      var post = $.post(url,{
       
        id: $('#id_bra').val(),
        action: action
      });

      post.done(function(){
		$('#table_eleve').DataTable().destroy();
		datatypeeleve();
       
        $('#id_bra').val('');
        $('#confirmation-modal').modal('hide');
        
      });
     
    } 
</script>
<style>
	div.flex-wrap{
		positinon:relative;
		float: left;
		margin-left: 10px;
	}
</style>
</body>
</html>