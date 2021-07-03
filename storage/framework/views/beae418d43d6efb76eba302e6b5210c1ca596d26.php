<section class="inner-part">
	<h3 class="pb-2">Enquiry Details</h3>
	<div class="divider"></div>
	<?php if(\Session::has('success')): ?>
	<div class="alert alert-success">
		<?php echo \Session::get('success'); ?></li>
	</div>
	<?php endif; ?>
	<!-- inner part -->
	<form method="post">
		<?php echo csrf_field(); ?>
		<div class="product">
			<!-- <div class="divider"></div> -->
			<div style="overflow-x: unset;" class="table-responsive">
				<table class="table table-bordered table-striped ">
					<thead>
						<tr>
							<th colspan="2">Enquiry Info</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>
								<div class="row">
									<div class="col-sm-4">Name<span class="float-right">:</span></div>
									<div class="col-sm-8 overflow"><?php echo e($record->order_name); ?></div>
								</div>
								<div class="row">
									<div class="col-sm-4">Mobile<span class="float-right">:</span></div>
									<div class="col-sm-8 overflow"><?php echo e($record->order_mobile); ?></div>
								</div>
								<div class="row">
									<div class="col-sm-4">Email ID<span class="float-right">:</span></div>
									<div class="col-sm-8 overflow"><?php echo e($record->order_email); ?></div>
								</div>
								<!-- <div class="row">
									<div class="col-sm-4">Address<span class="float-right">:</span></div>
									<div class="col-sm-8 overflow"><?php echo e($record->order_address); ?></div>
								</div>
								<div class="row">
									<div class="col-sm-4">State<span class="float-right">:</span></div>
									<div class="col-sm-4 overflow"><?php echo e($record->order_state); ?></div>
									<div class="col-sm-2">City<span class="float-right">:</span></div>
									<div class="col-sm-2 overflow"><?php echo e($record->order_city); ?></div>
								</div> -->
							</td>
							<td>
								<div class="row">
									<div class="col-sm-4">Enquiry ID<span class="float-right">:</span></div>
									<div class="col-sm-8 overflow">#<?php echo e(sprintf('BURG%06d', $record->order_id)); ?></div>
								</div>
								<div class="row">
									<div class="col-sm-4">Enquiry Date<span class="float-right">:</span></div>
									<div class="col-sm-8 overflow"><?php echo e(date('d / m / Y', strtotime($record->order_created_on))); ?></div>
								</div>
								<div class="row">
									<div class="col-sm-4">Enquiry Status<span class="float-right">:</span></div>
									<div class="col-sm-4 <?php if($record->order_status == 'pending'): ?> text-danger <?php elseif($record->order_status == 'complete'): ?> text-success <?php endif; ?>"><?php echo e($record->order_status); ?></div>
									<div class="col-sm-4"><a href="javascript:void(0)" onclick="changestatus(<?php echo e($record->order_id); ?>)">Change Status</a></div>
								</div>
							</td>
						</tr>
						<tr>
							<td colspan="2">
								<div class="row">
									<div class="col-sm-4">Message<span class="float-right">:</span></div>
									<div class="col-sm-8 overflow"><?php echo e($record->order_enquiry); ?></div>
								</div>
							</td>
						</tr>
					</tbody>
				</table>

				<h5 class="float-left mt-3">Products</h5>
				<table class="table table-bordered table-striped text-center">
					<thead>
						<tr>
							<th>S.No.</th>
							<th>Image</th>
							<th>Item Description</th>
							<!-- <th>Price</th>
							<th>Qty</th>
							<th>Subtotal</th> -->
						</tr>
					</thead>
					<tbody>
						<?php $sn = $grandtotal = $totSubtotal = $totDiscount = 0; ?>
						
						<tr>
							<td><?php echo e(++$sn); ?></td>
							<td>
								<a href="javascript: return void()">
									<img style="width:60px;" src="<?php echo e(url('imgs/product/'.$record->product->product_image_thumb)); ?>">
								</a>
							</td>
							<td>
								<a style="color:black;" href="<?php echo e(url('product/'.$record->product->product_slug)); ?>">
									<?php echo e($record->product->product_name); ?>

								</a>
							</td>
							
						</tr>
					</tbody>
					<tfoot>
						<tr>
							<!-- <th colspan="5">TOTAL</th> -->
							
						</tr>
					</tfoot>
				</table>

			</div>

		</div>
	</form>

	<div class="modal fade" id="changestatusModal" tabindex="-1" aria-labelledby="changestatusModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<form class="" action="" method="POST" id="changestatusFormModal">
				<?php echo csrf_field(); ?>

				<?php echo method_field('DELETE'); ?>
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="changestatusModalLabel">Change Status</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						Are you sure to want to Change the Status ?
					</div>
					<div class="modal-footer">
						<button type="submit" class="btn btn-danger">Confirm</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</section><?php /**PATH D:\work\asb\web work\sandblast.in\resources\views/backend/inc/single_orders.blade.php ENDPATH**/ ?>