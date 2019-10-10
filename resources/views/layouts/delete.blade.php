<button class="btn btn-space btn-danger" data-toggle="modal" data-target="#mod-danger{{$id}}" type="button">Delete</button>
<div class="modal fade" id="mod-danger{{$id}}" tabindex="-1" role="dialog">
<div class="modal-dialog">
<div class="modal-content">
  <div class="modal-header">
    <button class="close" type="button" data-dismiss="modal" aria-hidden="true"><span class="mdi mdi-close"></span></button>
  </div>
  <div class="modal-body">
    <div class="text-center">
      <div class="text-danger"><span class="modal-main-icon mdi mdi-close-circle-o"></span></div>
      <h3>Danger!</h3>
      <p>{{ $warningMessage }}</p>
      <div class="row">
        <div class="col-md-6 form-group text-right">
            <button class="btn btn-space btn-secondary" type="button" data-dismiss="modal">Cancel</button>
        </div>
        <div class="col-md-6 form-group text-left">
        <form method="DELETE" action="{{ url('/hobby/delete') }}">
          @csrf
        <input type="hidden" name="{{$fieldName}}" value="{{$value}}">
          <button class="btn btn-space btn-danger" type="submit">DELETE</button>
        </form>
        </div>
      </div>
    </div>
  </div>
  <div class="modal-footer"></div>
</div>
</div>
</div>