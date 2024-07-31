<!-- Puke Begawan Hidayat 10123335 (html) -->
<!-- Farel Mochamad Gibransyah 10123304 (html) -->

<div class="modal fade" id="inviteMemberModal" tabindex="-1" aria-labelledby="inviteMemberModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="inviteMemberModalLabel">Invite Member</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="inviteMemberForm" method="post" action="invite_member.php">
                    <input type="hidden" name="project_id" value="<?php echo $project_id; ?>">
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" id="inviteEmail" name="email" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" form="inviteMemberForm">Invite</button>
            </div>
        </div>
    </div>
</div>