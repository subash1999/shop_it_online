{{-- Now making the dashboard center part --}}
@extends('seller/seller_dashboard/seller_dashboard_layout/seller_dashboard_layout')
@section('center_content')
{{-- for a individual content put <section classs="wrapper">//content here</section> --}}

<div class="col-lg-9 main-chart">
	<!--CUSTOM CHART START -->
	<div class="border-head">
		<h3>USER Product VISITS</h3>
	</div>
	<div class="custom-bar-chart">	
	@php
			// dd($visits);
		@endphp	
		@foreach ($visits as $visit)
		<div class="bar">
			<div class="title mt-2">{{ $visit['date'] }}</div>
			<div class="value tooltips" data-original-title="{{ $visit['clicks'] }}" data-toggle="tooltip" data-placement="top">{{ $visit['clicks']/$max_visits * 100}}%</div>
		</div>
		@endforeach		
		
	</div>
	<!--custom chart end-->
	<div class="row mt">
		<!-- SERVER STATUS PANELS -->
		<div class="col-md-4 col-sm-4 mb">
			<div class="grey-panel pn donut-chart">
				<div class="grey-header">
					<h5>Product Available</h5>
				</div>
				<canvas id="serverstatus01" height="120" width="120"></canvas>
				<script>
					var doughnutData = [{
						value: {{ $status['available'] }},
						color: "#FF6B6B"
					},
					{
						value: {{ $status['sold'] }},
						color: "#fdfdfd"
					}
					];
					var myDoughnut = new Chart(document.getElementById("serverstatus01").getContext("2d")).Doughnut(doughnutData);
				</script>
				<div class="row">
					<div class="col-sm-6 col-xs-6 goleft">
						<p><br/>Available</p>
					</div>
					<div class="col-sm-6 col-xs-6">
						<h2>{{ round($status['available']/( $status['sold'] + $status['available']) *100,2) }}%</h2>
					</div>
				</div>
			</div>
			<!-- /grey-panel -->
		</div>
		
		<!-- /col-md-4 -->
		{{-- <div class="col-md-4 col-sm-4 mb">
			<!-- REVENUE PANEL -->
			<div class="green-panel pn">
				<div class="green-header">
					<h5>REVENUE</h5>
				</div>
				<div class="chart mt">
					<div class="sparkline" data-type="line" data-resize="true" data-height="75" data-width="90%" data-line-width="1" data-line-color="#fff" data-spot-color="#fff" data-fill-color="" data-highlight-line-color="#fff" data-spot-radius="4" data-data="[200,135,667,333,526,996,564,123,890,464,655]"></div>
				</div>
				<p class="mt"><b>$ 17,980</b><br/>Month Income</p>
			</div>
		</div> --}}
		<!-- /col-md-4 -->
	</div>
	<!-- /row -->
	

	@endsection
	@section('pagewise_assets')
	{{-- expr --}}
	@endsection
