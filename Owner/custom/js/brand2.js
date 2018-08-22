var manageBrandTable;

$(document).ready(function() {
	// top bar active
	$('#navBrand').addClass('active');
	
	// manage brand table
	manageBrandTable = $("#manageBrandTable").DataTable({
		'ajax': 'php_action/fetchBrand.php',
		'order': []		
	});

	// submit brand form function
	$("#submitBrandForm").unbind('submit').bind('submit', function() {
		// remove the error text
		$(".text-danger").remove();
		// remove the form error
		$('.form-group').removeClass('has-error').removeClass('has-success');			

		var first_name = $("#first_name").val();
		var middle_name = $("#middle_name").val();
		var last_name = $("#last_name").val();
		var username = $("#username").val();
		var gender = $("#gender").val();
		var address = $("#address").val();
		var date_of_birth = $("#date_of_birth").val();
		var phone_number = $("#phone_number").val();
		var email = $("#email").val();


		if(first_name == "") {
			$("#first_name").after('<p class="text-danger">First Name field is required</p>');
			$('#first_name').closest('.form-group').addClass('has-error');
		} else {
			// remov error text field
			$("#first_name").find('.text-danger').remove();
			// success out for form 
			$("#first_name").closest('.form-group').addClass('has-success');	  	
		}
		if(middle_name == "") {
			$("#middle_name").after('<p class="text-danger">First Name field is required</p>');
			$('#middle_name').closest('.form-group').addClass('has-error');
		} else {
			// remov error text field
			$("#middle_name").find('.text-danger').remove();
			// success out for form 
			$("#middle_name").closest('.form-group').addClass('has-success');	  	
		}
		if(last_name == "") {
			$("#last_name").after('<p class="text-danger">Bakeshop Name field is required</p>');
			$('#last_name').closest('.form-group').addClass('has-error');
		} else {
			// remov error text field
			$("#last_name").find('.text-danger').remove();
			// success out for form 
			$("#last_name").closest('.form-group').addClass('has-success');	  	
		}
		if(username == "") {
			$("#username").after('<p class="text-danger">First Name field is required</p>');
			$('#username').closest('.form-group').addClass('has-error');
		} else {
			// remov error text field
			$("#username").find('.text-danger').remove();
			// success out for form 
			$("#username").closest('.form-group').addClass('has-success');	  	
		}
		if(gender == "") {
			$("#gender").after('<p class="text-danger">First Name field is required</p>');
			$('#gender').closest('.form-group').addClass('has-error');
		} else {
			// remov error text field
			$("#gender").find('.text-danger').remove();
			// success out for form 
			$("#gender").closest('.form-group').addClass('has-success');	  	
		}
		if(address == "") {
			$("#address").after('<p class="text-danger">Bakeshop Address field is required</p>');
			$('#address').closest('.form-group').addClass('has-error');
		} else {
			// remov error text field
			$("#address").find('.text-danger').remove();
			// success out for form 
			$("#address").closest('.form-group').addClass('has-success');	  	
		}
		if(date_of_birth == "") {
			$("#date_of_birth").after('<p class="text-danger">Brand Name field is required</p>');

			$('#date_of_birth').closest('.form-group').addClass('has-error');
		} else {
			// remov error text field
			$("#date_of_birth").find('.text-danger').remove();
			// success out for form 
			$("#date_of_birth").closest('.form-group').addClass('has-success');	  	
		}
		if(phone_number == "") {
			$("#phone_number").after('<p class="text-danger">Brand Name field is required</p>');

			$('#phone_number').closest('.form-group').addClass('has-error');
		} else {
			// remov error text field
			$("#phone_number").find('.text-danger').remove();
			// success out for form 
			$("#phone_number").closest('.form-group').addClass('has-success');	  	
		}
		if(email == "") {
			$("#email").after('<p class="text-danger">Brand Name field is required</p>');

			$('#email').closest('.form-group').addClass('has-error');
		} else {
			// remov error text field
			$("#email").find('.text-danger').remove();
			// success out for form 
			$("#email").closest('.form-group').addClass('has-success');	  	
		}

		if(first_name && middle_name && last_name && username && gender && address && date_of_birth 
			&& phone_number && email) {
			var form = $(this);
			// button loading
			$("#createBrandBtn").button('loading');

			$.ajax({
				url : form.attr('action'),
				type: form.attr('method'),
				data: form.serialize(),
				dataType: 'json',
				success:function(response) {
					// button loading
					$("#createBrandBtn").button('reset');

					if(response.success == true) {
						// reload the manage member table 
						manageBrandTable.ajax.reload(null, false);						

  	  			// reset the form text
						$("#submitBrandForm")[0].reset();
						// remove the error text
						$(".text-danger").remove();
						// remove the form error
						$('.form-group').removeClass('has-error').removeClass('has-success');
  	  			
  	  			$('#add-brand-messages').html('<div class="alert alert-success">'+
            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
          '</div>');

  	  			$(".alert-success").delay(500).show(10, function() {
							$(this).delay(3000).hide(10, function() {
								$(this).remove();
							});
						}); // /.alert
					}  // if

				} // /success
			}); // /ajax	
		} // if

		return false;
	}); // /submit brand form function

});

function editBrands(id = null) {
	if(id) {
		// remove hidden brand id text
		$('#id').remove();

		// remove the error 
		$('.text-danger').remove();
		// remove the form-error
		$('.form-group').removeClass('has-error').removeClass('has-success');

		// modal loading
		$('.modal-loading').removeClass('div-hide');
		// modal result
		$('.edit-brand-result').addClass('div-hide');
		// modal footer
		$('.editBrandFooter').addClass('div-hide');

		$.ajax({
			url: 'php_action/fetchSelectedBrand.php',
			type: 'post',
			data: {id : id},
			dataType: 'json',
			success:function(response) {
				// modal loading
				$('.modal-loading').addClass('div-hide');
				// modal result
				$('.edit-brand-result').removeClass('div-hide');
				// modal footer
				$('.editBrandFooter').removeClass('div-hide');

				// setting the Bakeshop name value 
				$('#editFirst_name').val(response.first_name);
				$('#editMiddle_name').val(response.middle_name);
				$('#editLast_name').val(response.last_name);
				$('#editUsername').val(response.username);
				$('#editGender').val(response.gender);
				$('#editAddress').val(response.address);
				$('#editDate_of_birth').val(response.date_of_birth);
				$('#editPhone_number').val(response.phone_number);
				$('#editEmail').val(response.email);
				$(".editBrandFooter").after('<input type="hidden" name="id" id="id" value="'+response.id+'" />');

				// update brand form 
				$('#editBrandForm').unbind('submit').bind('submit', function() {

					// remove the error text
					$(".text-danger").remove();
					// remove the form error
					$('.form-group').removeClass('has-error').removeClass('has-success');

					var first_name = $('#editFirst_name').val();
					var middle_name = $('#editMiddle_name').val();
					var last_name = $('#editLast_name').val();
					var username = $('#editUsername').val();
					var gender = $('#editGender').val();
					var address = $('#editAddress').val();
					var date_of_birth = $('#editDate_of_birth').val();
					var phone_number = $('#editPhone_number').val();
					var email = $('#editEmail').val();
					if(first_name == "") {
						$("#editFirst_name").after('<p class="text-danger">Owner Name field is required</p>');
						$('#editFirst_name').closest('.form-group').addClass('has-error');
					} else {
						// remov error text field
						$("#editFirst_name").find('.text-danger').remove();
						// success out for form 
						$("#editFirst_name").closest('.form-group').addClass('has-success');	  	
					}
					if(middle_name == "") {
						$("#editMiddle_name").after('<p class="text-danger">Owner Name field is required</p>');
						$('#editMiddle_name').closest('.form-group').addClass('has-error');
					} else {
						// remov error text field
						$("#editMiddle_name").find('.text-danger').remove();
						// success out for form 
						$("#editMiddle_name").closest('.form-group').addClass('has-success');	  	
					}
					if(last_name == "") {
						$("#editLast_name").after('<p class="text-danger">Owner Name field is required</p>');
						$('#editLast_name').closest('.form-group').addClass('has-error');
					} else {
						// remov error text field
						$("#editLast_name").find('.text-danger').remove();
						// success out for form 
						$("#editLast_name").closest('.form-group').addClass('has-success');	  	
					}
					if(username == "") {
						$("#editUsername").after('<p class="text-danger">Owner Name field is required</p>');
						$('#editUsername').closest('.form-group').addClass('has-error');
					} else {
						// remov error text field
						$("#editUsername").find('.text-danger').remove();
						// success out for form 
						$("#editUsername").closest('.form-group').addClass('has-success');	  	
					}
					if(gender == "") {
						$("#editGender").after('<p class="text-danger">Owner Name field is required</p>');
						$('#editGender').closest('.form-group').addClass('has-error');
					} else {
						// remov error text field
						$("#editGender").find('.text-danger').remove();
						// success out for form 
						$("#editGender").closest('.form-group').addClass('has-success');	  	
					}
					if(address == "") {
						$("#editAddress").after('<p class="text-danger">Brand Name field is required</p>');
						$('#editAddress').closest('.form-group').addClass('has-error');
					} else {
						// remov error text field
						$("#editAddress").find('.text-danger').remove();
						// success out for form 
						$("#editAddress").closest('.form-group').addClass('has-success');	  	
					}
					if(date_of_birth == "") {
						$("#editDate_of_birth").after('<p class="text-danger">Owner Name field is required</p>');
						$('#editDate_of_birth').closest('.form-group').addClass('has-error');
					} else {
						// remov error text field
						$("#editDate_of_birth").find('.text-danger').remove();
						// success out for form 
						$("#editDate_of_birth").closest('.form-group').addClass('has-success');	  	
					}
					if(phone_number == "") {
						$("#editPhone_number").after('<p class="text-danger">Owner Name field is required</p>');
						$('#editPhone_number').closest('.form-group').addClass('has-error');
					} else {
						// remov error text field
						$("#editPhone_number").find('.text-danger').remove();
						// success out for form 
						$("#editPhone_number").closest('.form-group').addClass('has-success');	  	
					}
					if(email == "") {
						$("#editEmail").after('<p class="text-danger">Owner Name field is required</p>');
						$('#editEmail').closest('.form-group').addClass('has-error');
					} else {
						// remov error text field
						$("#editEmail").find('.text-danger').remove();
						// success out for form 
						$("#editEmail").closest('.form-group').addClass('has-success');	  	
					}
					if(first_name && middle_name && last_name && username && gender && address && date_of_birth && phone_number && email) {
						var form = $(this);

						// submit btn
						$('#editBrandBtn').button('loading');

						$.ajax({
							url: form.attr('action'),
							type: form.attr('method'),
							data: form.serialize(),
							dataType: 'json',
							success:function(response) {

								if(response.success == true) {
									console.log(response);
									// submit btn
									$('#editBrandBtn').button('reset');

									// reload the manage member table 
									manageBrandTable.ajax.reload(null, false);								  	  										
									// remove the error text
									$(".text-danger").remove();
									// remove the form error
									$('.form-group').removeClass('has-error').removeClass('has-success');
			  	  			
			  	  			$('#edit-brand-messages').html('<div class="alert alert-success">'+
			            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
			            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
			          '</div>');

			  	  			$(".alert-success").delay(500).show(10, function() {
										$(this).delay(3000).hide(10, function() {
											$(this).remove();
										});
									}); // /.alert
								} // /if
									
							}// /success
						});	 // /ajax												
					} // /if

					return false;
				}); // /update brand form

			} // /success
		}); // ajax function

	} else {
		alert('error!! Refresh the page again');
	}
} // /edit brands function

function removeBrands(id = null) {
	if(id) {
		$('#removeBrandId').remove();
		$.ajax({
			url: 'php_action/fetchSelectedBrand.php',
			type: 'post',
			data: {id : id},
			dataType: 'json',
			success:function(response) {
				$('.removeBrandFooter').after('<input type="hidden" name="removeBrandId" id="removeBrandId" value="'+response.id+'" /> ');

				// click on remove button to remove the brand
				$("#removeBrandBtn").unbind('click').bind('click', function() {
					// button loading
					$("#removeBrandBtn").button('loading');

					$.ajax({
						url: 'php_action/removeBrand.php',
						type: 'post',
						data: {id : id},
						dataType: 'json',
						success:function(response) {
							console.log(response);
							// button loading
							$("#removeBrandBtn").button('reset');
							if(response.success == true) {

								// hide the remove modal 
								$('#removeMemberModal').modal('hide');

								// reload the brand table 
								manageBrandTable.ajax.reload(null, false);
								
								$('.remove-messages').html('<div class="alert alert-success">'+
			            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
			            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
			          '</div>');

			  	  			$(".alert-success").delay(500).show(10, function() {
										$(this).delay(3000).hide(10, function() {
											$(this).remove();
										});
									}); // /.alert
							} else {

							} // /else
						} // /response messages
					}); // /ajax function to remove the brand

				}); // /click on remove button to remove the brand

			} // /success
		}); // /ajax

		$('.removeBrandFooter').after();
	} else {
		alert('error!! Refresh the page again');
	}
} // /remove brands function
