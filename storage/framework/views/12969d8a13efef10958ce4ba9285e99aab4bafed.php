<div class="modal fade" id="changestatusModal" tabindex="-1" aria-labelledby="changestatusModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<form class="" action="" method="POST" id="changestatusFormModal">
			<?php echo csrf_field(); ?>

			<?php echo method_field('DELETE'); ?>
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="changestatusModalLabel">Change Status</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					Are you sure to want to Change the Status ?
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-danger">Confirm</button>
				</div>
			</div>
		</form>
	</div>
</div>
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

	function select_city(id) {
		$("#product_city_id").val(id);
		$('#add_city_post').modal();
	}

	function select_country(id) {
		$("#product_country_id").val(id);
		$('#add_country_post').modal();
	}

	function changestatus(id) {
		var form = document.getElementById('changestatusFormModal')
		form.action = '/rt-admin/order/single/' + id + '/change-staus'
		$('#changestatusModal').modal('show')
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
				headers: token,
				type: 'POST',
				data: form.serialize(),
				success: function(res) {
					window.location.reload();
				}
			});
		});
	});

	$(document).ready(function() {
		$(document).on('submit', '#productCountryForm', function(e) {
			e.preventDefault();
			var form = $(this),
				token = $('[name=csrf-token]').attr('content');

			$.ajax({
				url: 'product-country',
				headers: token,
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

</html><?php /**PATH D:\work\asb\web work\sandblast.in\resources\views/backend/common/footer.blade.php ENDPATH**/ ?>