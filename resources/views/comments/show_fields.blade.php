<!-- Comment Field -->
<div class="form-group">
    {!! Form::label('comment', 'Comment:') !!}
    <p>{{ $comment->comment }}</p>
</div>

<!-- Rating Field -->
<div class="form-group">
    {!! Form::label('rating', 'Rating:') !!}
    <p>{{ $comment->rating }}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $comment->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $comment->updated_at }}</p>
</div>

