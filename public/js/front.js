// OPEN QA

const buttons = document.querySelectorAll("#qa-button");

for (let index = 0; index < buttons.length; index++) {
  let hidden = true;
  buttons[index].addEventListener("click", (event) => {
    let item = event.target.closest("li");
    if (hidden) {
      item.classList.add("qa-item");
      hidden = false;
    } else {
      item.classList.remove("qa-item");

      hidden = true;
    }
  });
}

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

// COMPANY CARDS
const companyCards = document.querySelectorAll(".company-card");
const companyDetail = document.querySelector("#company-card-detail");

for (let index = 0; index < companyCards.length; index++) {
  const card = companyCards[index];

  card.addEventListener("click", (event) => {
    let selectedCard = event.target?.closest("li");
    for (let index = 0; index < companyCards.length; index++) {
      companyCards[index].classList.remove("active-company-card");
    }
    selectedCard.classList.add("active-company-card");
    companyDetail.innerHTML = DETAILS[selectedCard.id];
  });
}

// CARDS SCROLL

const baseSettings = {
  slidesPerView: 2,
  spaceBetween: 20,
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
  breakpoints: {
    700: {
      slidesPerView: 3,
      spaceBetween: 20,
    },
    1215: {
      slidesPerView: 4,
      spaceBetween: 20,
    },
  },
};

new Swiper(".companies-slider", { ...baseSettings });

new Swiper(".articles-slider", {
  ...baseSettings,
  //autoplay: true,
  //loop: true,
});

if (window.matchMedia("(max-width: 840px)").matches) {
  map.dragging.disable();
}