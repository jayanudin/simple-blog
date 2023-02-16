@extends('backend.layouts.app')
@section('content')
    <div class="col-md-8">
        <div class="x_panel">
            <div class="x_title">
                <h2>Create Tag Form</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <br />
                <form action="{{ route('admin.tag.store') }}" method="POST" enctype="multipart/form-data"
                    class="form-horizontal form-label-left">
                    @csrf
                    <div class="form-group row">
                        <label class="control-label col-md-3 col-sm-3">Tag Name</label>
                        <div class="col-md-9 col-sm-9">
                            <input type="text" class="form-control {{ $errors->has('tag_name') ? 'parsley-error' : '' }}"
                                placeholder="Tag Name" name="tag_name">
                            @if ($errors->has('tag_name'))
                                <ul class="parsley-errors-list filled">
                                    <li class="parsley-required">{{ $errors->first('tag_name') }}</li>
                                </ul>
                            @endif
                        </div>

                    </div>
                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-9 col-sm-9 offset-md-3">
                            <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
