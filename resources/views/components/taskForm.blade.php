
{{ Form::label('name', 'Task name', ['class' => 'control-label']) }}
{{ Form::text('name', null, ['class' => 'form-control form-control-lg', 'placeholder'=>'Task name'])}}

{{ Form::label('description', 'Task description', ['class' => 'control-label mt-3']) }}
{{ Form::textarea('description', null, ['class' => 'form-control', 'placeholder'=>'Task description'])}}

{{ Form::label('due_date', 'Due date', ['class' => 'control-label mt-3']) }}
{{ Form::date('due_date', null, ['class' => 'form-control'])}}

<div class="row justify-content-center mt-3">
    <div class="col-sm-4">
        <a href='{{route('task.index')}}' class='btn btn-block btn-secondary' >Back to tasks</a>

    </div>
    <div class="col-sm-4">
        <button class='btn btn-block btn-primary' type='submit'>Save task</button>
    </div>
</div>

