<section class="page-header mb-3">
    <div class="container-fluid">
        <div class="clearfix">
            <div class="float-left">
                <h1>City</h1>
            </div>
            <ul class="breadcrumb float-right clearfix">
                <li class="breadcrumb-item"><a href="{{ url('service-panel') }}"><i class="icon-dashboard"></i> Dashboard</a></li>
                <li class="breadcrumb-item active">Cities</li>
            </ul>
        </div>
    </div>
</section>
<div>
	<div class="card mb-5 mt-5 p-4">
	     <form method="post">
            <button type="submit" class="btn btn-link float-right"> <i class="icon-save"></i> {{ !empty($edit->service_id) ? "Update" : "Save" }} </button>
     		<h3 class="card-title"> <i class="icon-globe"></i> {{ !empty($edit->service_id) ? "Edit" : "Add" }} City</h3>
	     	@csrf
            <div class="row">
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Country</label>
                        <select name="record[city_country]" class="form-control country" data-target="#cityState">
                         	<option value="">Select Country</option>
                         	@foreach($countries as $con)
                         	<option value="{{ $con->country_id }}" @if(!empty($edit->city_country) && $edit->city_country == $con->country_id) selected @endif>{{ $con->country_name.' ('.$con->country_short_name.')' }}</option>
                         	@endforeach
                        </select>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>State</label>
                        <select name="record[city_state]" class="form-control" id="cityState">
                           <option value="">Select State</option>
                           @foreach($states as $st)
                           <option value="{{ $st->state_id }}" @if(!empty($edit->city_state) && $edit->city_state == $st->state_id) selected @endif>{{ $st->state_name.' ('.$st->state_short_name.')' }}</option>
                           @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-sm-3">
                     <div class="form-group">
                         <label>City Name</label>
                         <input type="text" name="record[city_name]" value="{{ @$edit->city_name }}" class="form-control">
                     </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>City Short Name</label>
                        <input type="text" name="record[city_short_name]" value="{{ @$edit->city_short_name }}" class="form-control">
                    </div>
                </div>
            </div>
		 </form>
	</div>

	<div class="card p-4">
		<h3 class="card-title">
			<div class="mr-auto"><i class="icon-globe"></i> View Cities</div>
	        <a href="" class="ml-auto text-white" title="Remove Selected" data-toggle="tooltip">
	            <i class="icon-trash-o"></i>
	        </a>
		</h3>
		<form method="post">
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
			                   <th>Country Name</th>
			                   <th>State Name</th>
			                   <th>City Name</th>
			                   <th>City Short Name</th>
			                   <th>Action</th>
			               </tr>
			          </thead>

			          <tbody>
			          		@php $sn = $records->firstItem(); @endphp
			          		@foreach($records as $rec)
			               	<tr>
		                        <td>
		                            <label class="animated-checkbox">
		                                <input type="checkbox" name="check[]" value="{{ $rec->city_id  }}" class="check">
		                                <span class="label-text"></span>
		                            </label>
		                        </td>
								<td>{{ $sn++ }}</td>
								<td>{{ $rec->country_name }}</td>
								<td>{{ $rec->state_name }}</td>
								<td>{{ $rec->city_name }}</td>
								<td>{{ $rec->city_short_name }}</td>
								<td class="icon-cent">
									<a href="{{ url('rt-admin/location/cities/'.$rec->city_id) }}" class="pencil"><i class="icon-pencil" title="Edit"></i></a>
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
