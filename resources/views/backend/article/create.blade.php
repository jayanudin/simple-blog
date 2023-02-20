@extends('backend.layouts.app')
@section('content')
    <div class="col-md-8">
        <div class="x_panel">
            <div class="x_title">
                <h2>Create Article Form</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <br />
                <form action="{{ route('admin.article.store') }}" method="POST" enctype="multipart/form-data"
                    class="form-horizontal form-label-left">
                    @csrf
                    <div class="form-group row ">
                        <label class="control-label col-md-3 col-sm-3 ">Article Title</label>
                        <div class="col-md-9 col-sm-9 ">
                            <input type="text" class="form-control {{ $errors->has('title') ? 'parsley-error' : '' }}"
                                name="title" placeholder="Title">
                            @if ($errors->has('title'))
                                <ul class="parsley-errors-list filled">
                                    <li class="parsley-required">{{ $errors->first('title') }}</li>
                                </ul>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row ">
                        <label class="control-label col-md-3 col-sm-3 ">Article Thumbnail</label>
                        <div class="col-md-9 col-sm-9 ">
                            <input type="file"
                                class="form-control {{ $errors->has('thumbnail') ? 'parsley-error' : '' }}" onchange="loadFile(event)" name="thumbnail"
                                placeholder="Thumbnail">
                            <img id="thumbnailShowInput" src="" height="100" width="100" alt="">
                            @if ($errors->has('thumbnail'))
                                <ul class="parsley-errors-list filled">
                                    <li class="parsley-required">{{ $errors->first('thumbnail') }}</li>
                                </ul>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row ">
                        <label class="control-label col-md-3 col-sm-3 ">Article Slug</label>
                        <div class="col-md-9 col-sm-9 ">
                            <input type="text" class="form-control {{ $errors->has('slug') ? 'parsley-error' : '' }}"
                                name="slug" placeholder="Slug">
                            @if ($errors->has('slug'))
                                <ul class="parsley-errors-list filled">
                                    <li class="parsley-required">{{ $errors->first('slug') }}</li>
                                </ul>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-md-3 col-sm-3">Content</label>
                        <div class="col-md-9 col-sm-9">
                            <div class="x_content">
                                <textarea id="editor2" name="content" class="{{ $errors->has('content') ? 'parsley-error' : '' }}"></textarea>
                            </div>
                            @if ($errors->has('content'))
                                <ul class="parsley-errors-list filled">
                                    <li class="parsley-required">{{ $errors->first('content') }}</li>
                                </ul>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-md-3 col-sm-3">Status</label>
                        <div class="col-md-9 col-sm-9">
                            <p>
                                Publish:
                                <input type="radio" class="flat" name="status" id="statusPublish" value="1"
                                    checked="" required />
                                Unpublish:
                                <input type="radio" class="flat" name="status" id="statusUnpublish" value="0" />
                            </p>
                            @if ($errors->has('status'))
                                <ul class="parsley-errors-list filled">
                                    <li class="parsley-required">{{ $errors->first('status') }}</li>
                                </ul>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-md-3 col-sm-3">Article Category</label>
                        <div class="col-md-9 col-sm-9">
                            <select name="category_id"
                                class="form-control {{ $errors->has('category_id') ? 'parsley-error' : '' }}">
                                <option value="">Choose option</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('category_id'))
                                <ul class="parsley-errors-list filled">
                                    <li class="parsley-required">{{ $errors->first('category_id') }}</li>
                                </ul>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-md-3 col-sm-3">Article Tags</label>
                        <div class="col-md-9 col-sm-9">
                            <div class="row">
                                @foreach ($tags as $tag)
                                    <div class="col-md-3 col-sm-3">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="tag_id[]" value="{{ $tag->id }}">
                                                {{ $tag->tag_name }}
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
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

@yield('scripts')
<script>
    var loadFile = function(event) {
        var output = document.getElementById('thumbnailShowInput');
        output.src = URL.createObjectURL(event.target.files[0]);
        output.onload = function() {
            URL.revokeObjectURL(output.src) // free memory
        }
    };
</script>
