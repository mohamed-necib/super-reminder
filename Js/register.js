const registerForm = document.querySelector("#register");
const signInForm = document.querySelector("#signin");
const switchBtn = document.querySelector("#switch");
const switchSpan = document.querySelector("#spanSwitch");
const registerDiv = document.querySelector(".register");
const signinDiv = document.querySelector(".signin");

function switchForm() {
  if (switchBtn.innerHTML === "S'inscrire") {
    registerDiv.style.display = "block";
    signinDiv.style.display = "none";
    switchBtn.innerHTML = "Se Connecter";
    switchSpan.innerHTML = "Déjà un compte? ";
  } else {
    registerDiv.style.display = "none";
    signinDiv.style.display = "block";
    switchBtn.innerHTML = "S'inscrire";
    switchSpan.innerHTML = "Pas encore de compte? ";
  }
}

async function signin(form) {
  const formData = new FormData(form);
  formData.append("signin", "ok");

  const response = await fetch("authentification.php", {
    method: "POST",
    body: formData,
  });

  const data = await response.text();
  if (data === "ok") {
    location.reload(true);
  }
}

async function register(form) {
  const formData = new FormData(form);
  formData.append("register", "ok");

  const response = await fetch("authentification.php", {
    method: "POST",
    body: formData,
  });

  const data = await response.text();
  if (data === "ok") {
    form.reset();
    switchForm();
  }
}

registerForm.addEventListener("submit", (e) => {
  e.preventDefault();
  register(registerForm);
});
signInForm.addEventListener("submit", (e) => {
  e.preventDefault();
  signin(signInForm);
});

switchBtn.addEventListener("click", () => {
  switchForm();
});
