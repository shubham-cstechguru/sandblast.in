		</div>
		</div>
	</div>
</div>
		<?php echo e(HTML::script('js/jquery.min.js')); ?>

		<?php echo e(HTML::script('js/popper.min.js')); ?>

	    <?php echo e(HTML::script('js/bootstrap.min.js')); ?>

	    <?php echo e(HTML::script('js/sweetalert.min.js')); ?>

	    <?php echo e(HTML::script('js/validation.js')); ?>

		<?php echo e(HTML::script('admin/js/jquery.multiselect.js')); ?>

	    <?php echo e(HTML::script('admin/js/jquery.multiselect.js')); ?>

	    <?php echo e(HTML::script('admin/tinymce/js/tinymce/tinymce.min.js')); ?>

	    <?php echo e(HTML::script('admin/js/main.js')); ?>


	    <script type="text/javascript">
	    	$(function() {
	    		$('select[multiple].active.3col').multiselect({
		            columns: 1,
		            placeholder: 'Select Courses',
		            search: true,
		            searchOptions: {
		                'default': 'Search Courses'
		            },
		            selectAll: true
		        });

		        $('select[multiple].active.color').multiselect({
		            columns: 1,
		            placeholder: 'Select Color',
		            search: true,
		            searchOptions: {
		                'default': 'Search Color'
		            },
		            selectAll: true
		        });

				$('select[multiple].active.product').multiselect({
		            columns: 1,
		            placeholder: 'Select Products',
		            search: true,
		            searchOptions: {
		                'default': 'Search Products'
		            },
		            selectAll: true
		        });

		        $('select[multiple].active.age').multiselect({
		            columns: 1,
		            placeholder: 'Select Age',
		            search: true,
		            searchOptions: {
		                'default': 'Search Age'
		            },
		            selectAll: true
		        });
	    	});

				function select_city(id){
						  console.log(id);
							$("#product_id").val(id);
						 $('#add_city_post').modal();
				}
	    </script>
<script type="text/javascript">
$(document).ready(function() {
	$(document).on('submit', '#productCityForm', function(e) {
		e.preventDefault();
		var form = $(this),
				token = $('[name=csrf-token]').attr('content');

		$.ajax({
			url: 'product-city',
			headers:token,
			type: 'POST',
			data: form.serialize(),
			success: function(res) {
				     window.location.reload();  
			}
		});
	});
});

</script>
	</body>
</html>
<?php /**PATH C:\xampp\htdocs\sandblast\resources\views/backend/common/footer.blade.php ENDPATH**/ ?>