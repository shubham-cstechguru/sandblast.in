<?php
$cities = \App\Model\CityModel::select('city_slug', 'city_name')->get()->toArray();
?>
<footer class="bg-dark py-4">
  <div class="container">
    <p class="py-2 city_handle">City</p>
    <?php $__currentLoopData = $cities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <a href="city/<?php echo e($c['city_slug']); ?>" class="btn btn-sm btn-outline-light"> <?php echo e($c['city_name']); ?></a>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

  </div>
</footer>
<div class="modal fade" id="enquiryModal" tabindex="-1" role="dialog" aria-labelledby="enquiryModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="enquiryModalLabel">Enquiry Now</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?php echo e(Form::open(['url' => url('ajax/save_order') ,'id' => 'orderForm'])); ?>

      <div class="modal-body">
          <input type="hidden" name="record[order_pid]" id="orderProductId" value="">
          <input type="hidden" name="record[order_qty]" id="orderQty" value="">

          <div class="form-group">
              <label>Name</label>
              <input type="text" name="record[order_name]" value="" class="form-control">
          </div>
          <div class="row">
              <div class="col-sm-6">
                  <div class="form-group">
                      <label>Mobile No.</label>
                      <input type="text" name="record[order_mobile]" value="" class="form-control">
                  </div>
              </div>
              <div class="col-sm-6">
                  <div class="form-group">
                      <label>Email ID</label>
                      <input type="text" name="record[order_email]" value="" class="form-control">
                  </div>
              </div>
          </div>
          <div class="form-group">
              <label>Address</label>
              <textarea name="record[order_address]" rows="3" class="form-control"></textarea>
          </div>
          <div class="row">
              <div class="col-sm-6">
                  <div class="form-group">
                      <label>State</label>
                      <select class="form-control" name="record[order_state]">
                          <option value="">Select State</option>
                          <option value="Rajasthan">Rajasthan</option>
                      </select>
                  </div>
              </div>
              <div class="col-sm-6">
                  <div class="form-group">
                      <label>City</label>
                      <select class="form-control" name="record[order_city]">
                          <option value="">Select City</option>
                          <option value="Jaipur">Jaipur</option>
                          <option value="Jodhpur">Jodhpur</option>
                      </select>
                  </div>
              </div>
          </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
      <?php echo e(Form::close()); ?>

    </div>
  </div>
</div>


<?php echo e(HTML::script('js/jquery.min.js')); ?>

<?php echo e(HTML::script('js/multirange.js')); ?>

<?php echo e(HTML::script('js/popper.min.js')); ?>

<?php echo e(HTML::script('js/bootstrap.min.js')); ?>

<!-- <?php echo e(HTML::script('js/bootstrap-slider.min.js')); ?> -->
<!-- <?php echo e(HTML::script('js/xzoom.min.js')); ?> -->
<?php echo e(HTML::script('js/validation.js')); ?>

<!-- <?php echo e(HTML::script('js/setup.js')); ?> -->
<?php echo e(HTML::script('js/sweetalert.min.js')); ?>

<?php echo e(HTML::script('js/owl.carousel.min.js')); ?>

<?php echo e(HTML::script('js/jquery.fancybox.min.js')); ?>

<?php echo e(HTML::script('js/jquery.lazy.min.js')); ?>

<?php echo e(HTML::script('js/custom.js')); ?>

</body>
</html>
<?php /**PATH C:\xampp\htdocs\sandblast\resources\views/frontend/common/footer.blade.php ENDPATH**/ ?>