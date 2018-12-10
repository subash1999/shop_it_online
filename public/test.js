
	$.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
	function myfunction(){
		jQuery.ajax({
		// {{-- // url: '{{ URL::to("/admin/users/user_types/'+ut_id+')', --}}
		// type: 'GET',
		url : window.url,

		method: 'Put',
		data: {
			id: "apple",
			type :"afda",
			        			
		},
		error: function(jqXHR, textStatus, errorThrown) { // What to do if we fail
			console.log(JSON.stringify(jqXHR));
			console.log("AJAX error: " + textStatus + ' : ' + errorThrown+" : ");
			window.alert("Error occured");
		},
		success:function (result) {
			window.alert("Successful operation");
		}
		});
	}
	// function myfunction(){
	// 	window.alert("apple");
	// }
