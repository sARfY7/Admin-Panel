const product_image = document.getElementById("product_image");
const preview = document.querySelector(".product__preview");

product_image.addEventListener("change", productImageChangeHandler);

function productImageChangeHandler() {
  preview.innerHTML = "";
  previewImages(this);
}

function previewImages(inp) {
  if (inp.files) {
    [].forEach.call(inp.files, readAndPreview);
  }

  function readAndPreview(file) {
    const reader = new FileReader();

    reader.addEventListener("load", function() {
      const image = new Image();
      image.title = file.name;
      image.src = this.result;
      preview.appendChild(image);
    });

    reader.readAsDataURL(file);
  }
}
