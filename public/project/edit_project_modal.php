<!-- Puke Begawan Hidayat 10123335 (html) -->
<!-- Farel Mochamad Gibransyah 10123304 (html) -->

<div class="modal fade" id="editProjectModal" tabindex="-1" aria-labelledby="editProjectModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editProjectModalLabel">Edit Project</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editProjectForm" method="post" action="edit_project.php">
                    <input type="hidden" name="project_id" value="<?= htmlspecialchars($project_id); ?>">
                    <div class="form-group">
                        <label for="name">Project Name:</label>
                        <input type="text" class="form-control" id="editProjectName" name="name"
                            value="<?= htmlspecialchars($project_name); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Description:</label>
                        <textarea class="form-control" id="editProjectDescription"
                            name="description"><?= htmlspecialchars($project_description); ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="bullet_color">Bullet Color:</label>
                        <input type="color" class="form-control" id="editBulletColor" name="bullet_color"
                            value="<?= htmlspecialchars($bullet_color); ?>">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" form="editProjectForm">Save changes</button>
            </div>
        </div>
    </div>
</div>