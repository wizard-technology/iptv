@extends('setting.layout.app')
@section('content')
<div class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-tasks" style="min-height: 800px !important">
                <div class="card-header ">
                    <h6 class="title d-inline">Category</h6>
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
                                                <label>Category Name</label>
                                                <input type="text" class="form-control" placeholder="Category Name"
                                                    value="" id="ct-name">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="form-check">
                                                    <label class="form-check-label">Active
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="ct-active">
                                                        <span class="form-check-sign">
                                                            <span class="check"></span>
                                                        </span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" value="{{route("category.store")}}" id="ct-url">
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-fill btn-primary float-right"
                                        onclick="saveCategory()">Save</button>
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
                                                    onchange="stateCategory(this,'{{route('category.edit',$value->id)}}')"
                                                    type="checkbox" {{$value->ct_state ? "checked" : ''}} value="">
                                                <span class="form-check-sign">
                                                    <span class="check"></span>
                                                </span>
                                            </label>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="title">{{$value->ct_name}}</p>
                                        <p class="text-muted">Created At, {{$value->created_at}}</p>
                                    </td>
                                    <td class="td-actions text-right">
                                        <button type="button" rel="tooltip" title="" class="btn btn-link"
                                            data-toggle="modal" data-target=".add-updated-{{$value->id}}"
                                            data-original-title="Edit Task">
                                            <i class="tim-icons icon-pencil"></i>
                                        </button>
                                        <button type="button" rel="tooltip" title=""
                                            onclick="deleteCategory(this,'{{route('category.destroy',$value->id)}}')"
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
                                                                <label>Category Name</label>
                                                                <input type="text" class="form-control"
                                                                    placeholder="Category Name"
                                                                    value="{{$value->ct_name}}"
                                                                    id="ct-name-{{$value->id}}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <div class="form-check">
                                                                    <label class="form-check-label">Active
                                                                        <input class="form-check-input" type="checkbox"
                                                                            {{$value->ct_state ? 'checked': ''}}
                                                                            value="" id="ct-active-{{$value->id}}">
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
                                                        onclick="updateCategory('{{$value->id}}','{{route('category.update',$value->id)}}')">Change</button>
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
<script src="{{asset('assets/requests/category.js')}}"></script>
@endsection