const product_image = document.getElementById("product_image");
const preview = document.querySelector(".product__preview");
const categories = document.querySelectorAll(".category");
const add_product_form = document.getElementById("add-product-form");

const modal_overlay = document.querySelector(".modal__overlay");
const modal_msg = document.querySelector(".modal__msg");
const modal_btn = document.querySelector(".modal__btn");

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

categories.forEach(category => {
  category.addEventListener("click", categoryClickHandler);
});

function categoryClickHandler() {
  this.firstElementChild.checked = true;
  const siblingElements = getSiblings(this);
  siblingElements.forEach(siblingElement => {
    siblingElement.classList.remove("checked");
  });
  this.classList.add("checked");
}

const getSiblings = function(elem) {
  // Setup siblings array and get the first sibling
  const siblings = [];
  let sibling = elem.parentNode.firstChild;

  // Loop through each sibling and push to the array
  while (sibling) {
    if (sibling.nodeType === 1 && sibling !== elem) {
      siblings.push(sibling);
    }
    sibling = sibling.nextSibling;
  }

  return siblings;
};

add_product_form.onsubmit = function(e) {
  e.preventDefault();
  const fd = new FormData(this);
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      modal_msg.innerHTML = this.responseText;
      modal_overlay.classList.add("show");
      preview.innerHTML = "";
      document.body.style.overflowY = "hidden";
    }
  };
  xhttp.open("POST", "addProduct.php", true);
  xhttp.send(fd);
};

modal_btn.onclick = function() {
  modal_overlay.classList.remove("show");
  modal_msg.innerHTML = "";
  document.body.style.overflowY = "auto";
  add_product_form.reset();
};
