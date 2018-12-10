@php
use App\Category;
function category_print()
{
	$categories = Category::where('parent_cate','=',null)->get();
	foreach ($categories as $category) {
		
		getSubCategory($category->cate_id);
		
	}	
}

function getSubCategory($id)
{
	$category = Category::find($id); 
	$category_name = $category->cate_name;
	if(!hasSubCategory($category->cate_id)){
		$category_name = "<input type='radio' class='radio_btn' name='product_category' value=".$category->cate_name."> ".$category_name."";
	}
	echo("<li data-icon-cls='treeview-icon icon-folder' data-expanded='true'>".$category_name);
	if(hasSubCategory($category->cate_id)){    
		$sub_categories = Category::where('parent_cate','=',$category->cate_id)->get();
		echo "<ul>";
		foreach ($sub_categories as $key => $sub_category) {
			getSubCategory($sub_category->cate_id);        
		}       
		echo "</ul>";
	}   
	echo("</li>");

}
function hasSubCategory($id)
{
	$category = Category::where('parent_cate','=',$id)->count();
	if($category>0){
		return true;
	}        
	else{
		return false;
	}
}
@endphp
<div class="border" style="padding: 15px;margin: 5px;">
	<label class="h4">Please check one of the category/sub-category form below tree</label>
	<br>
	<label class="form-control-label text-primary">If you cannot find the proper/fitting category for your product, you have to request to admin for the category.</label><span class="badge badge-pill badge-primary label-info font-weight-bold" style="background-color:indigo;"><a href="javascript:void(0)" style="color:white;">Click Here</a></span> to request for new category
	<div class="form-group" >
		<label class="form-control-label"><label class="label text-danger" ">*</label>Selected Category/Sub-Category </label>
		<input type="text" name="selected_category" id="selected_category" class="form-control" value="" required readonly>
	</div>
	<div class="form-group theme-light">
		<div>
			<ul class="tree_view" id="category_tree_view">
				@php
				category_print();
				@endphp
			</ul>
		</div>
		
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function() {
		var category_radios = $("ul li input:radio[name='product_category']");
		category_radios.change(function () {
				var checked = category_radios.filter(':checked');
				var selected_cate_input=$("input[name='selected_category']#selected_category");
				if(checked!=null){
					selected_cate_input.val(checked.val());
				}
				else{
					selected_cate_input.val(null);
				}
		});

	});

</script>
