<div class="row">
    <div class="col-12">
        <h1>Create New Company</h1>
        <form id="company-form" action="/admin/companies/store" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="logo">Logo</label>
                <input type="file" class="form-control" id="logo" name="logo">
            </div>
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="intro">Intro</label>
                <textarea class="form-control" id="intro" name="intro" required></textarea>
            </div>
            <div class="form-group">
                <label for="shareholders">Shareholders</label>
                <textarea class="form-control" id="shareholders" name="shareholders" required></textarea>
            </div>
            <div class="form-group">
                <label for="contract_file">Contract File (optional)</label>
                <input type="file" class="form-control" id="contract_file" name="contract_file">
            </div>
            <div class="form-group">
                <label for="tariffs_images">Tariffs Images (optional)</label>
                <div id="tariffs-dropzone" class="dropzone"></div>
            </div>
            <div id="preview-container" class="row"></div>
            <div class="form-group">
                <label for="color">Color</label>
                <input type="text" class="form-control" id="color" name="color" required>
            </div>
            <div class="form-group">
                <label for="sort">Sort</label>
                <input type="number" class="form-control" id="sort" name="sort" required>
            </div>
            <div class="form-group form-check">
                <input type="checkbox" class="form-check-input" id="is_active" name="is_active">
                <label class="form-check-label" for="is_active">Is Active</label>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>

<!-- Include Dropzone.js CSS and JS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.js"></script>

<script>
Dropzone.autoDiscover = false;

const tariffsDropzone = new Dropzone("#tariffs-dropzone", {
    url: "/file/post", // Dummy URL, form submission will handle actual upload
    autoProcessQueue: false,
    addRemoveLinks: true,
    acceptedFiles: 'image/*',
    init: function() {
        this.on("addedfile", function(file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const previewContainer = document.getElementById("preview-container");
                const img = document.createElement("img");
                img.src = e.target.result;
                img.classList.add("img-thumbnail");
                img.style.maxWidth = "100px";
                img.style.margin = "10px";
                previewContainer.appendChild(img);
            };
            reader.readAsDataURL(file);
        });
        this.on("removedfile", function(file) {
            const previewContainer = document.getElementById("preview-container");
            const removedImg = previewContainer.querySelector(`img[src="${file.dataURL}"]`);
            if (removedImg) {
                previewContainer.removeChild(removedImg);
            }
        });
    }
});

document.getElementById("company-form").addEventListener("submit", function(event) {
    event.preventDefault();
    const formData = new FormData(this);
    const files = tariffsDropzone.getAcceptedFiles();

    if (files.length > 0) {
        const filePromises = files.map(file => {
            return new Promise((resolve, reject) => {
                const reader = new FileReader();
                reader.onload = function(e) {
                    resolve(e.target.result);
                };
                reader.onerror = function(error) {
                    reject(error);
                };
                reader.readAsDataURL(file);
            });
        });

        Promise.all(filePromises).then(fileData => {
            formData.append('tariffs_images', JSON.stringify(fileData));
            submitForm(formData);
        }).catch(error => {
            console.error('Error:', error);
        });
    } else {
        submitForm(formData);
    }
});

function submitForm(formData) {
    fetch(document.getElementById("company-form").action, {
        method: 'POST',
        body: formData
    }).then(response => response.json()).then(result => {
        if (result.success) {
            alert('Company created successfully!');
            window.location.href = '/admin/companies';
        } else {
            alert(result.message);
        }
    }).catch(error => {
        console.error('Error:', error);
    });
}
</script>
