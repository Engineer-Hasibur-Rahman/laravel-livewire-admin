@foreach ($blogs as $blog)
<div class="card mb-2"> 
    <div class="card-body">{{ $blog->id }} 
        <h5 class="card-title">{{ $blog->title }}</h5>
        {!! $blog->body !!}
    </div>
</div>
@endforeach