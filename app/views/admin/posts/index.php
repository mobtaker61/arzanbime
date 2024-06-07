<div class="row">
    <div class="col-12">
        <a href="/admin/posts/create" class="btn btn-primary">Create New Post</a>
        <ul class="nav nav-tabs mt-3">
            <?php foreach ($postTypes as $postType): ?>
                <li class="nav-item">
                    <a class="nav-link post-filter <?php echo $postType['id'] == 1 ? 'active' : ''; ?>" data-type="<?php echo $postType['id']; ?>" href="#"><?php echo $postType['title']; ?></a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>

<div id="post-table">
    <?php include 'post_table.php'; ?>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    function loadPosts(url = '/admin/posts') {
        fetch(url, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.text())
        .then(html => {
            document.getElementById('post-table').innerHTML = html;
            attachEventListeners();
        })
        .catch(error => console.error('Error:', error));
    }

    function attachEventListeners() {
        document.querySelectorAll('.post-filter').forEach(link => {
            link.addEventListener('click', function(event) {
                event.preventDefault();
                document.querySelectorAll('.post-filter').forEach(link => link.classList.remove('active'));
                this.classList.add('active');
                const type = this.getAttribute('data-type');
                const url = `/admin/posts/type/${type}`;
                loadPosts(url);
            });
        });

        document.querySelectorAll('.page-link').forEach(link => {
            link.addEventListener('click', function(event) {
                event.preventDefault();
                const page = this.getAttribute('data-page');
                const activeTab = document.querySelector('.nav-link.active');
                const type = activeTab ? activeTab.getAttribute('data-type') : '';
                const url = type ? `/admin/posts/type/${type}?page=${page}` : `/admin/posts?page=${page}`;
                loadPosts(url);
            });
        });

        document.querySelectorAll('.delete-post').forEach(button => {
            button.addEventListener('click', function() {
                const postId = this.getAttribute('data-id');
                if (confirm('Are you sure you want to delete this post?')) {
                    fetch(`/admin/posts/delete/${postId}`, {
                        method: 'DELETE',
                        headers: {
                            'Content-Type': 'application/json'
                        }
                    }).then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    }).then(result => {
                        if (result.success) {
                            alert('Post deleted successfully.');
                            loadPosts();
                        } else {
                            alert('Error: ' + result.message);
                        }
                    }).catch(error => {
                        console.error('Error:', error);
                    });
                }
            });
        });
    }

    attachEventListeners();
});
</script>