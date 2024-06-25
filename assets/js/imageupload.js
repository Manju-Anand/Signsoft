document.addEventListener('DOMContentLoaded', function() {
    const imageInput = document.getElementById('imageInput');
    const imagePreviewContainer = document.getElementById('imagePreviewContainer');

    imageInput.addEventListener('change', handleImageUpload);

    function handleImageUpload(event) {
        const files = Array.from(event.target.files);
        imagePreviewContainer.innerHTML = '';  // Clear existing previews

        files.forEach((file, index) => {
            const reader = new FileReader();

            reader.onload = function(e) {
                const imagePreview = document.createElement('div');
                imagePreview.classList.add('image-preview');
                imagePreview.dataset.index = index;

                const img = document.createElement('img');
                img.src = e.target.result;
                imagePreview.appendChild(img);

                const deleteIcon = document.createElement('span');
                deleteIcon.classList.add('delete-icon');
                deleteIcon.innerHTML = '&times;';
                deleteIcon.addEventListener('click', function() {
                    deleteImage(index);
                });
                imagePreview.appendChild(deleteIcon);

                imagePreviewContainer.appendChild(imagePreview);
            };

            reader.readAsDataURL(file);
        });
    }

    function deleteImage(index) {
        // Create a new DataTransfer object
        const dataTransfer = new DataTransfer();

        // Get the files from the input
        const files = Array.from(imageInput.files);

        // Add all files except the one to be deleted to the DataTransfer object
        files.forEach((file, i) => {
            if (i !== index) {
                dataTransfer.items.add(file);
            }
        });

        // Update the input file element with the new FileList
        imageInput.files = dataTransfer.files;

        // Remove the image preview
        const imagePreview = imagePreviewContainer.querySelector(`.image-preview[data-index="${index}"]`);
        imagePreviewContainer.removeChild(imagePreview);

        // Re-index the remaining previews
        const previews = imagePreviewContainer.querySelectorAll('.image-preview');
        previews.forEach((preview, i) => {
            preview.dataset.index = i;
        });
    }
});