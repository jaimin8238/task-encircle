const nav = document.querySelector("#main-nav"),
  toggle = document.querySelector(".menu-toggle");
toggle?.addEventListener("click", () => {
  const open = toggle.getAttribute("aria-expanded") !== "true";
  toggle.setAttribute("aria-expanded", String(open));
  toggle.setAttribute(
    "aria-label",
    open ? "Close navigation" : "Open navigation",
  );
  nav.classList.toggle("open", open);
});
document.addEventListener("keydown", (e) => {
  if (e.key === "Escape" && nav?.classList.contains("open")) {
    nav.classList.remove("open");
    toggle.setAttribute("aria-expanded", "false");
    toggle.focus();
  }
});
document.querySelectorAll("[data-carousel]").forEach((el) => {
  const slides = [...el.querySelectorAll(".quote-slide")];
  let index = 0,
    nextAdvance = Date.now() + 11000,
    paused = matchMedia("(prefers-reduced-motion: reduce)").matches;
  const counter = el.querySelector("[data-counter]");
  const show = (n) => {
    index = (n + slides.length) % slides.length;
    slides.forEach((s, i) => (s.hidden = i !== index));
    counter.textContent = `${index + 1} / ${slides.length}`;
  };
  const pauseButton = el.querySelector("[data-pause]");
  const updatePause = () => {
    pauseButton.textContent = paused ? "Play" : "Pause";
    pauseButton.setAttribute("aria-pressed", String(paused));
    pauseButton.setAttribute(
      "aria-label",
      paused ? "Play automatic testimonials" : "Pause automatic testimonials",
    );
  };
  pauseButton.addEventListener("click", () => {
    paused = !paused;
    nextAdvance = Date.now() + 11000;
    updatePause();
  });
  updatePause();
  const manual = (n) => {
    show(n);
    nextAdvance = Date.now() + 11000;
  };
  el.querySelector("[data-prev]").addEventListener("click", () =>
    manual(index - 1),
  );
  el.querySelector("[data-next]").addEventListener("click", () =>
    manual(index + 1),
  );
  let start = 0;
  el.addEventListener(
    "touchstart",
    (e) => {
      start = e.touches[0].clientX;
      nextAdvance = Date.now() + 11000;
    },
    { passive: true },
  );
  el.addEventListener(
    "touchend",
    (e) => {
      const delta = e.changedTouches[0].clientX - start;
      if (Math.abs(delta) > 40) manual(index + (delta < 0 ? 1 : -1));
    },
    { passive: true },
  );
  setInterval(() => {
    if (!paused && !document.hidden && Date.now() >= nextAdvance) {
      show(index + 1);
      nextAdvance = Date.now() + 11000;
    }
  }, 1000);
});
let galleries = null,
  current = [],
  gi = 0,
  lastTrigger = null;
const dialog = document.querySelector("#gallery"),
  gImage = document.querySelector("#gallery-image"),
  gCaption = document.querySelector("#gallery-caption");
async function openGallery(key, trigger) {
  try {
    if (!galleries) {
      const res = await fetch("galleries.json");
      if (!res.ok) throw Error("Could not load gallery");
      galleries = await res.json();
    }
    current = galleries[key] || [];
    if (!current.length) return;
    gi = 0;
    lastTrigger = trigger;
    renderGallery();
    dialog.showModal();
  } catch (e) {
    trigger.insertAdjacentHTML(
      "afterend",
      '<p class="draft-note">The gallery could not load. Please refresh and try again.</p>',
    );
  }
}
function renderGallery() {
  const item = current[gi];
  gImage.src = item.src;
  gImage.alt = item.caption;
  gCaption.textContent = `${item.caption} · ${gi + 1} / ${current.length}`;
  document.querySelector(".gallery-prev").hidden = current.length < 2;
  document.querySelector(".gallery-next").hidden = current.length < 2;
}
function nextGallery(delta) {
  gi = (gi + delta + current.length) % current.length;
  renderGallery();
}
document
  .querySelectorAll("[data-gallery]")
  .forEach((b) =>
    b.addEventListener("click", () => openGallery(b.dataset.gallery, b)),
  );
document
  .querySelector(".gallery-close")
  ?.addEventListener("click", () => dialog.close());
document
  .querySelector(".gallery-prev")
  ?.addEventListener("click", () => nextGallery(-1));
document
  .querySelector(".gallery-next")
  ?.addEventListener("click", () => nextGallery(1));
dialog?.addEventListener("close", () => lastTrigger?.focus());
dialog?.addEventListener("keydown", (e) => {
  if (e.key === "ArrowLeft") nextGallery(-1);
  if (e.key === "ArrowRight") nextGallery(1);
});
let gx = 0;
dialog?.addEventListener("touchstart", (e) => (gx = e.touches[0].clientX), {
  passive: true,
});
dialog?.addEventListener(
  "touchend",
  (e) => {
    const d = e.changedTouches[0].clientX - gx;
    if (Math.abs(d) > 45) nextGallery(d < 0 ? 1 : -1);
  },
  { passive: true },
);
const form = document.querySelector("#contact-form");
function setInquiry(value) {
  const allowed = ["project", "service", "showroom", "general"];
  if (!allowed.includes(value)) value = "project";
  form.querySelector("[name=inquiry]").value = value;
  document
    .querySelectorAll("[data-inquiry]")
    .forEach((b) =>
      b.setAttribute("aria-pressed", String(b.dataset.inquiry === value)),
    );
  form.querySelector(".showroom-fields").hidden = value !== "showroom";
  form.querySelector(".form-status").innerHTML = "";
}
if (form) {
  document
    .querySelectorAll("[data-inquiry]")
    .forEach((b) =>
      b.addEventListener("click", () => setInquiry(b.dataset.inquiry)),
    );
  const params = new URLSearchParams(location.search);
  setInquiry(params.get("inquiry") || "project");
}
document.querySelectorAll("form[data-demo]").forEach((f) =>
  f.addEventListener("submit", (e) => {
    e.preventDefault();
    const status = f.querySelector(".form-status");
    if (f.dataset.demo === "newsletter") {
      status.textContent = f.dataset.previewMessage || "";
    } else {
      const visit = f.querySelector("[name=inquiry]").value === "showroom";
      status.innerHTML =
        '<div class="form-success"><strong>Preview of the confirmation message</strong><p>' +
        (visit
          ? "Thank you for reaching out to Cedar Mill Co. We’ve received your showroom visit request and will be in touch to confirm the appointment."
          : "Thank you for reaching out to Cedar Mill Co. We’ve received your message and will be in touch soon.") +
        '</p><p class="draft-note">This is a preview. No message has been sent.</p></div>';
      status.scrollIntoView({ block: "nearest", behavior: "smooth" });
    }
  }),
);
ß