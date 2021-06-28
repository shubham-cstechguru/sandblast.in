<div class="container-fluid">
		<div class="">
</div>
<section class="inner-part">

	<div class="row color">
		<div class="col">
			<!-- inner part -->
			<div class="row">
				<div class="col-sm-12">
					<h3  class="pb-2"> Categories</h3>
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
							<select name="search[cat]" id="category" class="form-control">
		                        <option value="">Select Category</option>
								<?php $__currentLoopData = $fcat; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		                            <option <?php if(@$search['cat'] == $cate->category_id ): ?> selected <?php endif; ?> value="<?php echo e($cate->category_id); ?>"><?php echo e($cate->category_name); ?></option>
		                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		                        </select>
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
								<div class="category">
									<h5>Basic Information</h5>
									<div class="divider"></div>
									<div class="form-group">
										<label>Category Name *</label>
										<input type="text" name="record[category_name]" value="<?php echo e(@$edit->category_name); ?>" placeholder="Category Name" class="form-control">
									</div>
									<div class="form-group">
										<label>Parent</label>
										<select name="record[category_parent]" class="form-control">
				                            <option value="ROOT">ROOT</option>
				                            <?php $__currentLoopData = $category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				                            <option <?php echo e(@$edit->category_parent == $cat->category_id ? 'selected' : ""); ?> value="<?php echo e($cat->category_id); ?>"><?php echo e($cat->category_name); ?></option>
				                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				                        </select>
									</div>
								</div>

								<div class="category mt-3">
										<h4>Upload Image</h4>
										<label class="file-upload">
											<img src="<?php echo e(!empty(@$edit->category_image) ? url('imgs/category/'.$edit->category_image) : url('imgs/no-image.png')); ?>">
											<input type="file" name="category_image" accept="image/*" id="category_image">
										</label>
										<label for="category_image" class="btn btn-primary btn-block">Select Image</label>
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
		                                    <th>Image</th>
		                                    <th>Name</th>
		                                    <th>Parent</th>
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
				                                        <input type="checkbox" name="check[]" class="check" value="<?php echo e($rec->category_id); ?>">
				                                        <span></span>
				                                    </label>
												</td>
												<td><?php echo e(++$sn); ?></td>
												<td class="text-center">
													<img style="width: 70px;" src="<?php echo e(url('imgs/category/'.$rec->category_image)); ?>">
												</td>
												<td><?php echo e($rec->category_name); ?></td>
												<td><?php echo e(!empty($rec->parent) ? $rec->parent : 'ROOT'); ?></td>
												<td>
												<a href="<?php echo e(url('rt-admin/category/'.$rec->category_id)); ?>" title="Edit" class="text-success">
				                                        	<i class="icon-pencil"></i>
				                                        </a>&nbsp;		
												<a href="<?php echo e(url('rt-admin/category?status='.$rec->category_is_visible.'&id='.$rec->category_id)); ?>" class="<?php echo e($rec->category_is_visible == 'Y' ? 'text-success': 'text-danger'); ?>">
													<i class="icon-circle"></i>
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
	</div>
<?php /**PATH /home/jodhpursand/public_html/resources/views/backend/inc/category.blade.php ENDPATH**/ ?>