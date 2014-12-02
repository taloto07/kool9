<div class='container' style='padding-top: 80px' ng-app="searchApp" ng-controller="SearchController as search">
	
	<div class='row'>
		<div class='col-md-12'>
			<div class="alert alert-info" role="alert"><h3>Searching words: {{ Input::get('k') }}</h3></div>
		</div>
	</div>

	<div class='row hide-if-no-javascript'>
		<div class='col-md-3'>
			<div class="form-group form-group-md">
				<div class="input-group">
			      	<input class="form-control" type="text" placeholder="Filter Search Result" ng-model="searchText" ng-change='search.hidePHP()'>
			      	<div class="input-group-addon"><span class="glyphicon glyphicon-search"></span></div>
			    </div>
			</div>
		</div>
		<div class='col-md-3 form-horizontal'>
			<div class="form-group">
				<label for="order" class="col-md-4 control-label">Order By:</label>
				<div class="col-md-8">
					<select class="form-control" id="order" name="order" ng-model="search.orderBy" 
						ng-options="predicate.label for predicate in search.predicates" ng-click="search.hidePHP()">
					</select>
				</div>
			</div>
		</div>
	</div>


	<div class='row hide-if-no-javascript' ng-show='search.filter'>
		<div class='col-xs-6 col-md-3' ng-repeat='video in search.videos | filter:searchText | orderBy: search.orderBy.field: search.orderBy.order'>
			<div class="thumbnail">
				<a href="{{ url('/play/<% video.id %>') }}">
                	<img src="{{ url('<% video.image %>') }}" width='300' height='300' class='img-thumbnail' title="<% video.name %>"/>
                </a>
                <div class="caption">
                    <h5><% video.name.substring(0, 18) %>...</h5>
                    <p>Views: <span class="label label-default"><% video.view %></span><p>
                    <p>Date: <% video.date %></p>
                </div>
			</div>
		</div>
	</div>

	@if ($videos->count())
	<div class='row' ng-hide='search.filter'>
		@foreach( $videos->get() as $video)
			<div class='col-xs-6 col-md-3'>
				<div class="thumbnail">
	                <a href="{{ url("/play/$video->id") }}">
	                	<img src="{{ url("$video->image") }}" width='300' height='300' class='img-thumbnail' title='{{$video->name}}'/>
	                </a>
	              	<div class="caption">
	                    <h5>{{ substr($video->name, 0, 18) }}...</h5>
	                    <p>Views: <span class="label label-default">{{$video->view}}</span><p>
	                    <p>Date: {{$video->date}}</p>
	                </div>
	            </div>
			</div>
		@endforeach
	</div>
	@else
		<div class="alert alert-danger" role="alert">
			<h3>No video found!</h3>
		</div>
	@endif

	
</div>