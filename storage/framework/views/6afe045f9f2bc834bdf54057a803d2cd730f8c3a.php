<section class="inner-part">
	<h3  class="pb-2">Add Product</h3>
	<div class="divider"></div>
	<?php if(\Session::has('success')): ?>
	    <div class="alert alert-success">
		    <?php echo \Session::get('success'); ?></li>
		</div>
	<?php endif; ?>
	<!-- inner part -->
	<form class="change_pass" method="post" enctype="multipart/form-data">
		<?php echo csrf_field(); ?>
		<div class="row">
			<div class="col-sm-8">
				<div class="content-part">
					<div class="category">
						<label style="font-weight: bold">Basic Information</label>
						<div class="divider mb-3"></div>
						
						<div class="row">
							<div class="col-sm-12">
								<div class="form-group">
									<label>Product Name *</label>
									<input type="text" name="record[product_name]" value="<?php echo e(@$edit->product_name); ?>" placeholder="Name" class="form-control" required>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-12">
								<div class="form-group">
									<label>Product Slug</label>
									<input type="text" name="record[product_slug]" value="<?php echo e(@$edit->product_slug); ?>" placeholder="Product Slug" class="form-control">
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-sm-6">
								<div class="form-group">
									<label >Category</label>
									<select name="record[product_category]"class="form-control mcategory" data-target="#book_subcategory">
			                            <option value="">Select Category</option>
			                            <?php $__currentLoopData = $category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			                            <option value="<?php echo e($cat->category_id); ?>" <?php if(@$edit->product_category == $cat->category_id ): ?> selected <?php endif; ?>><?php echo e($cat->category_name); ?></option>
			                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	                            	</select>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<label>Subcategory</label>
									<select name="record[product_subcategory]" id="book_subcategory" class="form-control">
	                                    <option value="">Subcategory</option>
	                                    <?php $__currentLoopData = $subcategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subcat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	                                    <option value="<?php echo e($subcat->category_id); ?>" <?php if(@$edit->product_subcategory == $subcat->category_id ): ?> selected <?php endif; ?>><?php echo e($subcat->category_name); ?></option>
	                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									</select>
								</div>
							</div>
							<!-- <div class="col-sm-4">
								<div class="form-group">
									<label>Stock *</label>
									<input type="number" name="record[product_stock]" value="<?php echo e(@$edit->product_stock); ?>" min="0" placeholder="Stock" class="form-control" required>
								</div>
							</div> -->
						</div>
					</div>

					<!-- <div class="content-part">
						<div class="category">
							<label style="font-weight: bold">Price</label>
							<div class="divider mb-2"></div>
							<div class="row">
								<div class="col-sm-2">
									<div class="form-group">
										<label>Qty</label>
										<input type="number" name="price[price_qty]" class="form-control price_qty" value="1">
									</div>
								</div>
								<div class="col-sm-2">
									<div class="form-group">
										<label>Unit</label>
										<select class="form-control price_unit" name="price[price_unit]">
											<option value="">Select Unit</option>
											<option value="gm">gm</option>
											<option value="kg">kg</option>
											<option value="ltr">ltr</option>
											<option value="ml">ml</option>
											<option value="pcs">pcs</option>
											<option value="pkt">pkt</option>
										</select>
									</div>
								</div>
								<div class="col-sm-3">
									<div class="form-group">
										<label>Original Price</label>
										<input type="text" name="price[price_original_amount]" value="" class="form-control org_price" >
									</div>
								</div>
								<div class="col-sm-3">
									<div class="form-group">
										<label>Sale Price</label>
										<input type="text" name="price[price_sale_amount]" value="" class="form-control sale_price">
									</div>
								</div>
								<div class="col-sm-2">
									<div class="form-group">
										<label>&nbsp;</label>
										<button type="button" class="btn btn-primary btn-block mt-0 add_price_btn" data-url="<?php echo e(url('ajax/add_product_price')); ?>">Add</button>
									</div>
								</div>
							</div>

							<div id="product_price"> <?php echo $__env->make('backend.template.product_prices', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> </div>
						</div>
					</div> -->

					<div class="content-part">
						<div class="category">
							<div class="form-group">
								<label>Product Description</label>
								<textarea rows="10" name="record[product_description]" placeholder="Description" class="form-control editor"><?php echo e(@$edit->product_description); ?></textarea>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-sm-4">
				<div class="content-part">
					<div class="category form-group">
						<h4>Save & Update</h4>
						<input type="submit" value="<?php echo e(empty($edit->product_id) ? 'Save': 'Update'); ?>" class="form-control btn btn-primary">
					</div>
					<div class="category category-inner">
						<h4>Upload Image</h4>
							<div class="divider"></div>
						<div class="file-upload">

						  <div class="col image-upload-wrap">
				           <label class="file-upload form-group" style="padding: 0px; border: 1px solid #ccc;">
				            <img class="file-upload-image"  src="<?php echo e(!empty($edit->product_image) ? url('imgs/product/'.$edit->product_image) : url('imgs/no-image.png')); ?>">
				            <input type="file" class="file-upload-input" name="product_image" accept="image/*" id="productImage" >
				            </label>
			            </div>
						  <label for="productImage" class="file-upload-btn btn btn-info btn-block">Select Image</label>
						</div>
					</div>
				</div>
				<div class="category category1">
					<h6>Gallery Images (450 x 578 px)</h6>
					<div class="divider"></div>
					<div class="text-center form-group">
						<span class="galleryimages">Add Images</span>
					</div>
					<div class="row" id="gallery_images">
						<?php if(!empty($edit)): ?>
							<?php $__currentLoopData = $gallary; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gall): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<div class="col-3">
								<label class="file-upload form-group addgallary" style="padding: 0px; border: 1px solid #ccc;">
									<a href="#remove_image" data-url="<?php echo e(url('rt-admin/product/add/'.$edit->product_id.'/?remove_id='.$gall->pimage_id)); ?>" class="close" title="Remove">
										<i class="icon-cross"></i>
									</a>
									<img src="<?php echo e(url('imgs/product/'.$id.'/'.$gall->pimage_image_thumb)); ?>">
								</label>
							</div>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>

		<div class="content-part">
			<div class="category">
				<h3>Meta Details</h3>
				<div class="form-group">
					<label>Meta Title</label>
					<input type="text" name="record[product_meta_title]" value="<?php echo e(@$edit->product_meta_title); ?>" class="form-control" required>
				</div>
				<div class="form-group">
					<label>Meta Keywords</label>
					<textarea rows="3" name="record[product_meta_keywords]" class="form-control"><?php echo e(@$edit->product_meta_keywords); ?></textarea>
				</div>
				<div class="form-group">
					<label>Meta Description</label>
					<textarea rows="5" name="record[product_meta_description]" class="form-control"><?php echo e(@$edit->product_meta_description); ?></textarea>
				</div>
			</div>
		</div>
	</form>
</section>
<?php /**PATH /home/jodhpursand/public_html/resources/views/backend/inc/add_product.blade.php ENDPATH**/ ?>