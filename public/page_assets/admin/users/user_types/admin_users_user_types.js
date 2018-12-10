// {{-- Function for processing the edit of user type --}}
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
    '<input type="hidden" name="_token" value="{{ csrf_token() }}">',
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
      closeButton: false
    });
    jQuery.ajax({
        url : update_url,
        // url : 'admin/users/user_types/'.ut_id,
        method: 'PUT',
        data: {
          id: ut_id,
          type :  $('#user_type').val(),

        },
        error: function(jqXHR, textStatus, errorThrown) { // What to do if we fail
          console.log(JSON.stringify(jqXHR));
          console.log("AJAX error: " + textStatus + ' : ' + errorThrown+" : "+data);
          // Refreshing the datatable after the data update is fail, to see if there
          // is any kind of error
          $('#user_type_data_table').DataTable().ajax.reload(null, false);

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
function userTypeDeleteConfirm(ut_id,user_type,update_url){
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

    },
  });
}
