<div class="modal fade" id="addTaskModal" tabindex="-1" aria-labelledby="addTaskModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addTaskModalLabel">Add Task</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="addTaskForm" method="post" style="border-radius:10px;">
                    <div class="form-group">
                        <label for="taskName">Task Name:</label>
                        <input type="text" class="form-control" id="taskName" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="taskDescription">Description:</label>
                        <textarea class="form-control" id="taskDescription" name="description"></textarea>
                    </div>
                    <input type="hidden" id="add_task_project_id" name="project_id" value="<?php echo $project_id; ?>">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="saveAddTask">Add Task</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('#saveAddTask').click(function () {
            // Validasi untuk memastikan "Task Name" tidak kosong
            var taskName = $('#taskName').val().trim();
            if (taskName === '') {
                alert('Task Name is required.');
                return;
            }

            $.ajax({
                type: 'POST',
                url: '../task/create_task.php',
                data: $('#addTaskForm').serialize(),
                success: function (response) {
                    var res = JSON.parse(response);
                    if (res.status === 'success') {
                        // Task added successfully, refresh the task list or update the UI as needed
                        location.reload();
                    } else {
                        alert('Error: ' + res.message);
                    }
                }
            });
        });
    });
</script>