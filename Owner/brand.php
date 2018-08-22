<?php require_once 'includes/header.php'; ?>

<div class="row">
	<div class="col-md-12">

		<ol class="breadcrumb">
		  <li><a href="dashboard.php">Home</a></li>		  
		  <li class="active">Bakeshops</li>
		</ol>

		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="page-heading"> <i class="glyphicon glyphicon-edit"></i> Manage this Bakeshop</div>
			</div> <!-- /panel-heading -->
			<div class="panel-body">

				<div class="remove-messages"></div>

				<div class="div-action pull pull-right" style="padding-bottom:20px;">
					<button class="btn btn-default button1" data-toggle="modal" data-target="#addBrandModel"> <i class="glyphicon glyphicon-plus-sign"></i> Add Bakeshop </button>
				</div> <!-- /div-action -->				
				
				<table class="table" id="manageBrandTable">
					<thead>
						<tr>
							<th>id</th>		
							<th>firstname</th>							
							<th>middlename</th>
							<th>lastname</th>
							<th>username</th>
							<th>gender</th>
							<th>address</th>
							<th>dateofbirth</th>
							<th>phonenumber</th>
							<th>email</th>
							<th style="width:15%;">Options</th>
						</tr>
					</thead>
				</table>
				<!-- /table -->

			</div> <!-- /panel-body -->
		</div> <!-- /panel -->		
	</div> <!-- /col-md-12 -->
</div> <!-- /row -->

<div class="modal fade" id="addBrandModel" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
    	
    	<form class="form-horizontal" id="submitBrandForm" action="php_action/createBrand.php" method="POST">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title"><i class="fa fa-plus"></i> Add Bakeshop</h4>
	      </div>
	      <div class="modal-body">

	      	<div id="add-brand-messages"></div>
	      	<!-- firstname -->
			<div class="form-group">
	        	<label for="first_name" class="col-sm-3 control-label">First Name: </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="text" class="form-control" id="first_name" placeholder="First Name" name="first_name" autocomplete="off">
				    </div>
	        </div>

			<div class="form-group">
	        	<label for="middle_name" class="col-sm-3 control-label">Middle Name: </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="text" class="form-control" id="middle_name" placeholder="Middle Name" name="middle_name" autocomplete="off">
				    </div>
	        </div>
	         <!-- /form-group-->	   	
			<div class="form-group">
	        	<label for="last_name" class="col-sm-3 control-label">Last Name: </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="text" class="form-control" id="last_name" placeholder="Last Name" name="last_name" autocomplete="off">
				    </div>
	        </div>        	        

			<div class="form-group">
	        	<label for="username" class="col-sm-3 control-label">UserName: </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="text" class="form-control" id="username" placeholder="Username" name="username" autocomplete="off">
				    </div>
	        </div>

			<div class="form-group">
	        	<label for="gender" class="col-sm-3 control-label">Gender: </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="text" class="form-control" id="gender" placeholder="Gender" name="gender" autocomplete="off">
				    </div>
	        </div>

			<div class="form-group">
	        	<label for="address" class="col-sm-3 control-label">Establishment Address: </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="text" class="form-control" id="address" placeholder="Establishment Address" name="address" autocomplete="off">
				    </div>
	        </div>

			<div class="form-group">
	        	<label for="date_of_birth" class="col-sm-3 control-label">Owner's Date of Birth: </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="date" class="form-control" id="date_of_birth" placeholder="Owner's Date of Birth" name="date_of_birth" autocomplete="off">
				    </div>
	        </div>

			<div class="form-group">
	        	<label for="phone_number" class="col-sm-3 control-label">Owner's Phone Number: </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="text" class="form-control" id="phone_number" placeholder="Owner's Phone Number" name="phone_number" autocomplete="off">
				    </div>
	        </div>

			<div class="form-group">
	        	<label for="email" class="col-sm-3 control-label">Owner's email: </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="text" class="form-control" id="email" placeholder="Owner's Email" name="email" autocomplete="off">
				    </div>
	        </div>

	      </div> <!-- /modal-body -->
	      
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	        
	        <button type="submit" class="btn btn-primary" id="createBrandBtn" data-loading-text="Loading..." autocomplete="off">Save Changes</button>
	      </div>
	      <!-- /modal-footer -->
     	</form>
	     <!-- /.form -->
    </div>
    <!-- /modal-content -->
  </div>
  <!-- /modal-dailog -->
</div>
<!-- / add modal -->

<!-- edit brand -->
<div class="modal fade" id="editBrandModel" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
    	
    	<form class="form-horizontal" id="editBrandForm" action="php_action/editBrand.php" method="POST">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title"><i class="fa fa-edit"></i> Edit Bakeshop</h4>
	      </div>
	      <div class="modal-body">

	      	<div id="edit-brand-messages"></div>

	      	<div class="modal-loading div-hide" style="width:50px; margin:auto;padding-top:50px; padding-bottom:50px;">
						<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
						<span class="sr-only">Loading...</span>
					</div>

			<div class="edit-brand-result">
		      	<div class="form-group">
		        	<label for="editFirst_name" class="col-sm-3 control-label">First Name: </label>
		        	<label class="col-sm-1 control-label">: </label>
					    <div class="col-sm-8">
					      <input type="text" class="form-control" id="editFirst_name" placeholder="First Name" name="editFirst_name" autocomplete="off">
					    </div>
		    	</div> 
		    </div>
		    <div class="edit-brand-result">
		      	<div class="form-group">
		        	<label for="editMiddle_name" class="col-sm-3 control-label">Middle Name: </label>
		        	<label class="col-sm-1 control-label">: </label>
					    <div class="col-sm-8">
					      <input type="text" class="form-control" id="editMiddle_name" placeholder="Middle Name" name="editMiddle_name" autocomplete="off">
					    </div>
		    	</div> 
		    </div>
		    <div class="edit-brand-result">
		      	<div class="form-group">
		        	<label for="editLast_name" class="col-sm-3 control-label">Last Name: </label>
		        	<label class="col-sm-1 control-label">: </label>
					    <div class="col-sm-8">
					      <input type="text" class="form-control" id="editLast_name" placeholder="Last Name" name="editLast_name" autocomplete="off">
					    </div>
		    	</div> 
		    </div>
		    <div class="edit-brand-result">
		      	<div class="form-group">
		        	<label for="editUsername" class="col-sm-3 control-label">User Name: </label>
		        	<label class="col-sm-1 control-label">: </label>
					    <div class="col-sm-8">
					      <input type="text" class="form-control" id="editUsername" placeholder="User Name" name="editUsername" autocomplete="off">
					    </div>
		    	</div> 
		    </div>
		    <div class="edit-brand-result">
		      	<div class="form-group">
		        	<label for="editGender" class="col-sm-3 control-label">Gender: </label>
		        	<label class="col-sm-1 control-label">: </label>
					    <div class="col-sm-8">
					      <input type="text" class="form-control" id="editGender" placeholder="Gender" name="editGender" autocomplete="off">
					    </div>
		    	</div> 
		    </div>
		    <div class="edit-brand-result">
		      	<div class="form-group">
		        	<label for="editAddress" class="col-sm-3 control-label">Establishment Address: </label>
		        	<label class="col-sm-1 control-label">: </label>
					    <div class="col-sm-8">
					      <input type="text" class="form-control" id="editAddress" placeholder="Establishment Address" name="editAddress" autocomplete="off">
					    </div>
		    	</div> 
		    </div>
		    <div class="edit-brand-result">
		      	<div class="form-group">
		        	<label for="editDate_of_birth" class="col-sm-3 control-label">Owner's Date of Birth: </label>
		        	<label class="col-sm-1 control-label">: </label>
					    <div class="col-sm-8">
					      <input type="date" class="form-control" id="editDate_of_birth" placeholder="Owner's Date of Birth" name="editDate_of_birth" autocomplete="off">
					    </div>
		    	</div> 
		    </div>
		    <div class="edit-brand-result">
		      	<div class="form-group">
		        	<label for="editPhone_number" class="col-sm-3 control-label">Owner's Phone Number: </label>
		        	<label class="col-sm-1 control-label">: </label>
					    <div class="col-sm-8">
					      <input type="text" class="form-control" id="editPhone_number" placeholder="Owner's Phone Number" name="editPhone_number" autocomplete="off">
					    </div>
		    	</div> 
		    </div>
		    <div class="edit-brand-result">
		      	<div class="form-group">
		        	<label for="editEmail" class="col-sm-3 control-label">Owner's Email: </label>
		        	<label class="col-sm-1 control-label">: </label>
					    <div class="col-sm-8">
					      <input type="text" class="form-control" id="editEmail" placeholder="Owner's Email" name="editEmail" autocomplete="off">
					    </div>
		    	</div> 
		    </div>
		    
		      <!-- /edit brand result -->

	      </div> <!-- /modal-body -->
	      
	      <div class="modal-footer editBrandFooter">
	        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>
	        
	        <button type="submit" class="btn btn-success" id="editBrandBtn" data-loading-text="Loading..." autocomplete="off"> <i class="glyphicon glyphicon-ok-sign"></i> Save Changes</button>
	      </div>
	      <!-- /modal-footer -->
     	</form>
	     <!-- /.form -->
    </div>
    <!-- /modal-content -->
  </div>
  <!-- /modal-dailog -->
</div>
<!-- / add modal -->
<!-- /edit brand -->

<!-- remove brand -->
<div class="modal fade" tabindex="-1" role="dialog" id="removeMemberModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><i class="glyphicon glyphicon-trash"></i> Remove Bakeshop</h4>
      </div>
      <div class="modal-body">
        <p>Do you really want to remove ?</p>
      </div>
      <div class="modal-footer removeBrandFooter">
        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>
        <button type="button" class="btn btn-primary" id="removeBrandBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-ok-sign"></i> Save changes</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- /remove brand -->

<script src="custom/js/brand2.js"></script>

<?php require_once 'includes/footer.php'; ?>