@extends('layouts.app')

@section('title', 'Create task')

@section('content')

<div class="row">
    <div class="col-sm-12">
        <h1>Create task</h1>

        {!! Form::open(['route' => 'task.store', 'method' => 'POST']) !!}
            @component('components.taskForm')
            @endcomponent
        {!! Form::close() !!}
    </div>
</div>

@endsection