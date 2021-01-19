@extends('layouts.admin')

@section('title')
    Edit Page
@endsection

@section('breadcrumbs')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ route('admin.pages.index') }}">Pages</a></li>
        <li class="breadcrumb-item active">Edit</li>
    </ol>
@endsection

@section('content')
    <div class="col-md-12">
        <!-- general form elements -->
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Edit Page</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form role="form" action="{{ route('admin.pages.update', [ 'id' => $page->id ]) }}" method="POST" enctype="multipart/form-data">
                @method("PUT")
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="form-title">Title</label>
                        <input type="text" name="title" class="form-control" id="form-title" placeholder="Enter title" value="{{ $page->title }}">
                    </div>
                    <div class="form-group">
                        <label for="form-image">Image</label>
                        @if ($page->image)
                            <img src="{{ $page->image_url }}" alt="" class="form-image">
                        @endif
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="form-image" name="image" accept="image/*">
                                <label class="custom-file-label" for="form-image">Choose image</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="form-content">Content</label>
                        <textarea name="content" id="form-content" class="form-control" cols="30" rows="10" placeholder="Enter content">{{ $page->content }}</textarea>
                    </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Edit</button>
                </div>
            </form>
        </div>
    </div>
@endsection
