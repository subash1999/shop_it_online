<script>
// 
// It displays the edit popup to edit the user type and also display message for
// successful updation as well as the failure in updating
function userTypeEditPopup(ut_id,user_type,update_url) {
	bootpopup({
		title: "Edit User Type",
		size: "normal",
		showclose: false,
		size_labels: "col-lg-2",
		size_inputs: "col-sm-8",
		content: [
		'<input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">',
		'<h3>User Type ID : '+ut_id+'</h3>',
		'<label style="font-size:16px;font-weight:bold;">User Type : </label>',
		{ text: {label: "", name: "user_type",id: "user_type", placeholder: "User Type", class: "form-control",value: user_type,required:"required" }},
		// { input: {type: "text", label: "User Type :", name: "user_type", id: "user_type", placeholder: "user_type",value: user_type}},
		//before: function(window) { alert("Before"); },
		//dismiss: function(event) { alert("Dismiss"); },
		],
	cancel : function(data, array, event) { /*alert("Cancel");*/ },
	ok: function(data, array, event) {
		var processing_dialog = bootbox.dialog({
			message: '<p class="text-center">Please wait while we Update User Type...</p>',
			closeButton: false,
		});
		jQuery.ajax({
			url : update_url,
		// 
		// url : 'admin/users/user_types/'.ut_id,
		method: 'PUT',
		data: {
			id: ut_id,
			type :  $('#user_type').val(),
		},
error: function(jqXHR, textStatus, errorThrown) { // What to do if we fail
	// Refreshing the datatable after the data update is successful
	$('#user_type_data_table').DataTable().ajax.reload(null, false);
	console.log(JSON.stringify(jqXHR));
	console.log("AJAX error: " + textStatus + ' : ' + errorThrown+" : "+data);
	// Closing the processing dialog
	processing_dialog.modal('hide');
	// Showing the successful update message
	var fail_title = "<h2 style='color:red'>User Type Edit FAILURE!!</h2>";
	var fail_message = "The <label style='font-size:14px;weight:bold;'>"
	+" Change of  User Type '"
	+user_type+"' has been failed </label> due to "
	+" <label style='font-size:16px;weight:bold;'> "+
	errorThrown+"</label>"
	+" <br>Please Contact the Service Provider i.e. Website"
	+"<br> Data : "+data
	+"<br> Ajax Error : "+textStatus;
	bootbox.alert({
		message: fail_message,
		title: fail_title,
		buttons: {
			ok: {
				label: 'OK GOT IT',
				className: 'btn-danger btn-lg',
			},
		},
		className: 'bb-alternate-modal',
		callback: function (result) {
			// Adjusting the column size(width) after the message popup
			/* Because the column size(width) deformation was observed
			while not writing this
				*/
			$('#user_types_data_table').DataTable().columns.adjust().draw();
		}
	});
},
success: function(result){
	// Refreshing the datatable after the data update is successful
	$('#user_type_data_table').DataTable().ajax.reload(null, false);
	// Closing the processing dialog
	processing_dialog.modal('hide');
	// Showing the successful update message
	var success_title = "Edit SUCCESSFUL";
	var success_message = "The User Type"+
	" <label style='font-size:16px;weight:bold;'>"
	+result['previous_value']
	+"</label> has been successfully changed to"
	+" <label style='font-size:20px;weight:bold;'>"+
	result['changed_value']+"</label> ";
	bootbox.alert({
		message: success_message,
		title: success_title,
		buttons: {
			ok: {
				label: 'OK GOT IT',
				className: 'btn-success btn-lg',
			},
		},
		backdrop: true,
		className: 'bb-alternate-modal',
		callback: function (result) {
		// Adjusting the column size(width) after the message popup
		/* Because the column size(width) deformation was observed
		while not writing this
			*/
		$('#user_types_data_table').DataTable().columns.adjust().draw();
	}
});
}});
	},
});
}
// Function for creating a confirm dialog for deleting the user type
// Deleting a user type will also delete the users under that type
function userTypeDeleteConfirm(ut_id,user_type,delete_url){
	var confirm_title = '<b>Confirm Deletion??<br> User Type :'
	+'<label style="font-size:20px">'
	+'"'+user_type+'"</label> User ID : '+ut_id+'</b>';
	var confirm_message="Deleting a User Type will <b>also delete all the users "
	+" of that type '"+user_type+"'</b>. The users being deleted will be notified of this "
	+"while logging in next time. "
	+"<b>Are you sure you want to do this !!</b>";
	bootbox.confirm({
		message: confirm_message,
		title: confirm_title,
		buttons:{
			confirm: {
				label: 'Yes',
				className: 'btn-success',
			},
			cancel: {
				label: 'No',
				className: 'btn-danger',
			},
		},
		callback : function(result){
			if(result==true){
				var processing_dialog = bootbox.dialog({
					message: '<p class="text-center">Please wait while we Delete User Type and along with all the users of that user type...</p>',
					closeButton: false,
				});
				jQuery.ajax({
					url :delete_url,
			// 
			// url : 'admin/users/user_types/'.ut_id,
			method: 'DELETE',
			data: {
				id: ut_id,
				type : user_type,
			},
			error : function (jqXHR, textStatus, errorThrown) {
				// Closing the processing dialog
				processing_dialog.modal('hide');
				var delete_fail_title = "<b>Deletion Failed !!</b>";
				var delete_fail_message = "The deletion of the "+
				"User Types along with the Users of that type is failed"+
				"<br> Error Thrown : "+errorThrown+
				"<br> Error Text Status : "+textStatus+
				"<br><b>Please Contact the Service Provider i.e. Website</b>";
				bootbox.alert({
					message: delete_fail_message,
					title: delete_fail_title,
					buttons: {
						ok: {
							label: 'OK GOT IT',
							className: 'btn-danger btn-lg',
						},
					},
					backdrop: false,
					className: 'bb-alternate-modal',
					callback: function (result) {
					}
				});
			},
			success: function (result) {
				// Refreshing the datatable after the data update is successful
				$('#user_type_data_table').DataTable().ajax.reload(null, false);
				// Closing the processing dialog
				processing_dialog.modal('hide');
				var delete_success_title = "<b>Deletion SUCCESSFUL </b>";
				var delete_success_message = "The deletion of the "+
				"User Types <b>'"+user_type+"'</b> along with the Users of that type is successful"+
				"<br> Thus all the users of the user type "+user_type+"are also deleted.<br><b>Note : The users will be notifed about their deletion form the site</b>";
				bootbox.alert({
					message: delete_success_message,
					title: delete_success_title,
					buttons: {
						ok: {
							label: 'OK GOT IT',
							className: 'btn-warning btn-lg',
						},
					},
					backdrop: false,
					className: 'bb-alternate-modal',
					callback: function (result) {
						// Adjusting the column size(width) after the message popup
				/* Because the column size(width) deformation was observed
			while not writing this
				*/
			$('#user_types_data_table').DataTable().columns.adjust().draw();
		}
	});
			}
		});
			}
		},
	});
}
function restoreUserType() {
	bootbox.confirm({
		title: "Confirm User Restore",
		message : "Do you want to restore the deleted user types",
		buttons:{
			confirm: {
				label: 'Yes',
				className: 'btn-success',
			},
			cancel: {
				label: 'No',
				className: 'btn-danger',
			},
		},
		callback : function(result){
			if(result == true){
				// restoring the users along with the user types
				jQuery.ajax({
					url : "<?php echo e(URL::to('admin/users/user_types/restore_deleted')); ?>",
			// 
				// url : 'admin/users/user_types/'.ut_id,
				method: 'POST',
				data: {
					info:"restoring deleted user types",
				},
				error: function (jqXHR, textStatus, errorThrown) {
					var fail_message = "The <label style='font-size:14px;weight:bold;'>"
					+" Restoring of all deleted user types has been failed </label> due to "
					+" <label style='font-size:16px;weight:bold;'> "+
					errorThrown+"</label>"
					+" <br>Please Contact the Service Provider i.e. Website"
					+"<br> Ajax Error : "+textStatus;
					bootbox.alert({
						title: "Error Restoring",
						message: fail_message,
						buttons: {
							ok: {
								label: 'OK GOT IT',
								className: 'btn-danger btn-lg',
							},
						},
						backdrop: false,
						className: 'bb-alternate-modal',
						callback: function (result) {
						}
					});
				},
				success: function (result) {
					// Refreshing the datatable after the data update is successful
					$('#user_type_data_table').DataTable().ajax.reload();
					$('#user_types_data_table').DataTable().columns.adjust().draw();
					bootbox.alert({
						title: "SUCCESSFUL",
						message: "Sussessful restoring the deleted user types",
						buttons: {
							ok: {
								label: 'OK GOT IT',
								className: 'btn-success btn-lg',
							},
						},
						backdrop: false,
						className: 'bb-alternate-modal',
						callback: function (result) {
						}
					});
				},
			});
			}
		},
	});
	
}
// ON submit for adding the new user type
jQuery(document).ready(function($) {
	$('#add_user_type_form').submit(function(event) {
		event.preventDefault();
		var user_type = $('#new_admin_type').val();
		bootbox.confirm({
			title: "Confirm User Type Addition",
			message : "Do you want to add user type <b>'"+user_type+"'</b>",
			buttons:{
				confirm: {
					label: 'Yes',
					className: 'btn-success',
				},
				cancel: {
					label: 'No',
					className: 'btn-danger',
				},
			},
			callback : function (result) {
				if(result==true){
					var processing_dialog = bootbox.dialog({
						message: '<p class="text-center">Please wait while we Update User Type...</p>',
						closeButton: false,
					});

					jQuery.ajax({
						url : "<?php echo e(url('admin/users/user_types')); ?>",
						// 
						// url : 'admin/users/user_types/'.ut_id,
						method: 'POST',
						data: {
							type :  user_type,
						},
						error : function (jqXHR, textStatus, errorThrown) {
							// Refreshing the datatable after the data update is successful
							$('#user_type_data_table').DataTable().ajax.reload(null, false);
							console.log(JSON.stringify(jqXHR));
							console.log("AJAX error: " + textStatus + ' : ' + errorThrown+" : "+data);
							// Closing the processing dialog
							processing_dialog.modal('hide');
							// Showing the successful update message
							var fail_title = "<h2 style='color:red'>Adding User Type FAILURE!!</h2>";
							var fail_message = "The <label style='font-size:14px;weight:bold;'>"
							+" addition of  User Type '"
							+user_type+"' has been failed </label> due to "
							+" <label style='font-size:16px;weight:bold;'> "+
							errorThrown+"</label>"
							+" <br>Please Contact the Service Provider i.e. Website"
							+"<br> Data : "+data
							+"<br> Ajax Error : "+textStatus;
							bootbox.alert({
								message: fail_message,
								title: fail_title,
								buttons: {
									ok: {
										label: 'OK GOT IT',
										className: 'btn-danger btn-lg',
									},
								},
								className: 'bb-alternate-modal',
								callback: function (result) {
								// Adjusting the column size(width) after the message popup
								/* Because the column size(width) deformation was observed
								while not writing this
									*/
								$('#user_types_data_table').DataTable().columns.adjust().draw();
							}
						});
						},
						success : function (result) {
							// Refreshing the datatable after the data update is successful
							$('#user_type_data_table').DataTable().ajax.reload(null, false);
							// Closing the processing dialog
							processing_dialog.modal('hide');
							// Showing the successful update message
							var success_title = "Addition SUCCESSFUL";
							var success_message = "The User Type"+
							" <label style='font-size:16px;weight:bold;'>"
							+user_type
							+"</label> has been successfully added to"
							+" <label style='font-size:20px;weight:bold;'>"+
							"<?php echo e(config('app.name', 'Shop IT Online')); ?>"+"</label> ";
							bootbox.alert({
								message: success_message,
								title: success_title,
								buttons: {
									ok: {
										label: 'OK GOT IT',
										className: 'btn-success btn-lg',
									},
								},
								backdrop: true,
								className: 'bb-alternate-modal',
								callback: function (result) {
									// Adjusting the column size(width) after the message popup
									/* Because the column size(width) deformation was observed
									while not writing this
										*/
									$('#user_types_data_table').DataTable().columns.adjust().draw();
								},
							});						
						}
					});
				}
				$("#new_admin_type").val('');
			}
		});
	});
});
function refreshUserTypesTable() {
	// Refreshing the datatable after the data update is successful
	$('#user_type_data_table').DataTable().ajax.reload();
	$('#user_types_data_table').DataTable().columns.adjust().draw();
}
/*DATATABLES DATATABLES DATATABLES DATATABLES DATATABLES DATATABLES DATATABLES DATATABLES DATATABLES DATATABLES DATATABLES DATATABLES DATATABLES DATATABLES DATATABLES DATATABLES DATATABLES DATATABLES  DATATABLES DATATABLES */
/*DATATABLES DATATABLES DATATABLES DATATABLES DATATABLES DATATABLES DATATABLES DATATABLES DATATABLES DATATABLES DATATABLES DATATABLES DATATABLES DATATABLES DATATABLES DATATABLES DATATABLES DATATABLES  DATATABLES DATATABLES */
/*Below is the code for making the datatable of the user types in admin/users/user_types*/
// <!-- Page-Level Demo Scripts - Tables - Use for reference -->
jQuery(document).ready(function($) {
	var table = $('#user_types_data_table').DataTable({
		"fnDrawCallback": function (oSettings) {
			$('.dataTables_scrollBody').slimScroll({
				height: '400px'
			});
		},
		orderCellsTop: true,
		responsive : true,
		stateSave: false,
		"stateSaveParams": function (settings, data) {
			data.search.search = "";
		},
		"iDisplayLength": 10,
		"bJQueryUI": true,
		"autoWidth": true,
		"sScrollY" : "400px",
		"columnDefs": [ {
			"searchable": false,
			"orderable": false,
			"targets": 0
		} ],
		"order": [[ 1, 'asc' ]],
		// This is for the data from the ajax i.e serverside processing
		"processing" : true,
		"serverSide" : true,
		"ajax" : "<?php echo e(URL::to('admin/users/user_types/get_table')); ?>",
		"columns" : [
		{"data" : "ut_id"},
		{ "data" : "type"},
		{ "data" : "user_type_relations_count"},
		{ "data" : "action", orderable:false,searchable:false}
		]
		// "dom" : '<"top"i>rt<"bottom"flp><"clear">',
	});
	table.columns.adjust().draw();
		// This is for the auto assigning the serial Number i.e S.N
		table.on( 'order.dt search.dt', function () {
			table.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
				cell.innerHTML = i+1;
			} );
		} ).draw();
	});
		// The following code is for the search on the top applicable
		// datable initialization, for this there must be a additional 'tr'
		// in 'thead' of table
		// and the id of the additional 'tr' in the thead must be 'filterrow'
		jQuery(document).ready(function($) {
		// Setup - add a text input to each footer cell
		$('.dataTables_scrollHeadInner thead tr#filterrow th').each( function () {
			var title = $('#user_types_data_table thead th').eq( $(this).index() ).text();
			$(this).html( '<input type="text" style="width:90%;" onclick="stopPropagation(event);" placeholder="Search '+title+'" />' );
		} );
		// DataTable
		var table = $('#user_types_data_table').DataTable();
		// Apply the filter
		$(".dataTables_scrollHeadInner thead input").on( 'keyup change', function () {
			table
			.column( $(this).parent().index()+':visible' )
			.search( this.value )
			.draw();
		} );
		function stopPropagation(evt) {
			if (evt.stopPropagation !== undefined) {
				evt.stopPropagation();
			} else {
				evt.cancelBubble = true;
			}
		}
	});
// THE code below is for the footer columnwise searching
// for this there must be a footer in the html table
/*
$(document).ready(function() {
// Setup - add a text input to each footer cell
$('.dataTables_scrollFootInner tfoot th').each( function () {
var title = $(this).text();
$(this).html( '<input type="text" placeholder="Search '+title+'" />' );
} );

// DataTable
var table = $('#user_types_data_table').DataTable();

// Apply the search
table.columns().every( function () {
var that = this;

$( 'input', this.footer() ).on( 'keyup change', function () {
if ( that.search() !== this.value ) {
that
.search( this.value )
.draw();
}
} );
} );
} );
*/
</script>