<section class="inner-part">
	<div class="row color">
		<div class="col">
			<h3 class="pb-2">View Orders</h3>
			<div class="divider"></div>
			<div class="content-part">
				<!-- <form>
					<?php echo csrf_field(); ?>
					<div class="product mb-3">
						<div class="row">
							<div class="col-sm-3">
								<label>Order Status</label>
								<select class="form-control" name="search[order_status]">
									<option value="">Order Status</option>
									<option value="processing" <?php if(@$search['order_status'] == "processing"): ?> selected <?php endif; ?>>processing</option>
									<option value="shipped" <?php if(@$search['order_status'] == "shipped"): ?> selected <?php endif; ?>>shipped</option>
									<option value="cancelled" <?php if(@$search['order_status'] == "cancelled"): ?> selected <?php endif; ?>>cancelled</option>
									<option value="refund" <?php if(@$search['order_status'] == "refund"): ?> selected <?php endif; ?>>refund</option>
									<option value="delivered" <?php if(@$search['order_status'] == "delivered"): ?> selected <?php endif; ?>>delivered</option>
								</select>
							</div>
							<div class="col-sm-3">
								<label>Pay Status</label>
								<select class="form-control" name="search[order_is_paid]">
									<option value="">Order Status</option>
									<option value="Y" <?php if(@$search['order_is_paid'] == "Y"): ?> selected <?php endif; ?>>Yes</option>
									<option value="N" <?php if(@$search['order_is_paid'] == "N"): ?> selected <?php endif; ?>>No</option>
								</select>
							</div>
							<div class="col-sm-2">
								<label>&nbsp;</label>
								<button type="submit" class="btn btn-primary btn-block">Search</button>
							</div>
						</div>
					</div>
				</form> -->

				<?php if(\Session::has('success')): ?>
				    <div class="alert alert-success">
					    <?php echo \Session::get('success'); ?></li>
					</div>
				<?php endif; ?>
				<form method="post">
					<?php echo csrf_field(); ?>
					<div class="product">
						<div class="heading d-block">
							<?php if(!$records->isEmpty()): ?>
							<!-- <select name="order_status" class="order_status_change float-right" style="width: 150px;">
								<option value="">Select Status</option>
								<option value="processing">processing</option>
								<option value="shipped">shipped</option>
								<option value="cancelled">cancelled</option>
								<option value="refund">refund</option>
								<option value="delivered">delivered</option>
							</select> -->
							<?php endif; ?>
							<h5><?php echo e($records->total()); ?> record(s) found</h5>
						</div>
						<div class="divider"></div>
						<?php if(!$records->isEmpty()): ?>
						<div class="table-responsive">
							<table class="table table-bordered table-striped text-center">
								<thead>
									<tr>
										<th>
											<label class="animated-checkbox">
												<input type="checkbox" class="check_all">
												<span></span>
											</label>
										</th>
										<th>SN.</th>
										<th>Order Id</th>
										<th>Name</th>
										<th>Mobile</th>
										<th>Email</th>
										<th>Address</th>
										<th>State</th>
										<th>City</th>
									</tr>
								</thead>
								<tbody>
									<?php $sn = $records->firstItem() - 1; ?>
									<?php $__currentLoopData = $records; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rec): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<?php

										$billing  = @unserialize( html_entity_decode( $rec->order_billing ) );
										$shipping = @unserialize( html_entity_decode( $rec->order_shipping ) );

										?>
									<tr>
										<td>
											<label class="animated-checkbox">
												<input type="checkbox" name="check[]" class="check" value="<?php echo e($rec->order_id); ?>">
												<span></span>
											</label>
										</td>
										<td><?php echo e(++$sn); ?>.</td>
										<td><a href="<?php echo e(url('rt-admin/order/single/'.$rec->order_id)); ?>" class=""><?php echo e(sprintf("#BURG%06d",$rec->order_id)); ?></a></td>
										<td><?php echo e($rec->order_name); ?></td>
										<td><?php echo e($rec->order_mobile); ?></td>
										<td><?php echo e($rec->order_email); ?></td>
										<td><?php echo e($rec->order_address); ?></td>
										<td><?php echo e($rec->order_state); ?></td>
										<td><?php echo e($rec->order_city); ?></td>
									</tr>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								</tbody>
							</table>
						</div>
						<?php
							$base_url  = url('rt-admin/orders');
							$get_param = request()->input();
							if(isset($get_param['page'])) {
								unset($get_param['page']);
							}
						?>
						<?php echo e($records->appends($get_param)->links()); ?>

						<?php else: ?>
						<div class="alert alert-warning text-center"> <i class="icon-thumbs-o-down"></i> No records found.</div>
						<?php endif; ?>
					</div>
				</form>
			</div>
		</div>
</div>
</section>
<?php /**PATH /home4/abrasivegarnet/sandblast.in/resources/views/backend/inc/orders.blade.php ENDPATH**/ ?>