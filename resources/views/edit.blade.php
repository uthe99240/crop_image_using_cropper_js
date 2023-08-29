@extends('layout')

@section('content')

<div class="container mt-5">
    <h2>Edit Image Details</h2>
    <form method="POST" action="{{ route('form.update', $image->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $image->name) }}" required>
        </div>
        <div class="form-group">
            <label for="file">Image:</label>
            <img src="{{ asset($image ? $image->path : 'https://upload.wikimedia.org/wikipedia/commons/a/ac/No_image_available.svg') }}"
                                    style="height: 150px; margin-bottom:10px;" id="cover_path">
            <input type="hidden" name="cropped_image_data" id="cropped_image_data" value="{{asset($image ? $image->path : null)}}">
            <input type="file" class="form-control-file image" id="file" name="file" accept="image/*">
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalLabel">Crop image before upload image</h5>
                            <button type="button" class="close modal_cancal" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="img-container">
                                <div class="row">
                                    <div class="col-md-8">
                                        <img id="image" src="https://avatars0.githubusercontent.com/u/3456749">
                                    </div>
                                    <div class="col-md-4">
                                        <div class="preview"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary modal_cancal"
                                style="padding: 5px 10px; border-radius:5px" data-dismiss="modal">Cancel</button>
                            <button type="button" class="btn btn-primary" style="padding: 5px 10px; border-radius:5px"
                                id="crop">Crop</button>
                        </div>
                    </div>
                </div>
            </div>
    </form>
</div>

@endsection