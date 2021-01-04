@extends('setting.layout.app')
@section('content')
<div class="content">
    @include('setting.layout.message')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-tasks" style="min-height: 800px !important">
                <div class="card-header ">
                    <h6 class="title d-inline">Channel</h6>
                    <p class="card-category d-inline"></p>
                    <div class="dropdown">
                        <button type="button" class="btn btn-link dropdown-toggle btn-icon" data-toggle="dropdown">
                            <i class="tim-icons icon-settings-gear-63"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                            <button type="button" class="dropdown-item" data-toggle="modal" data-target=".add-new">Add
                                New</button>
                        </div>
                    </div>
                </div>
                <div class="modal fade add-new" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content card">
                            <form class="card-body" action="{{route('channel.store')}}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div style="margin: 20px !important">
                                    <div class="row">
                                        <div class="col-md-12 px-md-1">
                                            <div class="form-group">
                                                <label>Channel Title</label>
                                                <input type="text" class="form-control" placeholder="Channel Title"
                                                    value="{{old('title')}}" name="title">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 px-md-1">
                                            <div class="form-group">
                                                <label>Channel Subtitle</label>
                                                <input type="text" class="form-control" placeholder="Channel Subtitle"
                                                    value="{{old('subtitle')}}" name="subtitle">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 px-md-1">
                                            <div class="form-group">
                                                <label>Channel Link</label>
                                                <input type="text" class="form-control" placeholder="Channel Link"
                                                    value="{{old('link')}}" name="link">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 px-md-1">
                                            <div class="form-group">
                                                <label>Channel Star</label>
                                                <input type="number" class="form-control" placeholder="Channel Star"
                                                    max="5" min="1" value="{{old('star') ?? 1}}" name="star">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 px-md-1">
                                            <div class="form-group">
                                                <label>Channel Category</label>
                                                <select class="custom-select" style="color: white" name="category"
                                                    id="app-platform">
                                                    <option style="color: black" selected disabled>Category</option>
                                                    @foreach ($category as $item)
                                                    <option style="color: black" value="{{$item->id}}">
                                                        {{$item->ct_name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-12">
                                            <input type="file" id="actual-upload" onchange="readURL(this);" name="imgs"
                                                style="display: none">
                                            <div class="pull-right" id="upload"
                                                style="height: 200px;width: 200px;background-image: url({{ asset('image.png') }});background-size: contain;background-repeat: no-repeat;">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="form-check">
                                                    <label class="form-check-label">Active
                                                        <input class="form-check-input" type="checkbox" name="state"
                                                            {{is_null(old('state')) ? '' : 'checked' }}>
                                                        <span class="form-check-sign">
                                                            <span class="check"></span>
                                                        </span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-fill btn-primary float-right">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="card-body ">
                    <div class="table-full-width table-responsive" style="min-height: 700px !important">
                        <table class="table" id="table">
                            <tbody>
                                @foreach ($data as $key=>$value)
                                <tr id="tr-{{$value->id}}">
                                    <td>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input class="form-check-input"
                                                    onchange="stateChannel(this,'{{route('channel.edit',$value->id)}}')"
                                                    type="checkbox" {{$value->ch_state ? "checked" : ''}} value="">
                                                <span class="form-check-sign">
                                                    <span class="check"></span>
                                                </span>
                                            </label>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="title">{{$value->ch_title}}</p>
                                        @for ($i = 0; $i < $value->ch_star; $i++)
                                            <i class="tim-icons icon-shape-star" style="color: gold !important"></i>
                                            @endfor
                                    </td>
                                    <td>
                                        <a href="{{$value->ch_link}}">
                                            <p class="title">{{$value->ch_link}}</p>
                                        </a>
                                    </td>
                                    <td>
                                        <a
                                            href="{{is_null($value->ch_image)? asset('image.png'):asset('storage/'.$value->ch_image) }}"><img
                                                src="{{is_null($value->ch_image)? asset('image.png'):asset('storage/'.$value->ch_image) }}"
                                                alt="" height="80px" width="80px"></a>
                                    </td>
                                    <td class="td-actions text-right">
                                        <button type="button" rel="tooltip" title="" class="btn btn-link"
                                            data-toggle="modal" data-target=".add-updated-{{$value->id}}"
                                            data-original-title="Edit Task">
                                            <i class="tim-icons icon-pencil"></i>
                                        </button>
                                        <button type="button" rel="tooltip" title=""
                                            onclick="deleteChannel(this,'{{route('channel.destroy',$value->id)}}')"
                                            class="btn btn-link" data-original-title="Edit Task">
                                            <i class="tim-icons icon-trash-simple"></i>
                                        </button>
                                    </td>
                                </tr>
                                <div class="modal fade add-updated-{{$value->id}}" tabindex="-1" role="dialog"
                                    aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content card">
                                            <form class="card-body" method="POST" enctype="multipart/form-data"
                                                action="{{route('channel.update',$value->id)}}">
                                                @method("PUT")
                                                @csrf
                                                <div style="margin: 20px !important">
                                                    <div class="row">
                                                        <div class="col-md-12 px-md-1">
                                                            <div class="form-group">
                                                                <label>Channel Title</label>
                                                                <input type="text" class="form-control"
                                                                    placeholder="Channel Title"
                                                                    value="{{$value->ch_title}}" name="title">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12 px-md-1">
                                                            <div class="form-group">
                                                                <label>Channel Subtitle</label>
                                                                <input type="text" class="form-control"
                                                                    placeholder="Channel Subtitle"
                                                                    value="{{$value->ch_subtitle}}" name="subtitle">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12 px-md-1">
                                                            <div class="form-group">
                                                                <label>Channel Link</label>
                                                                <input type="text" class="form-control"
                                                                    placeholder="Channel Link"
                                                                    value="{{$value->ch_link}}" name="link">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12 px-md-1">
                                                            <div class="form-group">
                                                                <label>Channel Star</label>
                                                                <input type="text" class="form-control" min="1" max="5"
                                                                    placeholder="Channel Star"
                                                                    value="{{$value->ch_star}}" name="star">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12 px-md-1">
                                                            <div class="form-group">
                                                                <label>Cahnnel Category</label>
                                                                <select class="custom-select" style="color: white"
                                                                    name="category" id="app-platform">
                                                                    <option style="color: black" disabled>
                                                                        Category</option>
                                                                    @foreach ($category as $item)
                                                                    <option {{ $item->id == $value->ch_category ? 'selected':''}} style="color: black" value="{{$item->id}}">
                                                                        {{$item->ct_name}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-2 col-form-label">Picture</label>
                                                        <div class="col-sm-10">
                                                            <input type="file" id="actual-upload-{{$value->id}}"
                                                                onchange="readURLS(this,{{$value->id}});" name="imgs"
                                                                style="display: none">
                                                            <div class="pull-right" id="upload-{{$value->id}}"
                                                                onclick="clickFileChooser({{$value->id}})"
                                                                style="height: 200px;width: 200px;background-image: url({{is_null($value->ch_image)? asset('image.png'):asset('storage/'.$value->ch_image)}});background-size: contain;background-repeat: no-repeat;">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <div class="form-check">
                                                                    <label class="form-check-label">Active
                                                                        <input class="form-check-input" type="checkbox"
                                                                            {{$value->ch_state ? 'checked': ''}}
                                                                            name="state">
                                                                        <span class="form-check-sign">
                                                                            <span class="check"></span>
                                                                        </span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-footer">
                                                    <button type="submit" class="btn btn-fill btn-primary float-right"
                                                        onclick="updateApp('{{$value->id}}','{{route('app.update',$value->id)}}')">Change</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </tbody>

                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    document.getElementById('upload').onclick = function() {
    document.getElementById('actual-upload').click();
};
    function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#upload').css("background-image", "url("+ e.target.result + ")");
        };
        reader.readAsDataURL(input.files[0]);
    }else{
            $('#upload').css("background-image", "url({{asset('assets/images/logo.png') }})");
        reader.readAsDataURL(null);
    }
}
function clickFileChooser(id) {
    document.getElementById('actual-upload-'+id).click();
}
function readURLS(input,id) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#upload-'+id).css("background-image", "url("+ e.target.result + ")");
        };
        reader.readAsDataURL(input.files[0]);
    }else{
            $('#upload'+id).css("background-image", "url({{asset('assets/images/logo.png') }})");
        reader.readAsDataURL(null);
    }
}
</script>
<script src="{{asset('assets/requests/channel.js')}}"></script>
@endsection