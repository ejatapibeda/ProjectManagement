<!-- Remove Project Modal -->
<div class="modal fade" id="removeProjectModal" tabindex="-1" aria-labelledby="removeProjectModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="removeProjectForm" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title" id="removeProjectModalLabel">Remove Project</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to remove this project?</p>
                    <input type="hidden" id="remove_project_id" name="project_id" value="<?= $project_id ?>">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger" id="confirmRemoveProject">Remove Project</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('#confirmRemoveProject').click(function () {
            $.ajax({
                type: 'POST',
                url: 'remove_project.php',
                data: $('#removeProjectForm').serialize(),
                success: function (response) {
                    var res = JSON.parse(response);
                    if (res.status === 'success') {
                        window.location.href = "../main/index.php";
                    } else {
                        alert('Error: ' + res.message);
                    }
                },
                error: function (xhr, status, error) {
                    alert('An AJAX error occurred: ' + status + '\nError: ' + error);
                }
            });
        });

        $('#removeProjectModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var projectId = button.data('project_id');
            var modal = $(this);
            modal.find('#remove_project_id').val(projectId);
        });
    });
</script>