<div class="modal fade" id="editTodoModal" tabindex="-1" role="dialog" aria-labelledby="editTodoModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editTodoModalLabel">Edit To-Do</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editTodoForm" method="post" action="../todo/edit_todo.php" style="border-radius:10px;">
                    <input type="hidden" id="edit_todo_id" name="todo_id">
                    <div class="form-group">
                        <label for="edit_name">To-Do Name:</label>
                        <input type="text" class="form-control" id="edit_name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_deadline">Deadline:</label>
                        <input type="date" class="form-control" id="edit_deadline" name="deadline">
                    </div>
                    <div class="form-group">
                        <label for="edit_priority">Priority:</label>
                        <select class="form-control" id="edit_priority" name="priority">
                            <option value="low">Low</option>
                            <option value="medium">Medium</option>
                            <option value="high">High</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="edit_progress">Progress:</label>
                        <input type="number" class="form-control" id="edit_progress" name="progress" min="0" max="100">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" form="editTodoForm">Save Changes</button>
            </div>
        </div>
    </div>
</div>