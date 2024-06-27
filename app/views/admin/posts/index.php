<?php $pagetitle = "پست‌ها"; ?>
<div class="row">
    <div class="col-12">
        <a href="/admin/posts/create" class="btn btn-primary">افزودن پست جدید</a>
        <ul class="nav nav-tabs mt-3">
            <?php foreach ($postTypes as $postType) : ?>
                <li class="nav-item">
                    <a class="nav-link post-filter <?php echo $postType['id'] == 1 ? 'active' : ''; ?>" data-type="<?php echo $postType['slug']; ?>" href="#"><?php echo $postType['title']; ?></a>
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
        function loadPosts(url) {
            fetch(url, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                const { posts, totalPosts, limit, page } = data;
                updateTable(posts, totalPosts, limit, page);
                attachEventListeners(); // Re-attach event listeners to new elements
            })
            .catch(error => console.error('Error:', error));
        }

        function updateTable(posts, totalPosts, limit, page) {
            const postTable = document.getElementById('post-table');
            let html = `
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Post Type</th>
                            <th>Image</th>
                            <th>Title</th>
                            <th>Active</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>`;
            
            posts.forEach(post => {
                html += `
                    <tr>
                        <td><span class="badge text-bg-${post.color}">${post.postType}</span></td>
                        <td><img width="64px" src="${post.image}" alt="عکس مقاله" class="object-cover" /></td>
                        <td>${post.title}</td>
                        <td>${post.is_active ? 'Yes' : 'No'}</td>
                        <td>
                            <a href="/admin/posts/edit/${post.id}" class="btn btn-warning" title="Edit"><i class="fas fa-edit"></i></a>
                            <button class="btn btn-danger delete-post" data-id="${post.id}" title="Delete"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>`;
            });

            html += `
                    </tbody>
                </table>
                <nav>
                    <ul class="pagination">`;

            for (let i = 1; i <= Math.ceil(totalPosts / limit); i++) {
                html += `<li class="page-item ${i == page ? 'active' : ''}">
                            <a class="page-link" href="#" data-page="${i}">${i}</a>
                         </li>`;
            }

            html += `
                    </ul>
                </nav>`;
            
            postTable.innerHTML = html;
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
                                const activeTab = document.querySelector('.nav-link.active');
                                const type = activeTab ? activeTab.getAttribute('data-type') : '';
                                const url = type ? `/admin/posts/type/${type}` : `/admin/posts`;
                                loadPosts(url);
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
