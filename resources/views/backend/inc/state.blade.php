<section class="page-header mb-3">
    <div class="container-fluid">
        <div class="clearfix">
            <div class="float-left">
                <h1>States</h1>
            </div>
            <ul class="breadcrumb float-right clearfix">
                <li class="breadcrumb-item"><a href="{{ url('service-panel') }}"><i class="icon-dashboard"></i> Dashboard</a></li>
                <li class="breadcrumb-item active">States</li>
            </ul>
        </div>
    </div>
</section>
<div>
	<div class="card mb-5 mt-5 p-4">
	     <form method="post">
            <button type="submit" class="btn btn-link float-right"> <i class="icon-save"></i> {{ !empty($edit->service_id) ? "Update" : "Save" }} </button>
     		<h3 class="card-title"><i class="icon-globe"></i> {{ !empty($edit->state_id) ? "Edit" : "Add" }} State</h3>
	     	@csrf
		     <div class="row">
                 <div class="col-sm-4">
                     <div class="form-group">
                         <label>Country</label>
                         <select name="record[state_country]" class="form-control">
                         	<option value="">Select Country</option>
                         	@foreach($countries as $con)
                         	<option value="{{ $con->country_id }}" @if(!empty($edit->state_country) && $edit->state_country == $con->country_id) selected @endif>{{ $con->country_name.' ('.$con->country_short_name.')' }}</option>
                         	@endforeach
                         </select>
                     </div>
                 </div>
                 <div class="col-sm-4">
                      <div class="form-group">
                          <label>State Name</label>
                          <input type="text" name="record[state_name]" value="{{ @$edit->state_name }}" class="form-control">
                      </div>
                 </div>

                 <div class="col-sm-4">
                     <div class="form-group">
                         <label>State Short Name</label>
                         <input type="text" name="record[state_short_name]" value="{{ @$edit->state_short_name }}" class="form-control">
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
	    	@csrf
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
			                   <th>Country</th>
			                   <th>State Name</th>
			                   <th>State Short Name</th>
			                   <th>Action</th>
			               </tr>
			          </thead>

			          <tbody>
			          		@php $sn = $records->firstItem(); @endphp
			          		@foreach($records as $rec)
			               	<tr>
		                        <td>
		                            <label class="animated-checkbox">
		                                <input type="checkbox" name="check[]" value="{{ $rec->state_id  }}" class="check">
		                                <span class="label-text"></span>
		                            </label>
		                        </td>
								<td>{{ $sn++ }}</td>
								<td>{{ $rec->country_name }}</td>
								<td>{{ $rec->state_name }}</td>
								<td>{{ $rec->state_short_name }}</td>
								<td class="icon-cent">
									<a href="{{ url('rt-admin/location/states/'.$rec->state_id) }}" class="pencil"><i class="icon-pencil" title="Edit"></i></a>
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
