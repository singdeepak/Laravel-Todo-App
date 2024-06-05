<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>

    <div class="container my-4">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title mb-0">Task Management</h4>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createTaskModal">Create
                    Task</button>
            </div>
            <div class="card-body">
                <div id="taskList" class="row g-3">
                    <table class="table table-striped table-hover table-bordered">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Completed</th>
                            </tr>
                        </thead>
                        <tbody id="taskTableBody">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Create Task Modal -->
    <div class="modal fade" id="createTaskModal" tabindex="-1" aria-labelledby="createTaskModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createTaskModalLabel">Create Task</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="createTaskForm">
                        <div class="mb-3">
                            <label for="taskTitle" class="form-label">Title</label>
                            <input type="text" class="form-control" id="taskTitle" required>
                        </div>
                        <div class="mb-3">
                            <label for="taskDescription" class="form-label">Description</label>
                            <textarea class="form-control" id="taskDescription" rows="3" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Create</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Update Task Modal -->
    <div class="modal fade" id="updateTaskModal" tabindex="-1" aria-labelledby="updateTaskModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateTaskModalLabel">Update Task</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="updateTaskForm">
                        <input type="hidden" id="updateTaskId">
                        <div class="mb-3">
                            <label for="updateTaskTitle" class="form-label">Title</label>
                            <input type="text" class="form-control" id="updateTaskTitle" required>
                        </div>
                        <div class="mb-3">
                            <label for="updateTaskDescription" class="form-label">Description</label>
                            <textarea class="form-control" id="updateTaskDescription" rows="3" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <script>
        $(document).ready(function() {

            function loadAllTasks() {
                $.ajax({
                    url: "{{ route('showAllTasks') }}",
                    type: 'GET',
                    success: function(response) {
                        $("#taskTableBody").html(response);

                    },
                    error: function(xhr, status, error) {
                        console.error('Failed to load tasks:', error);
                        console.error('XHR:', xhr);
                        console.error('Status:', status);
                    }
                });
            }

            // loadAllTasks();

            $("#createTaskForm").on('submit', function(e) {
                e.preventDefault();

                let title = $("#taskTitle").val();
                let description = $("#taskDescription").val();


                $.ajax({
                    url: '{{ route('create') }}',
                    type: 'POST',
                    data: {
                        "_token" : "{{ csrf_token() }}",
                        title : title,
                        description : description
                    },
                    success: function(data) {
                        if (data) {
                            $("#createTaskForm").trigger('reset');
                            $('#createTaskModal').modal('hide');
                            // loadAllTasks();
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Failed to create task:', error);
                        console.error('XHR:', xhr);
                        console.error('Status:', status);
                    }
                });
            });
        });
    </script>
</body>

</html>
