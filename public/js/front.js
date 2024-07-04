// OPEN QA
const buttons = document.querySelectorAll("#qa-button");

buttons.forEach((button) => {
  button.addEventListener("click", (event) => {
    const item = event.target.closest("li");
    const textElement = item.querySelector("textarea, p"); // Select both textarea and p elements
    const isHidden = textElement.classList.contains("hidden");

    if (isHidden) {
      if (textElement.tagName === "TEXTAREA") {
        textElement.classList.remove("hidden");
        textElement.style.height = "auto";
        textElement.style.height = textElement.scrollHeight + "px";
        textElement.style.opacity = "1";
      } else {
        textElement.classList.remove("hidden");
        textElement.style.height = "auto";
        textElement.style.opacity = "1";
      }
    } else {
      if (textElement.tagName === "TEXTAREA") {
        textElement.style.height = "0";
        textElement.style.opacity = "0";
        textElement.classList.add("hidden");
      } else {
        textElement.style.height = "0";
        textElement.style.opacity = "0";
        textElement.classList.add("hidden");
      }
    }
  });
});

// COPY GIFT LINK

const copyBtn = document.querySelector("#copy-btn");
const copyText = document.querySelector("#copy-text");

copyBtn?.addEventListener("click", () => {
  navigator.clipboard.writeText(copyText?.textContent);
});

// OPEN BURGER MENU
const html = document.querySelector("html");
const headerNav = document.querySelector("#header-nav");
const headerLogo = document.querySelector("#header-logo");
const menuButton = document.querySelector("#burger-btn");
const body = document.querySelector("body");

menuButton.addEventListener("change", () => {
  body.classList.toggle("burger-open");
  html?.classList.toggle("burger-open");
  headerNav?.classList.toggle("slide-nav");
  headerLogo?.classList.toggle("header-logo");
});

// STICKY HEADER
const headerDescktop = document.querySelector("header");

let lastScrollTop = 100;

window.addEventListener("scroll", () => {
  let st = window.scrollY || document.documentElement.scrollTop;
  if (st > lastScrollTop) {
    headerDescktop?.classList.add("sticky-desck");
    headerDescktop?.classList.remove("sticky-desck-up");
  } else if (st < lastScrollTop) {
    headerDescktop?.classList.remove("sticky-desck");
    headerDescktop?.classList.add("sticky-desck-up");
  }
  st == 0 ? headerDescktop?.classList.remove("sticky-desck-up") : "";
  lastScrollTop = st <= 0 ? 0 : st;
});

// CARDS SCROLL

const baseSettings = {
  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev",
  },
  //cssMode: true,
  //autoplay: {
  //  delay: 3000,
  //  pauseOnMouseEnter: true,
  //  reverseDirection: true,
  //},
  loop: true,
};

new Swiper(".companies-slider", {
  ...baseSettings,
  breakpoints: {
    320: {
      slidesPerView: 2,
      spaceBetween: 20,
    },
    700: {
      slidesPerView: 3,
      spaceBetween: 20,
    },
    1215: {
      slidesPerView: 5,
      spaceBetween: 20,
    },
  },
});

new Swiper(".articles-slider", {
  ...baseSettings,
  breakpoints: {
    320: {
      slidesPerView: 2,
      spaceBetween: 20,
    },
    700: {
      slidesPerView: 3,
      spaceBetween: 20,
    },
    1215: {
      slidesPerView: 4,
      spaceBetween: 20,
    },
  },

  //autoplay: true,
  //loop: true,
});

if (window.matchMedia("(max-width: 840px)").matches) {
  map.dragging.disable();
}

// Format Number With Commas
document.addEventListener("DOMContentLoaded", function () {
  function formatNumberWithCommas(number) {
    return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
  }

  // Select all elements with the class 'numwc'
  const elements = document.querySelectorAll(".numwc");

  // Format each element's text content
  elements.forEach((element) => {
    const number = parseInt(element.textContent.replace(/,/g, ""), 10);
    if (!isNaN(number)) {
      element.textContent = formatNumberWithCommas(number);
    }
  });
});

function hexToRgba(hex, alpha) {
  const r = parseInt(hex.slice(1, 3), 16);
  const g = parseInt(hex.slice(3, 5), 16);
  const b = parseInt(hex.slice(5, 7), 16);
  return `rgba(${r}, ${g}, ${b}, ${alpha})`;
}

// Image Uploader
function uploadImage($file) {
  $targetDir = "public/uploads/";
  $targetFile = $targetDir.basename($file["name"]);
  $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

  // Check if image file is a actual image or fake image
  $check = getimagesize($file["tmp_name"]);
  if ($check === false) {
    throw new Exception("File is not an image.");
  }

  // Check if file already exists
  if (file_exists($targetFile)) {
    throw new Exception("Sorry, file already exists.");
  }

  // Check file size
  if ($file["size"] > 5000000) {
    throw new Exception("Sorry, your file is too large.");
  }

  // Allow certain file formats
  if (
    $imageFileType != "jpg" &&
    $imageFileType != "png" &&
    $imageFileType != "jpeg" &&
    $imageFileType != "gif"
  ) {
    throw new Exception("Sorry, only JPG, JPEG, PNG & GIF files are allowed.");
  }

  // Move uploaded file to target directory
  if (!move_uploaded_file($file["tmp_name"], $targetFile)) {
    throw new Exception("Sorry, there was an error uploading your file.");
  }

  return "/".$targetFile;
}