@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
             <div class="card-header">
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
                    <li class="nav-item">
                      <a class="nav-link" href="#edit" data-toggle="tab" role="tab">
                        <i class="fe-icon-user"></i>
                        &nbsp;Edit Hobbies
                      </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#delete" data-toggle="tab" role="tab">
                          <i class="fe-icon-user"></i>
                          &nbsp;Delete Hobbies
                        </a>
                      </li>
                    
                  </ul>
             </div>
             <div class="card-body text-center">
                  <div class="tab-content">
                        <div class="tab-pane fade show active" id="hobbies" role="tabpanel">
                            <p>hobbies</p>
                              </div>
                    <div class="tab-pane fade" id="add" role="tabpanel">

                            <form method="POST" action="{{ url('/hobby/create') }}">
                                    @csrf
            
                                    <div class="row form-group">
                                        <label for="title" class="col-md-2 col-form-label text-md-right">{{ __('Title') }}</label>
            
                                        <div class="col-md-10">
                                            <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}" required autocomplete="title" autofocus>
            
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
                    <div class="tab-pane fade" id="edit" role="tabpanel">
                        <p>edit</p>
                    </div>
                    <div class="tab-pane fade" id="delete" role="tabpanel">
                        <p>delete</p>
                    </div>
                    
                  </div>
             </div>

              </div>
        </div>
    </div>
</div>
@endsection