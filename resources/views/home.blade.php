@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
             <div class="card-header">
                @extends('layouts.errors')
                @extends('layouts.success')
                <ul class="nav nav-tabs nav-tabs-style-4" role="tablist">
                        <li class="nav-item">
                                <a class="nav-link active" href="#hobbies" data-toggle="tab" role="tab">
                                  <i class="fe-icon-home"></i>
                                  &nbsp;My Hobbies
                                </a>
                              </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#add" data-toggle="tab" role="tab">
                        <i class="fe-icon-home"></i>
                        &nbsp;Add Hobby
                      </a>
                    </li>
                  </ul>
             </div>
             <div class="card-body text-center">
                  <div class="tab-content">
                        <div class="tab-pane fade show active" id="hobbies" role="tabpanel">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                  <thead>
                                    <tr class="thead-dark">
                                      <th>#</th>
                                      <th>Hobby</th>
                                      <th class="text-left">Description</th>
                                      <th>Edit</th>
                                      <th>Delete</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    @php 
                                    $count = 0;
                                    @endphp
                                    @foreach ($hobbies as $hobby)
                                    @php
                                       $count++; 
                                    @endphp
                                    <tr>
                                    <th scope="row">{{ $count }}</th>
                                      <td>{{$hobby->name }}</td>
                                    <td class="text-left">{{ $hobby->description }}</td>
                                      <td>

                                          <button class="btn btn-space btn-secondary" data-toggle="modal" data-target="#mod-danger-edit{{$hobby->id}}" type="button">Edit</button>
                                          <div class="modal fade" id="mod-danger-edit{{$hobby->id}}" tabindex="-1" role="dialog">
                                              <div class="modal-dialog">
                                                  <div class="modal-content">
                                                    <div class="modal-header modal-header-colored">
                                                      <h3 class="modal-title">Edit Hobby</h3>
                                                      <button class="close md-close" type="button" data-dismiss="modal" aria-hidden="true"><span class="mdi mdi-close"> </span></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form method="POST" action="{{ url('/hobby/edit') }}">
                                                          @method('PATCH')
                                                          @csrf
                                                          <input type="hidden" name="hobbyId" value="{{$hobby->id}}">
                                                          <div class="form-group">
                                                          <label for="title">Title</label>
                                                          <input type="text" name="title" value="{{$hobby->name}}" class="form-control">
                                                      </div> 
                                                      <div class="form-group">
                                                          <label for="title">Description</label>
                                                      <textarea class="form-control" id="textarea-input" rows="5" name="description" required>{{$hobby->description}}</textarea>
                                                        </div>         
                                                    <div class="modal-footer">
                                                        <button class="btn btn-space btn-secondary" type="submit">Submit</button>
                                                      </div>
                                                    </form>
                                                  </div>
                                                </div>
                                          </div>

                                      </td>
                                      <td>
                                        @php
                                          $id = $hobby->id;
                                          $value = $id;
                                          $warningMessage = "Are you sure you want to delete this hobby?";
                                          $fieldName = 'hobbyid';
                                        @endphp
                                        @include('layouts.delete')
                                      </td>
                                    </tr>
                                    
                                    @endforeach
                                    
                                  </tbody>
                                </table>
                              </div>
                              
                              </div>
                    <div class="tab-pane fade" id="add" role="tabpanel">

                            <form method="POST" action="{{ url('/hobby/create') }}">
                                    @csrf
            
                                    <div class="row form-group">
                                        <label for="title" class="col-md-2 col-form-label text-md-right">{{ __('Title') }}</label>
            
                                        <div class="col-md-10">
                                            <input id="title" type="text" class="form-control @error('name') is-invalid @enderror" name="name" required autocomplete="title" autofocus>
            
                                            @error('title')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
            
                                    <div class="form-group row">
                                            <label class="col-md-2 col-form-label text-md-right" for="textarea-input">Description</label>
                                            <div class="col-md-10">
                                            <textarea class="form-control" id="textarea-input" rows="5" name="description" required></textarea>
                                            @error('description')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror  
                                        </div>
                                    </div>
            
                                    <div class="form-group row mb-0">
                                        <div class="col-md-6 offset-md-4">
                                            <button type="submit" class="btn btn-secondary">
                                                {{ __('Add Hobby') }}
                                            </button>
                                        </div>
                                    </div>
                                </form>
                                  
                    </div>
                  </div>
             </div>

              </div>
        </div>
    </div>
</div>
@endsection