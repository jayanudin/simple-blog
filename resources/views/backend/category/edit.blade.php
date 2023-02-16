@extends('backend.layouts.app')
@section('content')
    <div class="col-md-8">
        <div class="x_panel">
            <div class="x_title">
                <h2>Edit Category Form</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <br />
                <form action="{{ route('admin.category.update', $category->id) }}" method="POST" enctype="multipart/form-data"
                    class="form-horizontal form-label-left">
                    @csrf
                    @method('PUT')
                    <div class="form-group row">
                        <label class="control-label col-md-3 col-sm-3">Category Name</label>
                        <div class="col-md-9 col-sm-9">
                            <input type="text" class="form-control {{ $errors->has('name') ? 'parsley-error' : '' }}"
                                placeholder="Category Name" value="{{ old('name', $category->name) }}" name="name">
                            @if ($errors->has('name'))
                                <ul class="parsley-errors-list filled">
                                    <li class="parsley-required">{{ $errors->first('name') }}</li>
                                </ul>
                            @endif
                        </div>

                    </div>
                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-9 col-sm-9 offset-md-3">
                            <button type="submit" class="btn btn-success">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
