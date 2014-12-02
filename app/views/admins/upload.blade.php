<div class='content-form' ng-app='uploadApp' ng-controller='UploadController as upload'>
	<div class='row'>
		<div class='container main'>
			@if(Session::has('global'))
		      <div class="alert alert-warning alert-dismissible" role="alert" style="position:absolute; left:0px; top:50px">
		        <button type="button" class="close" data-dismiss="alert">
		          <span aria-hidden="true">&times;</span>
		          <span class="sr-only">Close</span>
		        </button>
		        <strong>{{ Session::get('global') }}</strong>
		      </div>
		    @endif
			
			<div class='row' ng-show="uploadForm.$dirty && uploadForm.title.$invalid">
				<div class='alert alert-danger col-md-offset-3 col-md-6'>
					<ul>
						<li ng-show='uploadForm.title.$dirty && uploadForm.title.$error.required'>
							<strong>Title is required!</strong>
						</li>
					</ul>
				</div>
			</div>

			<div class='row'>

				<form class="form-horizontal col-md-offset-3 col-md-6" role="form" method="post" action="{{ url("/admin/upload") }}" name='uploadForm'>
					<h2 style='text-align:center'>Upload</h2>
					<hr>	

					<div class='form-group'>
						<label for="country" class="col-sm-2 control-label">Country</label>
					    <div class="col-sm-4">
					      	<select class='form-control' id='country' name='country'>
					      		@foreach($countries as $country)
					      			<option value="{{ $country->id }}">{{ $country->name }}</option>
					      		@endforeach
					      	</select>
					    </div>

					    <label for="category" class="col-sm-2 control-label">Category</label>
					    <div class="col-sm-4">
					      	<select class='form-control' id='category' name='category'>
					      		@foreach($categories as $category)
					      			<option value="{{ $category->id }}">{{ $category->name }}</option>
					      		@endforeach
					      	</select>
					    </div>
					</div>

					<div class="form-group">
					    <label for="title" class="col-sm-2 control-label">Title</label>
					    <div class="col-sm-10">
					      	<input type="text" class="form-control" id="title" placeholder="Title" name="title" ng-model='upload.form.title' required>
					    </div>
				  	</div>

				  	<div class='form-group' ng-repeat='part in upload.form.parts' ng-init='i=$index'>
				  		<label for="part<% i %>" class="col-sm-2 control-label">Part <% i %></label>
				  		<div class="col-sm-10">
				  			<input type="text" class="form-control" id="part<% i %>" placeholder="Part <% i %>" name="parts[]">
				  		</div>
				  	</div>

				  	<div class="form-group">
					    <div class="col-xs-offset-3 col-xs-9 col-sm-offset-2 col-sm-10">
					      	<button type="submit" class="btn btn-default" ng-disabled='uploadForm.$invalid'>Upload</button>
					      	<button type="reset" class="btn btn-default">Reset</button>
					      	<button type="button" class="btn btn-primary" ng-click='upload.addPart()'>Add More Part</button>
					      	<button type="button" class="btn btn-danger" ng-click='upload.removePart()'>Remore Part</button>
					    </div>
				  	</div>
				  	
					{{ Form::token() }}
				</form>
			</div>
		</div>
	</div>
</div>