<?php
$session_prices = session( 'pro_price' );
?>

<?php if(!empty($session_prices)): ?>
<div class="table-responsive">
    <table class="table table-bordered">
        <tr>
            <th>Qty</th>
            <th>Original Price</th>
            <th>Sale Price</th>
            <th>Remove</th>
        </tr>
        <?php $__currentLoopData = $session_prices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td><?php echo e(@$p['price_qty']); ?> <?php echo e($p['price_unit']); ?></td>
            <td><?php echo e($p['price_original_amount']); ?></td>
            <td><?php echo e($p['price_sale_amount']); ?></td>
            <td><a href="#" data-url="<?php echo e(url('rt-admin/ajax/remove_price')); ?>" data-key="<?php echo e($key); ?>" class="remove_price">Remove</a></td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </table>
</div>
<?php endif; ?>
<?php /**PATH /home4/abrasivegarnet/sandblast.in/resources/views/backend/template/product_prices.blade.php ENDPATH**/ ?>