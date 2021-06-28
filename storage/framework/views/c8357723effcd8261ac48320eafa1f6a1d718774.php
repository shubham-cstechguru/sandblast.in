<section class="page-header mb-3">
    <div class="container-fluid">
        <div class="clearfix">
            <div class="float-left">
                <h1>States</h1>
            </div>
            <ul class="breadcrumb float-right clearfix">
                <li class="breadcrumb-item"><a href="<?php echo e(url('service-panel')); ?>"><i class="icon-dashboard"></i> Dashboard</a></li>
                <li class="breadcrumb-item active">States</li>
            </ul>
        </div>
    </div>
</section>
<div>
	<div class="card mb-5 mt-5 p-4">
	     <form method="post">
            <button type="submit" class="btn btn-link float-right"> <i class="icon-save"></i> <?php echo e(!empty($edit->service_id) ? "Update" : "Save"); ?> </button>
     		<h3 class="card-title"><i class="icon-globe"></i> <?php echo e(!empty($edit->state_id) ? "Edit" : "Add"); ?> State</h3>
	     	<?php echo csrf_field(); ?>
		     <div class="row">
                 <div class="col-sm-4">
                     <div class="form-group">
                         <label>Country</label>
                         <select name="record[state_country]" class="form-control">
                         	<option value="">Select Country</option>
                         	<?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $con): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                         	<option value="<?php echo e($con->country_id); ?>" <?php if(!empty($edit->state_country) && $edit->state_country == $con->country_id): ?> selected <?php endif; ?>><?php echo e($con->country_name.' ('.$con->country_short_name.')'); ?></option>
                         	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                         </select>
                     </div>
                 </div>
                 <div class="col-sm-4">
                      <div class="form-group">
                          <label>State Name</label>
                          <input type="text" name="record[state_name]" value="<?php echo e(@$edit->state_name); ?>" class="form-control">
                      </div>
                 </div>

                 <div class="col-sm-4">
                     <div class="form-group">
                         <label>State Short Name</label>
                         <input type="text" name="record[state_short_name]" value="<?php echo e(@$edit->state_short_name); ?>" class="form-control">
                     </div>
                 </div>
		     </div>
		 </form>
	</div>

	<div class="card p-4">
		<form method="post">
            <a href="#remove" class="float-right" data-toggle="tooltip" title="Remove Selected"> <i class="icon-trash-o"></i> </a>
    		<h3 class="card-title">
                <div class="mr-auto"><i class="icon-globe"></i> View States</div>
    		</h3>
	    	<?php echo csrf_field(); ?>
		    <?php if(!$records->isEmpty()): ?>
		    <div class="table-responsive">
			    <table class="table table-bordered">
			          <thead>
			               <tr>
			                    <th style="width: 50px;">
			                        <label class="animated-checkbox">
			                            <input type="checkbox" class="checkall">
			                            <span class="label-text"></span>
			                        </label>
			                    </th>
			                   <th style="width: 50px;">S.No.</th>
			                   <th>Country</th>
			                   <th>State Name</th>
			                   <th>State Short Name</th>
			                   <th>Action</th>
			               </tr>
			          </thead>

			          <tbody>
			          		<?php $sn = $records->firstItem(); ?>
			          		<?php $__currentLoopData = $records; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rec): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			               	<tr>
		                        <td>
		                            <label class="animated-checkbox">
		                                <input type="checkbox" name="check[]" value="<?php echo e($rec->state_id); ?>" class="check">
		                                <span class="label-text"></span>
		                            </label>
		                        </td>
								<td><?php echo e($sn++); ?></td>
								<td><?php echo e($rec->country_name); ?></td>
								<td><?php echo e($rec->state_name); ?></td>
								<td><?php echo e($rec->state_short_name); ?></td>
								<td class="icon-cent">
									<a href="<?php echo e(url('rt-admin/location/states/'.$rec->state_id)); ?>" class="pencil"><i class="icon-pencil" title="Edit"></i></a>
								</td>
			               	</tr>
			               <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			          </tbody>
			    </table>
			</div>
			<?php echo e($records->links()); ?>

		    <?php else: ?>
		    <div class="no_records_found">
		      No records found yet.
		    </div>
			<?php endif; ?>
		</form>
	</div>
</div>
<?php /**PATH C:\xampp\htdocs\sandblast\resources\views/backend/inc/state.blade.php ENDPATH**/ ?>