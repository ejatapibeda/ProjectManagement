<!-- Puke Begawan Hidayat 10123335 (html) -->
<!-- Farel Mochamad Gibransyah 10123304 (html) -->

<!-- Modal for Manage Invites -->
<div class="modal fade" id="manageInvitesModal" tabindex="-1" aria-labelledby="manageInvitesModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="manageInvitesModalLabel">Manage Invites</h5>
                <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <ul class="list-group">
                    <?php if ($invite_count > 0): ?>
                        <?php foreach ($invites as $invite): ?>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <?php echo htmlspecialchars($invite['name']); ?>
                                <span>
                                    <a href="../project/accept_invite.php?id=<?php echo htmlspecialchars($invite['id']); ?>"
                                        class="btn btn-success btn-sm">Accept</a>
                                    <a href="../project/decline_invite.php?id=<?php echo htmlspecialchars($invite['id']); ?>"
                                        class="btn btn-danger btn-sm">Decline</a>
                                </span>
                            </li>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <li class="list-group-item">No invitations found.</li>
                    <?php endif; ?>
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>