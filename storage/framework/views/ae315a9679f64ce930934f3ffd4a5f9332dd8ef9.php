<!-- city model -->
<div class="modal fade" id="add_city_post" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle">Add City</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="#" method="post" id="productCityForm">
				<?php echo csrf_field(); ?>
				<div class="modal-body">
					<input type="hidden" value="" id="product_city_id" name="product_id">
					<?php if(!$city->isEmpty()): ?>
					<?php $__currentLoopData = $city; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ct): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<div class="form-check form-check-inline" style="background:#ccc;padding: 10px;">
						<input class="form-check-input sub_chk" name="ids[]" type="checkbox" data-id="<?php echo e($ct->city_id); ?>" value="<?php echo e($ct->city_id); ?>">
						<label class="form-check-label" for="city<?php echo e($ct->city_id); ?>"><?php echo e(@$ct->city_name); ?></label>
					</div>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					<?php endif; ?>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary" id="add_city_to_post">Add City</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- city model end -->
<!-- country model -->
<div class="modal fade" id="add_country_post" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle">Add Country</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="#" method="post" id="productCountryForm">
				<?php echo csrf_field(); ?>
				<div class="modal-body">
					<input type="hidden" value="" id="product_country_id" name="product_id">
					<?php if(!$country->isEmpty()): ?>
					<?php $__currentLoopData = $country; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ct): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<div class="form-check form-check-inline" style="background:#ccc;padding: 10px;">
						<input class="form-check-input sub_chk" name="ids[]" type="checkbox" data-id="<?php echo e($ct->country_id); ?>" value="<?php echo e($ct->country_id); ?>">
						<label class="form-check-label" for="country<?php echo e($ct->country_id); ?>"><?php echo e(@$ct->country_name); ?></label>
					</div>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					<?php endif; ?>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary" id="add_country_to_post">Add Country</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- country model end -->

<section class="inner-part">
	<div class="row color">
		<div class="col">
			<h3 class="pb-2">View Products</h3>
			<div class="divider"></div>
			<div class="content-part">
				<form class="d-flex mb-2" style="width: 32%;">
					<input type="text" name="search" class="form-control" id="exampleInputsearch" value="<?php echo e(request('search')); ?>" placeholder="Search Product">
					<button type="submit" class="btn btn-primary">Search</button>
				</form>
				<?php if(\Session::has('success')): ?>
				<div class="alert alert-success">
					<?php echo \Session::get('success'); ?></li>
				</div>
				<?php endif; ?>
				<form method="post">
					<?php echo csrf_field(); ?>
					<div class="product">
						<div class="heading mb-3">
							<div class="mr-2">
								<h5><?php echo e($records->count()); ?> record(s) found</h5>
							</div>
							<?php if(!$records->isEmpty()): ?>
							<div class="ml-4">
								<a href="" class="icon-trash-o"></a>
							</div>
							<?php endif; ?>
						</div>
						<div class="divider"></div>
						<?php if(!$records->isEmpty()): ?>
						<div class="table-responsive">
							<table class="table table-bordered table-striped">
								<thead>
									<tr>
										<th>
											<label class="animated-checkbox">
												<input type="checkbox" class="check_all">
												<span></span>
											</label>
										</th>
										<th>SN.</th>
										<th>Image</th>
										<th>Item Description</th>
										<th>Location</th>
										<th class="nowrap">Stock Qty</th>
										<th>Actions</th>
									</tr>
								</thead>
								<tbody>
									<?php $sn = $records->firstItem() - 1; ?>
									<?php $__currentLoopData = $records; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rec): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<tr <?php if(!$rec->product_is_read): ?> class="bg-success" <?php endif; ?>>
										<td>
											<label class="animated-checkbox">
												<input type="checkbox" name="check[]" class="check" value="<?php echo e($rec->product_id); ?>">
												<span></span>
											</label>
										</td>
										<td><?php echo e(++$sn); ?>.</td>
										<td>
											<img src="<?php echo e(!empty($rec->product_image) ? url('imgs/product/'.$rec->product_image) : url('imgs/no-image.png')); ?>" style="width: 100px;">
										</td>
										<td class="text-left">
											<a href="<?php echo e(url('rt-admin/product/add/'.$rec->product_id)); ?>" title="Edit" class="text-success nowrap">
												<i class="icon-pencil"></i> <?php echo e($rec->product_name); ?>

											</a>
											<!-- <div class="row">
												<div class="col-4">
													<strong>Code</strong>
												</div>
												<div class="col-8">
													<?php echo e(@$rec->product_code); ?>

												</div>
											</div> -->
											<div class="row">
												<div class="col-4">
													<strong>Category</strong>
												</div>
												<div class="col-8">
													<?php echo e(@$rec->cat->category_name); ?>

												</div>
											</div>
											<div class="row">
												<div class="col-4">
													<strong>Subcategory</strong>
												</div>
												<div class="col-8">
													<?php echo e(@$rec->scat->category_name); ?>

												</div>
											</div>
										</td>
										<td class="nowrap">
											<div class="row">
												<div class="col-6">
													<?php if(empty($rec->product_city)): ?>
													<a class="btn btn-outline-success btn-small" onclick="select_city(<?php echo e($rec->product_id); ?>)">
														Add City
													</a>
													<?php else: ?>
													<?php echo e(@$rec->city->city_name); ?>

													<?php endif; ?>
												</div>
												<div class="col-6">
													<?php if(empty($rec->product_country)): ?>
													<a class="btn btn-outline-success btn-small" onclick="select_country(<?php echo e($rec->product_id); ?>)">
														Add Country
													</a>
													<?php else: ?>
													<?php echo e(@$rec->country->country_name); ?>

													<?php endif; ?>
												</div>
											</div>

										</td>
										<td class="text-center">
											<?php if($rec->product_stock > 0): ?>
											<span class="text-success"><?php echo e($rec->product_stock); ?></span>
											<?php else: ?>
											<span class="text-danger">Out Of Stock</span>
											<?php endif; ?>
										</td>
										<td>
											<a href="<?php echo e(url('rt-admin/product?status='.$rec->product_is_visible.'&id='.$rec->product_id)); ?>" class="<?php echo e($rec->product_is_visible == 'Y' ? 'text-success': 'text-danger'); ?>">
												<i class="icon-circle"></i>
											</a>
										</td>
									</tr>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								</tbody>
							</table>
						</div>
						<?php echo e($records->links()); ?>

						<?php else: ?>
						<div class="alert alert-warning text-center"> <i class="icon-thumbs-o-down"></i> No records found.</div>
						<?php endif; ?>
					</div>
				</form>
			</div>
		</div>
	</div>
</section><?php /**PATH D:\work\asb\web work\sandblast.in\resources\views/backend/inc/product.blade.php ENDPATH**/ ?>