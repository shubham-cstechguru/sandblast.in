<section class="inner-part">
	<div class="row color">
		<div class="col">
			<h3 class="pb-2">View Slider</h3>
			<div class="divider"></div>
			<div class="content-part">
				<?php if(\Session::has('success')): ?>
				    <div class="alert alert-success">
					    <?php echo \Session::get('success'); ?></li>
					</div>
				<?php endif; ?>
				<form method="post">
					<?php echo csrf_field(); ?>
					<div class="product">
						<div class="heading">
							<h5><?php echo e($records->count()); ?> record(s) found</h5>
							<?php if(!$records->isEmpty()): ?>
							<a href="" class="icon-trash-o"></a>
							<?php endif; ?>
						</div>
						<div class="divider"></div>
						<?php if(!$records->isEmpty()): ?>
						<div class="table-responsive">
							<table class="table table-bordered table-striped text-center">
								<thead>
									<tr>
										<th>
											<label class="animated-checkbox">
		                                        <input type="checkbox"  class="check_all">
		                                        <span></span>
		                                    </label>
										</th>
										<th>SN.</th>
										<th>Image</th>
										<th>Title</th>
										<th>Actions</th>
									</tr>
								</thead>
								<tbody>
									<?php $sn = 0; ?>
									<?php $__currentLoopData = $records; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rec): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<tr>
										<td>
											<label class="animated-checkbox">
		                                        <input type="checkbox" name="check[]" class="check" value="<?php echo e($rec->slider_id); ?>">
		                                        <span></span>
		                                    </label>
										</td>
										<td><?php echo e(++$sn); ?>.</td>
										<td>
											<img src="<?php echo e(!empty($rec->slider_image) ? url('imgs/sliders/'.$rec->slider_image) : url('imgs/no-image.png')); ?>" style="width: 100px;">
										</td>
										<td><?php echo e($rec->slider_title); ?></td>
										<td>
											<a href="<?php echo e(url('rt-admin/slider/add/'.$rec->slider_id)); ?>" title="Edit" class="text-success">
			                                        	<i class="icon-pencil"></i>
			                                        </a>&nbsp;
											<a href="<?php echo e(url('rt-admin/slider?status='.$rec->slider_is_visible.'&id='.$rec->slider_id)); ?>" class="<?php echo e($rec->slider_is_visible == 'Y' ? 'text-success': 'text-danger'); ?>">
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
</section>
<?php /**PATH /home/jodhpursand/public_html/resources/views/backend/inc/slider.blade.php ENDPATH**/ ?>