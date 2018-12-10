@extends('customer/layout/customer_layout')
@section('customer_center_content')
<div class="container-fluid"> 
	<div class="row">
		<h2 class="h2 text-muted">Wallet Transistions</h2>
		<hr>
		<table class="table table-bordered">
			@foreach ($wallet as $tr)
			<tr>
				<td>
					<div class="form-control-label" style="font-size: large">Transistion Date</div>
					<div class="form-control-label">{{ $tr->created_at }}</div>
				</td>
				<td>
					<div class="form-control-label" style="font-size: large">Credit</div>
					<div class="form-control-label">{{ Auth::user()->getCurrentCurrencySymbol() }}{{ $tr->getCreditInCurrentCurrency() }}</div>
				</td>
				<td>
					<div class="form-control-label" style="font-size: large">Debit</div>
					<div class="form-control-label">{{ Auth::user()->getCurrentCurrencySymbol() }}{{ $tr->getDebitInCurrentCurrency() }}</div>
				</td>
				<td>
					<div class="form-control-label" style="font-size: large">Amount</div>
					<div class="form-control-label">{{ Auth::user()->getCurrentCurrencySymbol() }}{{ $tr->getAmountInCurrentCurrency() }}</div>
				</td>
				<td>
					<div class="form-control-label" style="font-size: large">Description</div>
					<div class="form-control-label">{{ $tr->description }}</div>
				</td>
			</tr>
			@endforeach
		</table>
		<div>{{ $wallet->links() }}</div>
	</div>
</div>
<hr>
<div class="row m-5">
	<div>
		@if (session("success")!=null&&session("success")!="")
			<div class="alert alert-success">
				<li>{{ session('success') }}</li>
			</div>
		@endif
		@if (count($errors->all())>0)
		<div class="alert alert-danger">
			@foreach ($errors->all() as $error)
			<li>{{ $error }}</li>
			@endforeach
		</div>
		@endif
		<hr>
		<div align="left"><h2 class="h4">Recharge your wallet</h2></div>
		<hr>
		<form action="{{ url('customer/recharge_wallet') }}" method="post">
			@method('post')
			@csrf
			<div class="row" style="margin: 5 px;">				
				<div class="form-group " style="margin: 3 px;">
					<label for="value">Recharge Code  : </label>
					<textarea type="text" name="code" class="form-control" >{{ old('code') }}</textarea>
				</div>
			</div>
			<div>
				<input type="submit" class="btn btn-info btn-lg" value="Recharge">
			</div>
		</form>
	</div>
</div>
@endsection