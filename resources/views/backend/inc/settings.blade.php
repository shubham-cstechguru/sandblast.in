<section class="inner-part">
	<div class="row color">
		<div class="col">
			<!-- inner part -->
			<div class="row">
				<div class="col-sm-12">
					<h3  class="pb-2"> Setting</h3>
						<div class="divider"></div>
				</div>
			</div>
			<div class="">
				<form method="post" enctype="multipart/form-data" class="setting">
					@csrf
		        	@foreach($view as $rec)
		            @endforeach

					<div class="row">
							<div class="col-sm-8">
						<div class="settingpart">
							<h3>Basic Information</h3>
							<div class="divider"></div>
							<div class="form-group">
								<label>Site Title *</label>
								<input type="text" name="record[setting_title]" value="{{ $rec->setting_title }}" class="form-control">
							</div>
							<div class="form-group">
								<label>Site Tagline</label>
								<input type="text" name="record[setting_tagline]" value="{{ $rec->setting_tagline }}" placeholder="*Site Tagline" class="form-control">
							</div>
							<div class="form-group">
								<label>Email Address *</label>
								<input type="text" name="record[setting_email]" value="{{ $rec->setting_email }}" placeholder="Email Address" class="form-control">
							</div>
							<div class="form-group">
								<label>Shipping Charge</label>
								<input type="text" name="record[setting_shipping]" value="{{ $rec->setting_shipping }}" class="form-control">
							</div>
							<div class="form-group">
								<label>Footer Sctipt</label>
								<textarea rows="5" name="record[setting_footer]"  placeholder="*Footer Sctipt like Google analytics,Chat Sctipt." class="form-control">{{ $rec->setting_footer }}</textarea>
							</div>
						</div>
						<div class="setting">
						<div class="row">
							<div class="col-sm-12">
								<div class="settingpart">
									<div class="row">
									<div class="col-sm-12">
										<h3>contact Information</h3>
									<div class="divider"></div>
									<div class="form-group">
										<label>Mobile No. *</label>
										<input type="text" name="record[setting_mobile]" maxlength="10" value="{{ $rec->setting_mobile }}" placeholder="Mobile No." class="form-control">
									</div>
									<div class="form-group">
										<label>Whatsapp</label>
										<input type="text" name="record[setting_whatsapp]" maxlength="10" value="{{ $rec->setting_whatsapp }}" placeholder="Whatsapp" class="form-control">
									</div>
									<div class="form-group">
										<label>Email Adderss</label>
										<input type="text" name="record[setting_contact_email]" value="{{ $rec->setting_contact_email }}" placeholder="Email Adderss" class="form-control">
									</div>
									<div class="form-group">
										<label>Google Map</label>
										<input type="text" name="record[setting_google_map]" value="{{ $rec->setting_google_map }}" placeholder="Google Map" class="form-control">
									</div>
									<div class="form-group">
										<label>Adderss</label>
										<textarea rows="5" name="record[setting_address]"  placeholder="Address" class="form-control">{{ $rec->setting_address }}</textarea>
									</div>
									</div>
								</div>
								</div>
							</div>
						</div>
					</div>
						</div>
						<div class="col-sm-4">
							<div class="settingpart">
								<h5>Save & Publish</h5>
								<div class="divider"></div>
								<div class="form-group">
									<button class="btn btn-block btn-primary"><i class="icon-save"></i> Save</button>
								</div>
							</div>


						</div>
					</div>

				</form>

			</div>
		</div>
	</div>
</section>
