@extends('setting.layout.app')
@section('content')
<div class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-tasks" style="min-height: 800px !important">
                <div class="card-header ">
                    <h6 class="title d-inline">Application</h6>
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
                            <div class="card-body">
                                <div style="margin: 20px !important">
                                    <div class="row">
                                        <div class="col-md-12 px-md-1">
                                            <div class="form-group">
                                                <label>Application Name</label>
                                                <input type="text" class="form-control" placeholder="Application Name"
                                                    value="" id="app-name">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 px-md-1">
                                            <div class="form-group">
                                                <label>Application Access</label>
                                                <input type="text" class="form-control" placeholder="Application Access"
                                                    value="" id="app-access">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 px-md-1">
                                            <div class="form-group">
                                                <label>Application Secret</label>
                                                <input type="text" class="form-control" placeholder="Application Secret"
                                                    value="" id="app-secret">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 px-md-1">
                                            <div class="form-group">
                                                <label>Application FCM</label>
                                                <input type="text" class="form-control" placeholder="Application FCM"
                                                    value="" id="app-fcm">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 px-md-1">
                                            <div class="form-group">
                                                <label>Application Secret</label>
                                                <select class="custom-select" style="color: white" id="app-platform">
                                                    <option style="color: black" selected disabled>Platform</option>
                                                    <option style="color: black" value="IOS">IOS</option>
                                                    <option style="color: black" value="Android">Android</option>
                                                    <option style="color: black" value="Desktop">Desktop</option>
                                                    <option style="color: black" value="Website">Website</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="form-check">
                                                    <label class="form-check-label">Active
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="app-active">
                                                        <span class="form-check-sign">
                                                            <span class="check"></span>
                                                        </span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" value="{{route("app.store")}}" id="app-url">
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-fill btn-primary float-right"
                                        onclick="saveApp()">Save</button>
                                </div>
                            </div>
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
                                                    onchange="stateApp(this,'{{route('app.edit',$value->id)}}')"
                                                    type="checkbox" {{$value->app_state ? "checked" : ''}} value="">
                                                <span class="form-check-sign">
                                                    <span class="check"></span>
                                                </span>
                                            </label>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="title">{{$value->app_name}}</p>
                                        <p class="text-muted">Created At, {{$value->created_at}}</p>
                                    </td>
                                    <td class="td-actions text-right">
                                    <a href="{{route('app.show',$value->id)}}" rel="tooltip"  class="btn btn-link"
                                            data-original-title="Show">
                                            <i class="tim-icons icon-link-72"></i>
                                    </a>
                                        <button type="button" rel="tooltip" title="" class="btn btn-link"
                                            data-toggle="modal" data-target=".add-updated-{{$value->id}}"
                                            data-original-title="Edit Task">
                                            <i class="tim-icons icon-pencil"></i>
                                        </button>
                                        <button type="button" rel="tooltip" title=""
                                            onclick="deleteApp(this,'{{route('app.destroy',$value->id)}}')"
                                            class="btn btn-link" data-original-title="Edit Task">
                                            <i class="tim-icons icon-trash-simple"></i>
                                        </button>
                                    </td>
                                </tr>
                                <div class="modal fade add-updated-{{$value->id}}" tabindex="-1" role="dialog"
                                    aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content card">
                                            <div class="card-body">
                                                <div style="margin: 20px !important">
                                                    <div class="row">
                                                        <div class="col-md-12 px-md-1">
                                                            <div class="form-group">
                                                                <label>Application Name</label>
                                                                <input type="text" class="form-control"
                                                                    placeholder="Application Name"
                                                                    value="{{$value->app_name}}"
                                                                    id="app-name-{{$value->id}}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12 px-md-1">
                                                            <div class="form-group">
                                                                <label>Application Access</label>
                                                                <input type="text" class="form-control"
                                                                    placeholder="Application Access"
                                                                    value="{{$value->app_access}}"
                                                                    id="app-access-{{$value->id}}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12 px-md-1">
                                                            <div class="form-group">
                                                                <label>Application Secret</label>
                                                                <input type="text" class="form-control"
                                                                    placeholder="Application Secret"
                                                                    value="{{$value->app_secret}}"
                                                                    id="app-secret-{{$value->id}}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12 px-md-1">
                                                            <div class="form-group">
                                                                <label>Application FCM</label>
                                                                <input type="text" class="form-control"
                                                                    placeholder="Application FCM"
                                                                    value="{{$value->app_fcm}}"
                                                                    id="app-fcm-{{$value->id}}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12 px-md-1">
                                                            <div class="form-group">
                                                                <label>Application Secret</label>
                                                                <select class="custom-select" style="color: white"
                                                                    id="app-platform-{{$value->id}}">
                                                                    <option style="color: black" selected disabled>
                                                                        Platform</option>
                                                                    <option
                                                                        {{$value->app_type == 'IOS' ? 'selected' : ''}}
                                                                        style="color: black" value="IOS">IOS</option>
                                                                    <option
                                                                        {{$value->app_type == 'Android' ? 'selected' : ''}}
                                                                        style="color: black" value="Android">Android
                                                                    </option>
                                                                    <option
                                                                        {{$value->app_type == 'Desktop' ? 'selected' : ''}}
                                                                        style="color: black" value="Desktop">Desktop
                                                                    </option>
                                                                    <option
                                                                        {{$value->app_type == 'Website' ? 'selected' : ''}}
                                                                        style="color: black" value="Website">Website
                                                                    </option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <div class="form-check">
                                                                    <label class="form-check-label">Active
                                                                        <input class="form-check-input" type="checkbox"
                                                                            {{$value->app_state ? 'checked': ''}}
                                                                            value="" id="app-active-{{$value->id}}">
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
                                            </div>
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
<script src="{{asset('assets/requests/application.js')}}"></script>
@endsection