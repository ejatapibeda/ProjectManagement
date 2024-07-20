<div class="modal fade" id="createTodoModal" tabindex="-1" role="dialog" aria-labelledby="createTodoModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createTodoModalLabel">Create To-Do</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="createTodoForm" method="post" action="../todo/create_todo.php" style="border-radius:10px;">
                    <input type="hidden" name="task_id" value="<?php echo $task_id; ?>">
                    <div class="form-group">
                        <label for="name">To-Do Name:</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="deadline">Deadline:</label>
                        <input type="date" class="form-control" id="deadline" name="deadline">
                    </div>
                    <div class="form-group">
                        <label for="priority">Priority:</label>
                        <select class="form-control" id="priority" name="priority">
                            <option value="low">Low</option>
                            <option value="medium" selected>Medium</option>
                            <option value="high">High</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="progress">Progress:</label>
                        <input type="number" class="form-control" id="progress" name="progress" min="0" max="100"
                            value="0">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" form="createTodoForm">Create To-Do</button>
            </div>
        </div>
    </div>
</div>