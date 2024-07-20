<div class="modal fade" id="removeTaskModal" tabindex="-1" aria-labelledby="removeTaskModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="removeTaskModalLabel">Remove Task</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to remove this task?</p>
                <div style="display:none;">
                    <form id="removeTaskForm" method="post">
                        <input type="hidden" id="remove_task_id" name="task_id">
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-danger" id="confirmRemoveTask">Remove Task</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('#confirmRemoveTask').click(function () {
            $.ajax({
                type: 'POST',
                url: '../task/remove_task.php',
                data: $('#removeTaskForm').serialize(),
                success: function (response) {
                    var res = JSON.parse(response);
                    if (res.status === 'success') {
                        window.location.href = "../project/view_project.php?id=<?= $project_id ?>";
                    } else {
                        alert('Error: ' + res.message);
                    }
                },
                error: function (xhr, status, error) {
                    alert('An AJAX error occurred: ' + status + '\nError: ' + error);
                }
            });
        });

        $('#removeTaskModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var taskId = button.data('task-id');
            var modal = $(this);
            modal.find('#remove_task_id').val(taskId);
        });
    });
</script>