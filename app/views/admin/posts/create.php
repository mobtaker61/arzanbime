<script>
    tinymce.init({
        selector: '#full_body',
        plugins: 'advlist autolink lists link image charmap print preview hr anchor pagebreak directionality wordcount',
        toolbar_mode: 'floating',
        language: 'fa',
        theme: 'silver',
        toolbar: [{
                name: 'history',
                items: ['undo', 'redo']
            },
            {
                name: 'styles',
                items: ['styles']
            },
            {
                name: 'formatting',
                items: ['bold', 'italic']
            },
            {
                name: 'alignment',
                items: ['alignleft', 'aligncenter', 'alignright', 'alignjustify']
            },
            {
                name: 'indentation',
                items: ['outdent', 'indent']
            },
            {
                name: 'directionality',
                items: ['rtl', 'ltr']
            }
        ],
        images_upload_url: '/upload.php', // Replace with your image upload handler URL
        images_upload_credentials: true
    });

    function validateForm() {
        var editorContent = tinymce.get("full_body").getContent();
        if (editorContent === "") {
            alert("The Full Body field is required.");
            return false;
        }
        return true;
    }
</script>

<!--begin::Horizontal Form-->
<div class="card card-warning card-outline mb-4"> <!--begin::Header-->
    <div class="card-header">
        <div class="card-title">محتوای جدید</div>
    </div> <!--end::Header--> <!--begin::Form-->
    <form action="/admin/posts/store" method="post" enctype="multipart/form-data"> <!--begin::Body-->
        <div class="card-body">
            <div class="row mb-3">
                <label for="post_type" class="col-sm-2 col-3 col-form-label">Post Type</label>
                <div class="col-sm-3">
                    <select name="post_type" id="post_type" class="form-control">
                        <?php foreach ($postTypes as $type) : ?>
                            <option value="<?php echo $type['id']; ?>"><?php echo $type['title']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="row mb-3">
                <label for="title" class="col-sm-2 col-form-label">عنوان</label>
                <div class="col-sm-10"> <input type="text" name="title" id="title" class="form-control" required> </div>
            </div>
            <div class="row mb-3">
                <label for="caption" class="col-sm-2 col-form-label">خلاصه</label>
                <div class="col-sm-10"> <input type="text" name="caption" id="caption" class="form-control" required> </div>
            </div>
            <div class="row mb-3">
                <label for="full_body" class="col-sm-2 col-form-label">متن کامل</label>
                <div class="col-sm-10"> <textarea name="full_body" id="full_body" class="form-control" rows="10"></textarea> </div>
            </div>
            <div class="row mb-3">
                <label for="image" class="col-sm-2 col-form-label">تصویر</label>
                <div class="col-sm-10"> <input type="file" name="image" id="image" class="form-control" accept="image/*"> </div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-10 offset-sm-2">
                    <div class="form-check">
                        <input type="checkbox" name="is_active" id="is_active" class="form-check-input" checked>
                        <label class="form-check-label" checked for="is_active">
                            فعال باشد؟
                        </label>
                    </div>
                </div>
            </div>
        </div> <!--end::Body--> <!--begin::Footer-->
        <div class="card-footer">
            <button type="submit" class="btn btn-warning float-end">ذخیره</button>
        </div> <!--end::Footer-->
    </form> <!--end::Form-->
</div> <!--end::Horizontal Form-->