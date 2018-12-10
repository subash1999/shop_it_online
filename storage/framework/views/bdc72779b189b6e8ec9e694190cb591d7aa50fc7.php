<?php $__env->startSection('center_content'); ?>


<div class="col-lg-9 main-chart">
	<!--CUSTOM CHART START -->
	<div class="border-head">
		<h3>USER Product VISITS</h3>
	</div>
	<div class="custom-bar-chart">	
	<?php
			// dd($visits);
		?>	
		<?php $__currentLoopData = $visits; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $visit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		<div class="bar">
			<div class="title mt-2"><?php echo e($visit['date']); ?></div>
			<div class="value tooltips" data-original-title="<?php echo e($visit['clicks']); ?>" data-toggle="tooltip" data-placement="top"><?php echo e($visit['clicks']/$max_visits * 100); ?>%</div>
		</div>
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>		
		
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
						value: <?php echo e($status['available']); ?>,
						color: "#FF6B6B"
					},
					{
						value: <?php echo e($status['sold']); ?>,
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
						<h2><?php echo e(round($status['available']/( $status['sold'] + $status['available']) *100,2)); ?>%</h2>
					</div>
				</div>
			</div>
			<!-- /grey-panel -->
		</div>
		
		<!-- /col-md-4 -->
		
		<!-- /col-md-4 -->
	</div>
	<!-- /row -->
	

	<?php $__env->stopSection(); ?>
	<?php $__env->startSection('pagewise_assets'); ?>
	
	<?php $__env->stopSection(); ?>

<?php echo $__env->make('seller/seller_dashboard/seller_dashboard_layout/seller_dashboard_layout', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>