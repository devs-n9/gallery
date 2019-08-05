@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="grid">
            <div class="grid-item">
                @if(Auth::user()->id == $user_id)
                <button class="img-thumbnail btn-create-gallery" data-toggle="modal" data-target="#photo">
                    <i class="fas fa-plus"></i>
                    New Photo
                </button>
                @endif
            </div>
            @foreach($photos as $photo)
                <div class="grid-item">
                    <img
                        src="{{ url('uploads/' . $photo->image) }}" 
                        alt="{{ $photo->name }}"
                    >
                    <div class="img-info">
                        <h5>{{ $photo->name }}</h5>
                        <p>{{ $photo->description }}</p>
                    </div>
                </div>
            @endforeach
            </div>
        </div>
    </div>
    
    
    
    <!-- Modal -->
    <div class="modal fade" id="photo" tabindex="-1" role="dialog" aria-labelledby="gallery" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">New Photo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" enctype="multipart/form-data" action="{{ route('photo.store') }}">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Name">
                            @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label class="btn btn-primary" for="image">Upload photo</label>
                            <input type="file" name="image" id="image" class="form-control d-none">
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea name="description" class="form-control" placeholder="Description"></textarea>
                        </div>
                        <div class="form-group">
                            <input name="private" type="checkbox" checked>
                            <label> Is private? </label>
                        </div>
                        <input type="hidden" name="gallery_id" value="{{ $gallery }}" >
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button class="btn btn-primary">Save changes</button>
                        
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- EndModal -->
</div>
@endsection