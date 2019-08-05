@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            @if(Route::current()->getName() != 'user.gallery')
            <button class="img-thumbnail btn-create-gallery" data-toggle="modal" data-target="#gallery">
                <i class="fas fa-plus"></i>
                New Gallery
            </button>
            @endif
            @foreach($gallery as $g)
                <a href="{{ route('gallery.show', $g->id) }}">
                    <img 
                        class="img-thumbnail btn-create-gallery" 
                        src="{{ url('uploads/' . $g->preview) }}" 
                        alt="{{ $g->title }}"
                    >
                </a>
            @endforeach
        </div>
    </div>
    
    
    
    <!-- Modal -->
    <div class="modal fade" id="gallery" tabindex="-1" role="dialog" aria-labelledby="gallery" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">New Gallery</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" enctype="multipart/form-data" action="{{ route('gallery.store') }}">
                        <div class="form-group">
                            <label>Title</label>
                            <input type="text" name="title" class="form-control" placeholder="Title">
                            @error('title')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label class="btn btn-primary" for="preview">Upload preview</label>
                            <input type="file" name="preview" id="preview" class="form-control d-none">
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea name="description" class="form-control" placeholder="Description"></textarea>
                        </div>
                        <div class="form-group">
                            <input name="private" type="checkbox" checked>
                            <label> Is private? </label>
                        </div>
                        
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
