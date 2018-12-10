<div>
	<label class="h4">Enter the feature of your product</label>
	<div class="btn-toolbar m-3">
		<button type="button" class="btn btn-round btn-info " id="add_feature_btn" name="add_feature_btn" onclick="add_feature_row()">Add Feature</button>
	</div>
	<table class="table table-bordered table-dark " id="feature_form_table">
	<thead class="thead-default">
		<th width="30%">Feature Name</th>
		<th width="30%">Value</th>
		<th width="20%">Delete</th>
	</thead>
	<tbody>
		@php
		$input_id_num =1;
		@endphp
		<tr name="feature[{{$input_id_num}}]" id="tr_feature_{{$input_id_num}}">
			<td>				
				<input type="text" name="feature[{{$input_id_num}}][name]" id="feature{{$input_id_num}}" class="form-control" autocomplete="off">
			</td>
			<td>				
				<input type="text" name="feature[{{$input_id_num}}][value]" id="feature{{$input_id_num}}_value" class="form-control" autocomplete="off">
			</td>
			<td>
				<span  class="btn btn-round btn-danger" onclick="delete_feature_row({{$input_id_num}})" id="delete_feature_row" name="delete_feature_row">Delete Feature</span>
			</td>
		</tr>
	</tbody>
</table>
</div>

@section('formwise_asset')
<script>
	/*Script for the the feature increment*/
	// Script to add the feature list
	var count = {{++$input_id_num}};
	function add_feature_row(){		
		var table = document.getElementById("feature_form_table");
		var row = table.insertRow();
		row.id = 'tr_feature_'+count;
		row.name = "feature["+count+"]";	
		var cell1 = row.insertCell();
		cell1.innerHTML = '<input type="text" name="feature['+count+'][name]" id="feature'+count+'" class="form-control" autocomplete="off">';
		var cell2 = row.insertCell();
		cell2.innerHTML = '<input type="text" name="feature['+count+'][value]" id="feature'+count+'_value" class="form-control" autocomplete="off">';
		var cell3 = row.insertCell();
		cell3.innerHTML = '<span  class="btn btn-round btn-danger" onclick="delete_feature_row('+count+')" id="delete_feature_row" name="delete_feature_row">Delete Feature</span>';
		count++;

	};
	function delete_feature_row(id){
		var row_id = "tr_feature_"+id;
		$("table#feature_form_table tr#"+row_id).remove();

	}

</script>
@endsection

