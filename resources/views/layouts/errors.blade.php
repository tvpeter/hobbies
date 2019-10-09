@if(count($errors))
		<div class="form-group">
		<div class="text-danger">
			<ul style="list-style: none !important;">
				@foreach($errors->all() as $error)
				<li>
					  <div class="alert alert-danger alert-icon alert-dismissible" role="alert">
                    <div class="icon"><span class="mdi mdi-close-circle-o"></span></div>
                    <div class="message">
                      <button class="close" type="button" data-dismiss="alert" aria-label="Close"><span class="mdi mdi-close" aria-hidden="true"></span></button><strong>Error:</strong>  {{ $error }}
                    </div>
                  </div>
				</li>
				@endforeach
			</ul>
		</div>
		</div>
	@endif