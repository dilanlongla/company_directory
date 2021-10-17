<!-- Title Field -->
<div class="form-group">
    {!! Form::label('title', 'Title:') !!}
    <p>{{ $service->title }}</p>
</div>

<!-- Body Field -->
<div class="form-group">
    {!! Form::label('body', 'Body:') !!}
    <p>{{ $service->body }}</p>
</div>

<!-- Image Field -->
<div class="form-group">
    {!! Form::label('image', 'Image:') !!}
    <img src="{{ asset('image/'.$service->image)}}" style="width:500px; max-height: 500px;">
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $service->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $service->updated_at }}</p>
</div>