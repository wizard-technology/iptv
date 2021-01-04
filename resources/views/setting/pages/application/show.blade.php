@extends('setting.layout.app')
@section('content')
<div class="content">
    <div class="row">
        <div class="col-md-6">
            <div class="card card-tasks" style="min-height: 800px !important">
                <div class="card-header ">
                    <h6 class="title d-inline">Channels in App</h6>
                    <p class="card-category d-inline"></p>
                </div>
                <div class="card-body ">
                    <div class="table-full-width table-responsive" style="min-height: 700px !important">
                        <table class="table" id="table1">
                            <tbody>
                                @foreach ($data->channel as $key=>$value)
                                <tr>
                                    <td>
                                        <p class="title">{{$value->channel->ch_title}}</p>
                                        <p class="text-muted">{{$value->channel->ch_link}}</p>
                                    </td>
                                    <td>
                                        <p class="title">{{$value->channel->ch_subtitle}}</p>
                                    </td>
                                    <td>
                                        <a
                                            href="{{is_null($value->channel->ch_image)? asset('image.png'):asset('storage/'.$value->channel->ch_image) }}"><img
                                                src="{{is_null($value->channel->ch_image)? asset('image.png'):asset('storage/'.$value->channel->ch_image) }}"
                                                alt="" height="80px" width="80px"></a>
                                    </td>
                                    <td class="td-actions text-right">
                                        <form action="{{route('appchannel.destroy',$value->id)}}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" rel="tooltip" title=""
                                            class="btn btn-link" data-original-title="Edit Task">
                                            <i class="tim-icons icon-simple-remove"></i>
                                        </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card card-tasks" style="min-height: 800px !important">
                <div class="card-header ">
                    <h6 class="title d-inline">Channels not in App</h6>
                    <p class="card-category d-inline"></p>

                </div>
                <div class="card-body ">
                    <div class="table-full-width table-responsive" style="min-height: 700px !important">
                        <table class="table" id="table2">
                            <tbody>
                                @foreach ($out_app as $key=>$value)
                                <tr>
                                    <td>
                                        <p class="title">{{$value->ch_title}}</p>
                                        <p class="text-muted">{{$value->ch_link}}</p>
                                    </td>
                                    <td>
                                        <p class="title">{{$value->ch_subtitle}}</p>
                                    </td>
                                    <td>
                                        <a
                                            href="{{is_null($value->ch_image)? asset('image.png'):asset('storage/'.$value->ch_image) }}"><img
                                                src="{{is_null($value->ch_image)? asset('image.png'):asset('storage/'.$value->ch_image) }}"
                                                alt="" height="80px" width="80px"></a>
                                    </td>
                                    <td class="td-actions text-right">
                                        <form action="{{route('appchannel.insert',$data->id)}}" method="POST">
                                            @csrf
                                            <input type="hidden" name="channel" value="{{$value->id}}">
                                        <button type="submit" rel="tooltip" title=""
                                            class="btn btn-link" data-original-title="Edit Task">
                                            <i class="tim-icons icon-simple-add"></i>
                                        </button>
                                    </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{asset('assets/requests/appchannel.js')}}"></script>

@endsection