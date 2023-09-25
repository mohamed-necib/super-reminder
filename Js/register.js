const registerForm = document.querySelector("#register");
const signInForm = document.querySelector("#signin");

async function signin(form) {
  const formData = new FormData(form);
  formData.append("signin", "ok");

  const response = await fetch("authentification.php", {
    method: "POST",
    body: formData,
  });

  const data = await response.text();
  console.log("DATA ========>", data);
}

async function register(form) {
  const formData = new FormData(form);
  formData.append("register", "ok");

  const response = await fetch("authentification.php", {
    method: "POST",
    body: formData,
  });

  const data = await response.text();
  console.log("DATA ========>", data);
}

registerForm.addEventListener("submit", (e) => {
  e.preventDefault();
  register(registerForm);
});
signInForm.addEventListener("submit", (e) => {
  e.preventDefault();
  signin(signInForm);
});
