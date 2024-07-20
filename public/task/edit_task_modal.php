<div class="modal fade" id="editTaskModal" tabindex="-1" aria-labelledby="editTaskModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editTaskModalLabel">Edit Task</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editTaskForm" method="post" style="border-radius:10px;">
                    <div class="form-group">
                        <label for="editTaskName">Task Name:</label>
                        <input type="text" class="form-control" id="editTaskName" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="editTaskDescription">Description:</label>
                        <textarea class="form-control" id="editTaskDescription" name="description"></textarea>
                    </div>
                    <input type="hidden" id="edit_task_id" name="task_id">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" id="saveEditTask">Save Changes</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('#saveEditTask').click(function () {
            // Validasi Task Name tidak boleh kosong
            var taskName = $('#editTaskName').val().trim();
            if (taskName === '') {
                alert('Task Name cannot be empty.');
                return false; // Menghentikan proses submit jika validasi tidak lolos
            }

            // Jika validasi lolos, lanjutkan dengan AJAX request
            $.ajax({
                type: 'POST',
                url: '../task/edit_task.php',
                data: $('#editTaskForm').serialize(),
                success: function (response) {
                    var res = JSON.parse(response);
                    if (res.status === 'success') {
                        // Task edited successfully, refresh the task list or update the UI as needed
                        location.reload();
                    } else {
                        alert('Error: ' + res.message);
                    }
                }
            });
        });

        $('#editTaskModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var taskId = button.data('task-id');
            var taskName = button.data('task-name');

            var modal = $(this);
            modal.find('#edit_task_id').val(taskId);
            modal.find('#editTaskName').val(taskName);
        });
    });
</script>