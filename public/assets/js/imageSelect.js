document.addEventListener('DOMContentLoaded', function () {
    const imageOptions = document.querySelectorAll('.image-option');
    const selectedImageInput = document.getElementById('selected-image');

    imageOptions.forEach(imageOption => {
        imageOption.addEventListener('click', function () {
            imageOptions.forEach(img => img.classList.remove('selected'));
            this.classList.add('selected');
            selectedImageInput.value = this.getAttribute('data-value');
        });
    });
});
