<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List All Task</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header d-flex">
                <h4 class="h4">List of Items</h4>
                <a href="{{ route('create') }}" class="btn btn-primary float-end">Create Task</a>
            </div>
            <div class="card-body">
                @if ($tasks)
                    <table class="table table-striped table-hover table-bordered">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Completed</th>
                                <th>Update</th>
                                <th>Delete</th>
                            </tr>
                        </thead>

                        @foreach ($tasks as $task)
                            <tr>
                                <th>{{ $task->title }}</th>
                                <th>{{ $task->description }}</th>
                                <th>
                                    {{-- {{ $task->completed ? <span class="badge text-bg-primary">Completed</span> : <span class="badge text-bg-secondary">Pending</span> }} --}}
                                    pending
                                </th>

                                <th><a href="#" class="btn btn-success">Update</a></th>
                                <th><a href="#" class="btn btn-danger">Delete</a></th>
                            </tr>
                        @endforeach
                    </table>
                @else
                    <tr>
                        <th colspan="4">Not found any data</th>
                    </tr>
                @endif
            </div>
        </div>
    </div>

</body>
</html>
