<!-- The Script below is for the second lower_table i.e the deleted users -->
<!-- DELETED USERS lower_table -->
<!-- DELETED USERS lower_table -->
<!-- DELETED USERS lower_table -->
<!-- DELETED USERS lower_table -->
<!-- DELETED USERS lower_table -->
<!-- DELETED USERS lower_table -->
<!-- DELETED USERS lower_table -->
<script>
	function userRestoreConfirm(user_id,username,restore_url){
		var confirm_title = '<b>Confirm Restore??<br> User  :'
		+'<label style="font-size:20px">'
		+'"'+username+'"</label> User ID : '+user_id+'</b>';
		var confirm_message="Restoring a User will get that user into the system and"
		+" new data regarding that user will be created as the user uses the system"
		+"<br><b>Are you sure you want to do this !!</b>";
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
						message: '<p class="text-center">Please wait while we Restore User : '+username+'</p>',
						closeButton: false,
					});
					jQuery.ajax({
						url :restore_url,
			// 
			// url : 'admin/users/user_types/'.ut_id,
			method: 'post',
			data: {
				id: user_id,
				username :  username,
			},
			error : function (jqXHR, textStatus, errorThrown) {
				// Closing the processing dialog
				processing_dialog.modal('hide');
				var restore_fail_title = "<b>Restoration Failed !!</b>";
				var restore_fail_message = "The restoration of the "+
				"User is failed"+
				"<br> Error Thrown : "+errorThrown+
				"<br> Error Text Status : "+textStatus+
				"<br><b>Please Contact the Service Provider i.e. Website with errors</b>";
				bootbox.alert({
					message: restore_fail_message,
					title: restore_fail_title,
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
				$('#deleted_all_users_data_table').DataTable().ajax.reload(null, false);
				// Closing the processing dialog
				processing_dialog.modal('hide');
				var restore_success_title = "<b>Restoration SUCCESSFUL </b>";
				var restore_success_message = "The restoration of the "+
				"User <b>'"+username+"'</b> having user id :<b>'"+user_id+"'</b> is successful"+
				"<b><br>Note : The users will be notifed about their restoration to the site</b>";
				bootbox.alert({
					message: restore_success_message,
					title: restore_success_title,
					buttons: {
						ok: {
							label: 'OK GOT IT',
							className: 'btn-primary btn-lg',
						},
					},
					backdrop: false,
					className: 'bb-alternate-modal',
					callback: function (result) {
						// Adjusting the column size(width) after the message popup
				/* Because the column size(width) deformation was observed
			while not writing this
				*/
			$('#deleted_all_users_data_table').DataTable().columns.adjust().draw();
			
		}
	});
			}
		});
				}
			},
		});
	}
	/*DATATABLES DATATABLES DATATABLES DATATABLES DATATABLES DATATABLES DATATABLES DATATABLES DATATABLES DATATABLES DATATABLES DATATABLES DATATABLES DATATABLES DATATABLES DATATABLES DATATABLES DATATABLES  DATATABLES DATATABLES */
	/*DATATABLES DATATABLES DATATABLES DATATABLES DATATABLES DATATABLES DATATABLES DATATABLES DATATABLES DATATABLES DATATABLES DATATABLES DATATABLES DATATABLES DATATABLES DATATABLES DATATABLES DATATABLES  DATATABLES DATATABLES */
	/*Below is the code for making the datatable of the user types in admin/users/user_types*/

// <!-- Page-Level Demo Scripts - Tables - Use for reference -->
jQuery(document).ready(function($) {
	var lower_table = $('#deleted_all_users_data_table').DataTable({
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
		"ajax" : "<?php echo e(URL::to('admin/users/deleted_users/get_deleted_table')); ?>",
		"columns" : [
		{"data" : "s.n"},
		{ "data" : "username"},
		{ "data" : "user_type"},
		{ "data" : "action", orderable:false,searchable:false},
		
		]
		// "dom" : '<"top"i>rt<"bottom"flp><"clear">',
	});
	lower_table.columns.adjust().draw();
		// This is for the auto assigning the serial Number i.e S.N
		lower_table.on( 'order.dt search.dt page.dt', function () {
			lower_table.column(0, {search:'applied', order:'applied',page:'applied'}).nodes().each( function (cell, i) {
				$a = 3;
				// cell.innerHTML = i+1;
			} );
		} ).draw();
	});
	/*-----------------------------------------------------------
	-------------------------------------------------------------
	--------------------------------------------------------------
	--------------------------------------------------------------
	*/
		// The following code is for the search on the top applicable
		// datable initialization, for this there must be a additional 'tr'
		// in 'thead' of lower_table
		// and the id of the additional 'tr' in the thead must be 'filterrow'
		jQuery(document).ready(function($) {
		// Setup - add a text input to each footer cell
		$('.dataTables_scrollHeadInner thead tr#filterrow th').each( function () {
			var title = $('#deleted_all_users_data_table thead th').eq( $(this).index() ).text();
			$(this).html( '<input type="text" class="deleted_users_table" style="width:90%;" onclick="stopPropagation(event);" placeholder="Search '+title+'" />' );
		} );
		// DataTable
		var lower_table = $('#deleted_all_users_data_table').DataTable();
		// Apply the filter
		$(".dataTables_scrollHeadInner thead input").on( 'keyup change', function () {
			lower_table
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
// for this there must be a footer in the html lower_table
/*
$(document).ready(function() {
// Setup - add a text input to each footer cell
$('.dataTables_scrollFootInner tfoot th').each( function () {
var title = $(this).text();
$(this).html( '<input type="text" placeholder="Search '+title+'" />' );
} );

// DataTable
var lower_table = $('#deleted_all_users_data_table').DataTable();

// Apply the search
lower_table.columns().every( function () {
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