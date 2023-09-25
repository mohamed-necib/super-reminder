const registerForm = document.querySelector("#register");

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
