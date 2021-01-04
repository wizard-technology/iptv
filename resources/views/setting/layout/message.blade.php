@if(count($errors) > 0)
@foreach ($errors->all() as $error)

<div class="alert alert-danger">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <i class="tim-icons icon-simple-remove"></i>
    </button>
    <span>
        <b> Error - </b> {{$error}}</span>
</div>
@endforeach
@endif
@if(session('error'))
<div class="alert alert-danger">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <i class="tim-icons icon-simple-remove"></i>
    </button>
    <span>
        <b> Error - </b> {{session('error')}}</span>
</div>
@endif
@if(session('success'))
<div class="alert alert-success">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <i class="tim-icons icon-simple-remove"></i>
    </button>
    <span>
        <b> Success - </b> {{session('success')}}</span>
</div>
@endif