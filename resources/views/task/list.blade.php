<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>List All Task</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div class="container mt-5">
        <div class="card">
            @if (session('message'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('message') }}
                </div>
            @endif

            <div class="card-header">
                <span class="h4">All Tasks</span>
                <a href="{{ route('create') }}" class="btn btn-primary float-end">Create Task</a>
            </div>
            <div class="card-body">
                @if ($tasks->count() > 0)
                    <table class="table table-striped table-hover table-bordered">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Status</th>
                                <th>Update</th>
                                <th>Delete</th>
                            </tr>
                        </thead>

                        @foreach ($tasks as $task)
                            <tr>
                                <td>{{ $task->title }}</td>
                                <td>{{ $task->description }}</td>
                                <td>
                                    @if ($task->completed)
                                        <div class="form-check form-switch">
                                            <input class="form-check-input switch" type="checkbox" role="switch"
                                                id="flexSwitchCheckDefault" value="{{ $task->id }}" checked>
                                        </div>
                                    @else
                                        <div class="form-check form-switch">
                                            <input class="form-check-input switch" type="checkbox" role="switch"
                                                id="flexSwitchCheckDefault" value="{{ $task->id }}">
                                        </div>
                                    @endif
                                </td>

                                <td><a href="{{ route('edit', ['id' => $task->id]) }}" class="btn btn-info">Update</a>
                                </td>
                                <form action="{{ route('delete', ['did' => $task->id]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <td><input type="submit" value="Delete" class="btn btn-danger"></td>
                                </form>
                            </tr>
                        @endforeach
                    </table>
                @else
                    <tr>
                        <td colspan="4">
                            <h6>Not found any data. Please create any task..!</h6>
                        </td>
                    </tr>
                @endif
            </div>
        </div>
    </div>


    {{-- Bootstrap Modal for Alert --}}
    <div class="modal" tabindex="-1" id="modal">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Modal title</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>


    {{-- jquery script --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script>
        $(document).ready(function() {
            setTimeout(function() {
                $('.alert').alert('close');
            }, 3000);


            let flag = false;
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            $(document).on('change', '.switch', function() {
                $taskId = $(this).val();
                if ($(this).prop('checked')) {
                    flag = true;
                }else{
                    flag = false;
                }

                if (flag === true) {
                    $.ajax({
                        url: "{{ route('task-status-done') }}",
                        type: "POST",
                        data: { id: $taskId },
                        headers: {
                            'X-CSRF-TOKEN': csrfToken
                        },
                        success: function(response) {
                            $("#modal .modal-body").html("<h6>" + response + "</h6>");
                            $("#modal").modal("show");
                        }
                    });
                } else {
                    $.ajax({
                        url: "{{ route('task-status-pending') }}",
                        type: "POST",
                        data: { id: $taskId },
                        headers: {
                            'X-CSRF-TOKEN': csrfToken
                        },
                        success: function(response) {
                            $("#modal .modal-body").html("<h6>" + response + "</h6>");
                            $("#modal").modal("show");
                        }
                    });
                }
            });
        });
    </script>
</body>

</html>
