<div id="deletePostModal" class="modal-backdrop" role="dialog" aria-modal="true" aria-labelledby="deleteModalTitle" hidden>
    <div class="modal-dialog">
        <h2 id="deleteModalTitle">Confirm Deletion</h2>
        <p id="deleteModalMessage">Are you sure you want to delete this post? This action cannot be undone.</p>
        <div class="modal-actions">
            <button type="button" id="cancelDeleteBtn" class="btn btn-secondary">Cancel</button>
            <form id="deletePostForm" method="POST" action="" class="inline-form">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Confirm Delete</button>
            </form>
        </div>
    </div>
</div>

<script>
    (function () {
        const modal = document.getElementById('deletePostModal');
        const form = document.getElementById('deletePostForm');
        const message = document.getElementById('deleteModalMessage');
        const cancelBtn = document.getElementById('cancelDeleteBtn');

        if (!modal || !form || !message || !cancelBtn) {
            return;
        }

        function closeModal() {
            modal.classList.remove('is-open');
            modal.setAttribute('hidden', 'hidden');
        }

        document.querySelectorAll('.js-open-delete-modal').forEach(function (button) {
            button.addEventListener('click', function () {
                const action = button.getAttribute('data-action');
                const title = button.getAttribute('data-title') || 'this post';
                form.setAttribute('action', action);
                message.textContent = 'Are you sure you want to delete "' + title + '"? This action cannot be undone.';
                modal.removeAttribute('hidden');
                modal.classList.add('is-open');
            });
        });

        cancelBtn.addEventListener('click', closeModal);

        modal.addEventListener('click', function (event) {
            if (event.target === modal) {
                closeModal();
            }
        });

        document.addEventListener('keydown', function (event) {
            if (event.key === 'Escape' && modal.classList.contains('is-open')) {
                closeModal();
            }
        });
    })();
</script>

