@extends('layouts.layout')

@section('title','Projects')

@section('content')

<div class="container-fluid">

    <div class="row justify-content-center">
        <div class="col-lg-12 mt-4 mb-5">

            @if(session('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger">
                    <h5>Invalid Excel File</h5>
                    {{ session('error') }}
                </div>
            @endif           

            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3>Projects</h3>


                    <a href="{{route('projectcreate')}}">
                        <button type="button" class="btn btn-new">
                            <i class="fas fa-plus mr-1" aria-hidden="true"></i>
                            {{ __('Add') }}
                        </button>
                    </a>
                    
            </div>

            <div class="card card-table">

                <div class="d-flex justify-content-between mb-4 flex-column flex-lg-row">

                    <form class="input-form mr-lg-2 mr-0 d-flex" action="{{ route('projectindex') }}" method="GET" role="search">
                        @csrf
                        <input type="text" class="form-control" name="searchTerm" placeholder="Search" id="searchTerm">
                        <select class="form-control ml-2" name="status_id" id="status_id">
                            <option value="" disabled selected hidden>--Select status--</option>
                            not started, in progress, on hold, canceled, completed
                            <option value="not-started">Not Started</option>
                            <option value="in-progress">In Progress</option>
                            <option value="on-hold">On Hold</option>
                            <option value="cancelled">Cancelled</option>
                            <option value="completed">Completed</option>
                            <!--.for-each store -->
                        </select>
            
                        <button type="submit" class="btn btn-icon ml-2">
                            <i class="fas fa-search"></i>
                        </button>
                        <a href="{{ route('projectindex') }}">
                            <button type="submit" class="btn btn-icon ml-2">
                                <i class="fas fa-redo"></i>
                            </button>
                        </a>
                    </form>
                    <!-- SEARCH PRODUCT -->
    
                    @can('create', App\Project::class)
                    <form class="input-form mt-2 mt-lg-0" action="{{ route('import') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="d-flex">
                            <div class="custom-file">
                                <input type="file" name="file" class="custom-file-input form-control" id="customFile" required>
                                <label class="custom-file-label form-control" for="customFile">Choose file</label>
                            </div>
                            <button type="submit" class="btn btn-submit btn-control ml-2">
                                <i class="fas fa-upload"></i>
                            </button>
                        </div>
                        
                    </form>
                    @endcan
                    <!-- UPLOAD EXCEL -->
    
                </div>


                <div class="table-responsive">

                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th class="th-sm" scope="col">Actions</th>
                                <th class="th-lg" scope="col">Title</th>
                                <th class="th-sm" scope="col">Duration</th>
                                <th class="th-sm" scope="col">Cost</th>
                                <th class="th-sm" scope="col">Status</th>
                                <th class="th-sm" scope="col">Tags</th>
                                <th class="th-sm" scope="col">Client</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach($projects as $project)

                            <tr>
                                <th scope="row">
                                    <a href="{{route('projectedit',[$project->id])}}" data-toggle="tooltip" data-placement="top" title="Edit">
                                        <i class="fas fa-pen-nib mr-3 table-fa" aria-hidden="true"></i>
                                    </a>
                                </th>

                                <td>
                                    <div class="text-title">{{ $project->title }}</div>
                                    <div class="text-small">
                                        {{ $project->description }}
                                    </div>
                                    
                                </td>
                                <td>
                                    {{ $project->startDate }} to <br> {{ $project->endDate }}
                                    <br>
                                    @if($project->estHours != null)
                                    {{ $project->estHours }} hours
                                    @endif
                                </td>
                                <td>
                                    {{ $project->cost }}
                                </td>
                                <td>
                                    @if($project->status === 'in-progress')
                                    <span class="badge bg-success text-white">IN PROGRESS</span>
                                    @elseif($project->status === 'not-started')
                                    <span class="badge bg-dark text-white">NOT STARTED</span>
                                    @elseif($project->status === 'on-hold')
                                    <span class="badge bg-warning text-white">ON HOLD</span>
                                    @elseif($project->status === 'cancelled')
                                    <span class="badge bg-danger text-white">CANCELLED</span>
                                    @elseif($project->status === 'completed')
                                    <span class="badge bg-secondary text-white">COMPLETED</span>
                                    @endif
                                </td>
                                <td>
                                    <span class="badge bg-light text-faded">
                                        @switch($project->tag)
                                            @case("web-app")
                                                Web App @break
                                            @case("mobile-app")
                                                Mobile App @break
                                            @case("spa")
                                                SPA @break
                                            @case("illustration")
                                                Illustration @break
                                            @case("video")
                                                Video @break
                                            @case("branding")
                                                Branding @break
                                            @default
                                                
                                        @endswitch
                                    </span>
                                </td>
                                <td>
                                    {{ $project->client->company }}
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>

                </div>

            </div>

            <div class="paginator">
                <div>
                    {{ $projects->links() }}
                </div>
            </div>
            {{-- PAGINATION --}}
            
        </div>
        <!-- DISPLAY TABLE end -->

    </div>
</div>
@endsection