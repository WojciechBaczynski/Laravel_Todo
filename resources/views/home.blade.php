@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            @if(Session::has('success'))
                <div class="alert alert-success">{{ Session::get('success') }}</div>
            @endif

            @if(Session::has('warning'))
                <div class="alert alert-warning">{{ Session::get('warning') }}</div>
            @endif

            <div class="card">
                <div class="card-header">Create your todo</div>
                <div class="card-body">
                    <form action="{{ route('todo.store') }}" method="post">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <input type="text" name="todo" value="{{ old('todo') }}" class="form-control {{ $errors->has('todo') ? 'is-invalid' : '' }}" placeholder="Write your todo here">
                            @if($errors->has('todo'))
                                <span class="has-feedback">{{ $errors->first('todo') }}</span>
                            @endif
                        </div>
                        <button type="submit" class="btn btn-secondary btn-block">Create todo</button>
                    </form>
                </div>
            </div>

            <div class="card mt-4">
                <div class="card-header">Your todos</div>

                <div class="card-body">
                    @foreach($todos as $todo)
                        <p>{{ $todo->todo }}</p>
                        <form action="{{ route('todo.delete', $todo->id) }}" method="post">
                            <p>
                                <small>{{ $todo->created_at->diffForHumans() }}</small>
                                <a href="{{ route('todo.edit', $todo->id) }}" class="btn btn-secondary btn-sm">Edit</a>
                                    {{ csrf_field() }}
                                    {{ method_field("DELETE") }}
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </p><br>
                        </form>
                    @endforeach

                    @if(count($todos) == 0)
                        <p>There isn't any todo :'(</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
