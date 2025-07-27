// global options
let ENABLE_PAGE_PRELOADER = true, DEFAULT_DARK_MODE = false, USE_LOCAL_STORAGE = true, USE_SYSTEM_PREFERENCES = false, DEFAULT_BREAKPOINTS = {
    xs: 0,
    sm: 576,
    md: 768,
    lg: 992,
    xl: 1200,
    xxl: 1400
};

const html = document.documentElement;

document.addEventListener("DOMContentLoaded", (() => {
    html.classList.add("dom-ready");
}));

// scroll width variable
const updateScrollWidth = () => {
    document.documentElement.style.setProperty("--body-scroll-width", `${window.innerWidth - document.documentElement.clientWidth}px`);
};

window.addEventListener("resize", updateScrollWidth);

updateScrollWidth();

// breakpoints as classes
const setupBp = (bp, bpSize, type = "min") => {
    const media = matchMedia(`(${type}-width: ${bpSize}px)`), cls = `bp-${bp}${type === "max" ? "-max" : ""}`, update = () => html.classList.toggle(cls, media.matches);
    media.onchange = update;
    update();
};

Object.entries(DEFAULT_BREAKPOINTS).forEach((([bp, bpSize]) => {
    setupBp(bp, bpSize, "min");
    setupBp(bp, bpSize - 1, "max");
}));

// initial dark mode
const isDarkMode = () => html.classList.contains("uc-dark");

const setDarkMode = enableDark => {
    enableDark = !!enableDark;
    if (isDarkMode() === enableDark) return;
    html.classList.toggle("uc-dark", enableDark);
    window.dispatchEvent(new CustomEvent("darkmodechange"));
};

const getInitialDarkMode = () => USE_LOCAL_STORAGE && localStorage.getItem("darkMode") !== null ? localStorage.getItem("darkMode") === "1" : USE_SYSTEM_PREFERENCES ? matchMedia("(prefers-color-scheme: dark)").matches : DEFAULT_DARK_MODE;

setDarkMode(getInitialDarkMode());

// dark mode by URL
const dark = new URLSearchParams(location.search).get("dark");

if (dark) html.classList.toggle("uc-dark", dark === "1");

// Preloader basic styles and init state
if (ENABLE_PAGE_PRELOADER && document.documentElement.classList.contains("show-preloader")) {
    (async () => {
        const t0 = Date.now();
        await new Promise((r => document.addEventListener("DOMContentLoaded", r)));
        html.classList.remove("show-preloader");
        await new Promise((r => requestAnimationFrame(r)));
        await new Promise((r => setTimeout(r, Math.max(0, 500 - (Date.now() - t0)))));
        const preloader = document.querySelector(".uc-pageloader");
        if (!preloader) return;
        preloader.style.transition = "opacity 1.1s cubic-bezier(0.8, 0, 0.2, 1)";
        preloader.style.opacity = 0;
        await new Promise((r => setTimeout(r, 1100)));
        preloader.remove();
    })();
}

// Schema toggle via URL
const queryString = window.location.search;

const urlParams = new URLSearchParams(queryString);

const getSchema = urlParams.get("schema");

if (getSchema === "dark") {
    setDarkMode(1);
} else if (getSchema === "light") {
    setDarkMode(0);
}