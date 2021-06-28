<section class="page-header mb-3">
    <div class="container-fluid">
        <div class="clearfix">
            <div class="float-left">
                <h1>Country</h1>
            </div>
            <ul class="breadcrumb float-right clearfix">
                <li class="breadcrumb-item"><a href="{{ url('service-panel') }}"><i class="icon-dashboard"></i> Dashboard</a></li>
                <li class="breadcrumb-item active">Country</li>
            </ul>
        </div>
    </div>
</section>
<div>
	<div class="card mb-5 mt-5 p-4">
	     <form method="post">
             <button type="submit" class="btn btn-link float-right"> <i class="icon-save"></i> {{ !empty($edit->country_id) ? "Update" : "Save" }} </button>
      		 <h3 class="card-title"> <i class="icon-globe"></i> {{ !empty($edit->country_id) ? "Edit" : "Add" }} Country</h3>
	     	@csrf
		     <div class="row">
                 <div class="col-sm-4">
                      <div class="form-group">
                          <label>Country Name</label>
                          <input type="text" name="record[country_name]" value="{{ @$edit->country_name }}" class="form-control">
                      </div>
		         </div>
                 <div class="col-sm-4">
                     <div class="form-group">
                         <label>Country Short Name</label>
                         <input type="text" name="record[country_short_name]" value="{{ @$edit->country_short_name }}" class="form-control">
                     </div>
                 </div>
                 <div class="col-sm-4">
                     <div class="form-group">
                         <label>Country Code</label>
                         <input type="text" name="record[country_code]" value="{{ @$edit->country_code }}" class="form-control" placeholder="Like +1,+91 etc.">
                     </div>
                 </div>
		     </div>
		 </form>
	</div>

	<div class="card p-4">
        <form method="post">
            @csrf
            <a href="#remove" class="float-right" data-toggle="tooltip" title="Remove Selected"> <i class="icon-trash-o"></i> </a>
    		<h3 class="card-title">
                <div class="mr-auto"><i class="icon-globe"></i> View Country</div>
    		</h3>
		    @if(!$records->isEmpty())
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
			                   <th>Country Code</th>
			                   <th>Country Name</th>
			                   <th>Country Short Name</th>
			                   <th>Action</th>
			               </tr>
			          </thead>

			          <tbody>
			          		@php $sn = $records->firstItem(); @endphp
			          		@foreach($records as $rec)
			               	<tr>
		                        <td>
		                            <label class="animated-checkbox">
		                                <input type="checkbox" name="check[]" value="{{ $rec->country_id  }}" class="check">
		                                <span class="label-text"></span>
		                            </label>
		                        </td>
								<td>{{ $sn++ }}</td>
								<td>{{ $rec->country_code }}</td>
								<td>{{ $rec->country_name }}</td>
								<td>{{ $rec->country_short_name }}</td>
								<td class="icon-cent">
									<a href="{{ url('rt-admin/location/countries/'.$rec->country_id) }}" class="pencil"><i class="icon-pencil" title="Edit"></i></a>
								</td>
			               	</tr>
			               @endforeach
			          </tbody>
			    </table>
			</div>
			{{ $records->links() }}
		    @else
		    <div class="no_records_found">
		      No records found yet.
		    </div>
			@endif
		</form>
	</div>
</div>
