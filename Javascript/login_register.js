function closeLogin() {
    window.location.href = "../index.html";
}

function handleLogin() {
    window.location.href = "../login_register/login_register.php";
}

function togglePasswordVisibility() {
    const passwordInput = document.querySelector('input[name="password"]');
    const toggleIcon = document.querySelector('.password-toggle-icon i');

    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        toggleIcon.classList.remove('fa-eye-slash');
        toggleIcon.classList.add('fa-eye');
    } else {
        passwordInput.type = 'password';
        toggleIcon.classList.remove('fa-eye');
        toggleIcon.classList.add('fa-eye-slash');
    }
}

function PasswordVisibility() {
    const passwordInputs = document.querySelectorAll('input[name="new_pass"], input[name="new_pass_c"]');
    const passwordIcons = document.querySelectorAll('.password-icon i');

    passwordInputs.forEach((input, index) => {
        if (input.type === 'password') {
            input.type = 'text';
            passwordIcons[index].classList.remove('fa-eye-slash');
            passwordIcons[index].classList.add('fa-eye');
        } else {
            input.type = 'password';
            passwordIcons[index].classList.remove('fa-eye');
            passwordIcons[index].classList.add('fa-eye-slash');
        }
    });
}


const inputBorders = document.querySelectorAll(".form__input-border"),
    buttonBorders = document.querySelectorAll(".form__button-border"),
    buttonBgFilled = document.querySelectorAll(".filled .form__button-bg"),
    loginForm = document.querySelector(".login-form"),
    signupForm = document.querySelector(".signup-form"),
    signupBtn = loginForm.querySelector("#signup-btn"),
    loginBtn = signupForm.querySelector("#login-btn");

function clipBorder(element, innerEdgeSize, outerEdgeSize, borderWidth) {
    let elementWidth = element.offsetWidth,
        elementHeight = element.offsetHeight;

    let clipPath = `path("M ${borderWidth},${elementHeight - innerEdgeSize - borderWidth} L ${innerEdgeSize + borderWidth},${elementHeight - borderWidth} H ${
        elementWidth - borderWidth
    }  V ${innerEdgeSize + borderWidth} L ${elementWidth - innerEdgeSize - borderWidth},${borderWidth}  H ${borderWidth} V ${elementHeight - innerEdgeSize - borderWidth} Z M ${
        elementWidth - outerEdgeSize
    },0 L ${elementWidth},${outerEdgeSize} V ${elementHeight} H ${outerEdgeSize} L 0,${elementHeight - outerEdgeSize} V 0 H ${elementWidth - outerEdgeSize} Z")`;

    element.style.clipPath = clipPath;
}

function clipBg(element, edgeSize) {
    let elementWidth = element.offsetWidth,
        elementHeight = element.offsetHeight;

    let clipPath = `path("M 0,0 V ${elementHeight - edgeSize} L ${edgeSize},${elementHeight} H ${elementWidth} V ${edgeSize} L ${elementWidth - edgeSize},0 H 0 Z")`;
    element.style.clipPath = clipPath;
}

function applyClipBorder(elements, innerEdgeSize, outerEdgeSize, borderWidth) {
    if (typeof elements === "string") elements = document.querySelectorAll(elements);
    elements.forEach((element) => {
        clipBorder(element, innerEdgeSize, outerEdgeSize, borderWidth);
    });
}

function applyClipBg(elements, edgeSize) {
    if (typeof elements === "string") elements = document.querySelectorAll(elements);
    elements.forEach((element) => {
        clipBg(element, edgeSize);
    });
}

window.addEventListener("load", () => {
    applyClipBorder(inputBorders, 16, 17, 2.5);
    applyClipBorder(buttonBorders, 16, 17, 2.5);
    applyClipBorder(".form_checkbox-border", 7, 8, 2.5);
    applyClipBg(buttonBgFilled, 15);
    applyClipBg(".form_checkbox", 8);
});

window.addEventListener("resize", () => {
    applyClipBorder(inputBorders, 16, 17, 2.5);
    applyClipBorder(buttonBorders, 16, 17, 2.5);
    applyClipBg(buttonBgFilled, 15);
});

signupBtn.addEventListener("click", (e) => {
    e.preventDefault();
    loginForm.classList.remove("show");
    signupForm.classList.add("show");
});

loginBtn.addEventListener("click", (e) => {
    e.preventDefault();
    signupForm.classList.remove("show");
    loginForm.classList.add("show");
});

const appSlider = new Swiper(".app__slider", {
    loop: true,
    effect: "fade",
    allowTouchMove: false,
    autoplay: {
        delay: 6000,
        disableOnInteraction: false,
    },
});

appSlider.on("slideChangeTransitionStart", () => {
    const app = document.querySelector(".app");
    if (app.classList.contains("purple")) app.classList.replace("purple", "green");
    else if (app.classList.contains("green")) app.classList.replace("green", "brown");
    else if (app.classList.contains("brown")) app.classList.replace("brown", "purple");
});