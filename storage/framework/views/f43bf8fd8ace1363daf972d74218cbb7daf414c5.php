<div class="container-fluid">
	<div class="">
	</div>
	<section class="inner-part">

		<div class="row color">
			<div class="col">
				<!-- inner part -->
				<div class="row">
					<div class="col-sm-12">
						<h3 class="pb-2"> Cities</h3>
						<div class="divider"></div>
					</div>
				</div>
				<div class="setting">
					<form>
						<?php echo csrf_field(); ?>
						<div class="row">
							<div class="col-sm-12">
								<form>
									<div class="search-box form-group product">

										<input type="text" value="<?php echo e(@$search['name']); ?>" class="form-control" name="search[name]" placeholder="Search . . .">
										<input type="submit" class="form-control btn btn-primary" name="" value="Search">
									</div>
								</form>
							</div>
						</div>
					</form>
					<div class="row">
						<div class="col-sm-4">
							<form method="post" enctype="multipart/form-data">
								<?php echo csrf_field(); ?>
								<?php if(\Session::has('success')): ?>
								<div class="alert alert-success">
									<?php echo \Session::get('success'); ?>

								</div>
								<?php endif; ?>

								<?php if($errors->any()): ?>
								<div class="alert alert-danger">
									<ul class="list-group">
										<?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<li class="list-group-item text-danger">
											<?php echo e($error); ?>

										</li>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									</ul>
								</div>
								<?php endif; ?>
								<div class="category">
									<h5>Basic Information</h5>
									<div class="divider"></div>
									<div class="form-group">
										<label>City Name *</label>
										<input type="text" name="record[city_name]" value="<?php echo e(@$edit->city_name); ?>" placeholder="City Name" class="form-control">
									</div>

									<div class="form-group">
										<label>City Short Name *</label>
										<input type="text" name="record[city_short_name]" value="<?php echo e(@$edit->city_short_name); ?>" placeholder="City Short Name" class="form-control">
									</div>

								</div>

								<div class="category mt-3">
									<div class="form-group">
										<input type="submit" value=" <?php if(!empty($edit)): ?> Update <?php else: ?> Save <?php endif; ?>" class="form-control btn btn-primary">
									</div>
								</div>
							</form>

						</div>
						<div class="col-sm-8">
							<form method="post" class="">
								<?php echo csrf_field(); ?>
								<div class="category-list">
									<div class="heading">
										<h5><?php echo e($records->count()); ?> record(s) found</h5><a href="" class="icon-trash-o"></a>
									</div>
									<div class="divider"></div>
									<?php if(!$records->isEmpty()): ?>
									<table class="table table-bordered">
										<thead>
											<tr>
												<th>
													<label class="animated-checkbox">
														<input type="checkbox" class="check_all">
														<span></span>
													</label>
												</th>
												<th>SN.</th>
												<th>Name</th>
												<th>Short Name</th>
												<th>Actions</th>
											</tr>
										</thead>
										<tbody>
											<?php
											$sn = 0;
											?>
											<?php $__currentLoopData = $records; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rec): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<tr>
												<td>
													<label class="animated-checkbox">
														<input type="checkbox" name="check[]" class="check" value="<?php echo e($rec->city_id); ?>">
														<span></span>
													</label>
												</td>
												<td><?php echo e(++$sn); ?></td>
												<td><?php echo e($rec->city_name); ?></td>
												<td><?php echo e($rec->city_short_name); ?></td>
												<td>
													<a href="<?php echo e(url('rt-admin/city/'.$rec->city_id)); ?>" title="Edit" class="text-success">
														<i class="icon-pencil"></i>
													</a>
												</td>
											</tr>
											<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
										</tbody>
									</table>
									<?php else: ?>
									<div class="alert alert-danger text-center">
										<i class="icon-thumb_down_alt"></i> No records found.
									</div>
									<?php endif; ?>
									<div><?php echo e($records->links()); ?></div>
								</div>
							</form>
						</div>
					</div>

				</div>
			</div>
		</div>
	</section>
</div><?php /**PATH D:\work\asb\web work\sandblast.in\resources\views/backend/inc/add_city.blade.php ENDPATH**/ ?>