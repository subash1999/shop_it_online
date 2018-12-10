@extends('admin/sb_admin/admin_layouts/admin_layout')

<!-- PUTTING THE CENTER CONTENT OF THE PAGE -->
@section('center-content')	
<div id="page-wrapper">
	<div class="container-fluid">
		<hr>
		<div class="row " style="margin: 5 px;">			
			<div align="center"><h2 class="h2">Wallet Recharges</h2></div>
			<hr>
			<div>
				@if (count($errors->all())>0)
					<div class="alert alert-danger">
						@foreach ($errors->all() as $error)
							<li>{{ $error }}</li>
						@endforeach
					</div>
				@endif
				<div align="left"><h2 class="h4">Add a Recharge Code</h2></div>
				<form action="{{ url('admin/wallet_recharge/add_recharge') }}" method="post">
					@method('post')
					@csrf
					<div class="row" style="margin: 5 px;">
						<div class="form-group " style="margin: 3 px;">
							<label for="curr">Currency : </label>
							<select  name="curr_id" id="curr_id"  class="form-control">
								<option value="" disabled selected >-- Select Currency -- </option>
								@foreach ($curr as $c)
									<option value="{{ $c->curr_id }}">{{ $c->symbol }} {{ $c->country }}</option>
								@endforeach

							</select>
						</div>
						<div class="form-group " style="margin: 3 px;">
							<label for="value">Value (Amount) : </label>
							<input type="text" name="value" class="form-control" value="{{ old('value') }}">
						</div>
					</div>
					<div>
						<input type="submit" class="btn btn-success btn-lg" value="Add">
					</div>
				</form>
			</div>
			<hr>
			<div align="center"><h2 class="h2">Available Recharges</h2></div>
			<hr>
			<table class="table">
				@foreach ($rcs as $rch)
				<tr>
					<td>
						<div class="form-control-label text-muted h6" style="font-size:large; ">RCH ID</div>
						<div class="form-control-label  " style="font-size: large;">{{ $rch->wallet_recharge_id }}</div>
					</td>
					<td>
						<div class="form-control-label text-muted h6" style="font-size:large; ">Value</div>
						<div class="form-control-label  " style="font-size: large;">{{ $curr_symb }} {{ $rch->value }}</div>
					</td>
					<td>
						<div class="form-control-label text-muted h6" style="font-size:large;" >Code</div>
						<textarea class="form-control-label " style="font-size: large;" id="$rch->wallet_recharge_id" disabled>{{ $rch->code }}</textarea>
					</td>
					<td>
						<div style="font-size: x-large;" style="display: none;"><i style="display: none;" class="far fa-clipboard" onclick="clipboard({{ $rch->wallet_recharge_id }})"></i></div>
					</td>
				</tr>
				@endforeach
			</table>
			<div>{{ $rcs->links() }}</div>

		</div>
	</div>
</div>	
@endsection
@section('pagewise_assets')

@endsection