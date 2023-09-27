const deconnectBtn = document.querySelector("#deconnect");

deconnectBtn.addEventListener("click", async () => {
  console.log("click");
  const data = new FormData();
  data.append("disconnect", "ok");

  const key = await fetch("authentification.php", {
    method: "POST",
    body: data,
  });

  window.location.href = "index.php";
});
