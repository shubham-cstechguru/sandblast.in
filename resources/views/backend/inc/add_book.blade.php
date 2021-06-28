<div class="">
</div>
<section class="inner-part">
	<div class="row color">
		<div class="col">
			<h3  class="pb-2">Book</h3>
			<div class="divider"></div>
			<div class="content-part">
				<form method="post" enctype="multipart/form-data">
					@csrf
					@if (\Session::has('success'))
							    <div class="alert alert-success">
								    {!! \Session::get('success') !!}</li>
								</div>
							@endif
					<div class="row">
						<div class="col-sm-8">
							<div class="category">
								<h6>Basic Information</h6>
								<div class="divider"></div>
								<div class="row">
									<div class="col-sm-8">
										<div class="form-group">
											<label>Book Name *</label>
											<input type="text"  name="record[book_name]" value="{{ @$edit->book_name }}" class="form-control" placeholder="Book Name" required>
										</div>
									</div>
									<div class="col-sm-4">
										<div class="form-group">
											<label>Edition *</label>
											<input type="text"  name="record[book_edition]" value="{{ @$edit->book_edition }}" class="form-control" placeholder="Edition" required>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-4">
										<div class="form-group">
											<label>Author Name *</label>
											<input type="text"  name="record[book_author]" value="{{ @$edit->book_author }}" class="form-control" placeholder="Author Name" required>
										</div>
									</div>
									<div class="col-sm-4">
										<div class="form-group">
											<label>No of hrs*</label>
											<input type="text"  name="record[book_hrs]" value="{{ @$edit->book_hrs }}" class="form-control" placeholder="Hour" required>
										</div>
									</div>
									<div class="col-sm-4">
										<div class="form-group">
											<label>No of min *</label>
											<input type="text"  name="record[book_min]" value="{{ @$edit->book_min }}" class="form-control" placeholder="Minute" required>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-6">
										<div class="form-group">
											<label >Category</label>
											<select name="record[book_category]"class="form-control mcategory" data-target="#book_subcategory">
					                            <option value="">Select Category</option>
					                            @foreach($category as $cat)
					                            <option value="{{ $cat->category_id }}">{{ $cat->category_name }}</option>
					                            @endforeach
			                            	</select>
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label>Subcategory</label>
											<select name="record[book_subcategory]" id="book_subcategory" class="form-control">
			                                    <option value="">Subcategory</option>
											</select>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-12">
										<div class="form-group">
					                        <label>Book Description</label>
					                        <textarea rows="26" value="" name="record[book_description]" class="form-control editor" placeholder="Book Description">{{ @$edit->book_description }}</textarea>
					                    </div>

									</div>
								</div>
							</div>
							<div class="row">
									<div class="col-sm-12">
										<div class="category category-inner">
								<h6>Other Links</h6>
									<div class="divider"></div>
									<div class="row">
									<div class="col-sm-4">
										<div class="form-group">
											<label>Amazon</label>
											<input type="text"  name="record[book_amazon]" value="{{ @$edit->book_amazon }}" class="form-control" placeholder="Amazone" required>
										</div>
									</div>
									<div class="col-sm-4">
										<div class="form-group">
											<label>Flipkart</label>
											<input type="text"  name="record[book_flipkart]" value="{{ @$edit->book_flipkart }}" class="form-control" placeholder="Flipkart" required>
										</div>
									</div>
									<div class="col-sm-4">
										<div class="form-group">
											<label>Youtube</label>
											<input type="text"  name="record[book_youtube]" value="{{ @$edit->book_youtube }}" class="form-control" placeholder="Youtube" required>
										</div>
									</div>
								</div>
							</div> 
									</div>
								</div>
						</div>
						<div class="col-sm-4">
							<div class="category">
								<h6>{{ empty($edit->book_id) ? 'Save': 'Update' }} & Publish</h6>
									<div class="divider"></div>
									<div class="form-group">
										<button class="btn btn-block btn-primary"><i class="icon-save"></i> {{ empty($edit->book_id) ? 'Save': 'Update' }}</button>
									</div>
							</div> 
							<div class="category category-inner">
								<h6>Mp3 poster image</h6>
									<div class="divider"></div>
								<div class="file-upload">

								  <div class="col image-upload-wrap">
						           <label class="file-upload form-group" style="padding: 0px; border: 1px solid #ccc;">
						            <img class="file-upload-image"  src="{{ empty($edit->book_id) ? url('imgs/no-image.png') : url('imgs/books/'.$edit->book_mp3_poster) }}">
						            <input type="file" class="file-upload-input" name="poster_image" accept="image/*" >
						            </label>
					            </div>
								  <button class="file-upload-btn" type="button" onclick="$('.file-upload-input').trigger( 'click' )">Add Image</button>
								</div>
							</div>
							<div class="category category-inner">
								<h6>Image</h6>
									<div class="divider"></div>
								<div class="file-upload">

								  <div class="col image-upload-wrap">
						           <label class="file-upload form-group" style="padding: 0px; border: 1px solid #ccc;">
						            <img class="file-upload-image"  src="{{ empty($edit->book_id) ? url('imgs/no-image.png') : url('imgs/books/'.$edit->book_image) }}">
						            <input type="file" class="file-upload-input" name="image" accept="image/*" >
						            </label>
					            </div>
								  <button class="file-upload-btn" type="button" onclick="$('.file-upload-input').trigger( 'click' )">Add Image</button>
								</div>
							</div>
							<div class="category category-inner">
								<div class="form-group">
									<h6>PDF</h6>
									<div class="divider"></div>
							      <input type="file" name="pdf" id="file-7" class="inputfile" data-multiple-caption="{count} arquivos selecionados">
							      <label for="file-7"><span class="archive-name">Choose Your File</span><span class="btn-inputfile"> Choose&hellip;</span></label>
							    </div>
							    @if(!empty($edit->book_pdf))
							    <div>
							    	<a href="{{ url('imgs/books/'.$edit->book_pdf) }}" target="_blank">View Pdf</a>
							    </div>
							    @endif
							</div>
							<div class="category category-inner">
								<div class="form-group">
									<h6>Mp3</h6>
									<div class="divider"></div>
							      <input type="file" name="mp3" id="file-8" class="inputfile" data-multiple-caption="{count} arquivos selecionados">
							      <label for="file-8"><span class="archive-name">Choose Your File</span><span class="btn-inputfile"> Choose&hellip;</span></label>
							    </div>
							     @if(!empty($edit->book_mp3))
							    <div>
							    	<a href="{{ url('imgs/books/'.$edit->book_mp3) }}" target="_blank">View mp3</a>
							    </div>
							    @endif
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
</div>
</section>