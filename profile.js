function showUploadWindow() {
    document.getElementById("popup").style.display = "flex";
    document.getElementById("propicUpload").style.display = "block";
}

function hideUploadWindow() {
    document.getElementById("popup").style.display = "none";
    document.getElementById("propicUpload").style.display = "none";
}

function previewFile(event) {
    let image = document.getElementById("previewImg");
    image.src = URL.createObjectURL(event.target.files[0]);
    image.style.height = image.style.width;
    image.style.borderRadius = "50%";

    document.getElementById("uploadSubmit").style.display = "inline-block";
}

function sizeImage() {
    let mainImage = document.getElementById("changeImg");
    mainImage.style.width = "75%";
    mainImage.style.height = mainImage.style.width;
}