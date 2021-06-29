@extends('layouts.layout')

@section('title','Create New Project')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        
        <div class="col-lg-8">

            @if(Session::has('message'))
                <div class="alert alert-success">
                    {{ Session::get('message') }}
                </div>
            @endif

            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="{{route('projectindex')}}">Index</a></li>
                  <li class="breadcrumb-item" aria-current="page">Project</li>
                </ol>
            </nav>

            <div class="card">
                <div class="card-body">

                    <div class="d-flex justify-content-start">
                        <a href="{{route('projectindex')}}">
                            <i class="mr-3 fas fa-angle-double-left back-fa" aria-hidden="true"></i>
                        </a>
                        <div class="title-2">
                            Create New Project
                        </div>
                    </div>

                    <hr class="mb-3" />

                    <form class="input-form" method="POST" action="/project">
                        @csrf

                        <div class="form-group">
                            <label class="col-form-label" for="title">{{ __('Title') }} <strong class="text-danger">*</strong></label>

                            <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}" required>

                            @error('title')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror

                        </div>
                        <!--.form-group -->

                        <div class="row">

                            <div class="form-group col-md-6">
                                <label class="col-form-label" for="startDate">{{ __('Start Date') }} <strong class="text-danger">*</strong></label>

                                <input id="startDate" type="date" class="form-control @error('startDate') is-invalid @enderror" name="startDate" value="{{ old('startDate') }}" required>

                                @error('startDate')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror

                            </div>
                            <!--.form-group -->

                            <div class="form-group col-md-6">
                                <label class="col-form-label" for="endDate">{{ __('End Date') }} <strong class="text-danger">*</strong></label>

                                <input id="endDate" type="date" class="form-control @error('endDate') is-invalid @enderror" name="endDate" value="{{ old('endDate') }}" required>

                                @error('endDate')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror

                            </div>
                            <!--.form-group -->

                        </div>

                        <div class="row">
                            <div class="form-group col-md-6">
                                    
                                <label class="col-form-label" for="status">{{ __('Status') }} </label>

                                <select class="form-control @error('status') is-invalid @enderror" name="status" id="status">
                                    <option value="" disabled selected hidden>Select Status</option>
                                    <option value="not-started">Not Started</option>
                                    <option value="in-progress">In Progress</option>
                                    <option value="on-hold">On Hold</option>
                                    <option value="cancelled">Cancelled</option>
                                    <option value="completed">Completed</option>
                                </select>
    
                                @error('status')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
    
                            </div>
                            <!--.form-group -->

                            <div class="form-group col-md-6">
                                <label class="col-form-label" for="tag">{{ __('Tag') }}</label>

                                <select class="form-control @error('tag') is-invalid @enderror" name="tag" id="tag">
                                    <option value="" disabled selected hidden>Select Tag</option>
                                    <option value="web-app">Web Application</option>
                                    <option value="mobile-app">Mobile App</option>
                                    <option value="spa">SPA</option>
                                    <option value="illustration">Illustration</option>
                                    <option value="video">Video</option>
                                    <option value="branding">Branding</option>
                                </select>
    
                                @error('tag')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <!--.form-group -->
                        </div>
                        
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label class="col-form-label" for="client_id">{{ __('Client') }} <strong class="text-danger">*</strong></label>

                                <select class="form-control @error('client_id') is-invalid @enderror" name="client_id" id="client_id" required>
                                    <option value="" disabled selected hidden>Select Client</option>
                                    @foreach($clients as $client)
                                    <option value="{{ $client->id }}">{{ $client->company }}</option>
                                    @endforeach
                                    <!--.for-each client_id -->
                                </select>

                                @error('client_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror

                            </div>
                            <!--.form-group -->

                            <div class="form-group col-md-6">
                                <label class="col-form-label" for="estHours">{{ __('Estimated Hours') }}</label>
    
                                <input id="estHours" type="number" class="form-control @error('estHours') is-invalid @enderror" name="estHours" value="{{ old('estHours') }}">
    
                                @error('estHours')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
    
                            </div>
                            <!--.form-group -->
                        </div>

                        <div class="row">
                            <div class="form-group col-md-6">                          
                                <label class="col-form-label" for="billingType">{{ __('Billing Type') }}</label>
                            
                                <select class="form-control @error('billingType') is-invalid @enderror" name="billingType" id="billingType">
                                    <option value="" disabled selected hidden>Select Billing Type</option>
                                    <option value="fixed-rate">Fixed Rate</option>
                                    <option value="project-hours">Project Hours</option>
                                    <option value="task-hours">Task Hours</option>
                                    <!--.for-each billingType -->
                                </select>

                                @error('billingType')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <!--.form-group -->

                            <div class="form-group col-md-6">
                                <label class="col-form-label" for="cost">{{ __('Cost') }}</label>
    
                                <input id="cost" type="text" class="form-control @error('cost') is-invalid @enderror" name="cost" value="{{ old('cost') }}">
    
                                @error('cost')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
    
                            </div>
                            <!--.form-group -->
                        </div>
                       

                        <div class="form-group">
                            <label class="col-form-label" for="description">{{ __('Description') }}</label>

                            <textarea id="description" class="form-control @error('description') is-invalid @enderror" name="description" rows="4" cols="50">
                                {{ old('description') }}
                            </textarea>

                            @error('description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror

                        </div>
                        <!--.form-group -->


                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <button type="submit" class="mt-3 btn btn-submit">
                                {{ __('Save') }}
                            </button>
                        </div>


                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection