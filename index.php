<?php include("includes/header.php") ?>

<div class="container p-4">
  <form id="form">
    <div class="mb-3">
      <label for="exampleInputEmail1" class="form-label">Correo Electrónico</label>
      <input type="email" class="form-control" name="email" aria-describedby="emailHelp">
    </div>
    <div class="mb-3">
      <label for="exampleInputPassword1" class="form-label">Contraseña</label>
      <input type="password" class="form-control" name="password">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
</div>

<script>
  $("#form").on("submit", function (e) {
    e.preventDefault();

    const data = {
      email: $('input[name="email"]').val(),
      password: $('input[name="password"]').val()
    }

    $.ajax({
      url: "http://localhost:8082/login",
      method: "POST",
      contentType: "application/json",
      data: JSON.stringify(data),
      success: function (res) {
        if (res.ok) {
          localStorage.setItem("user", JSON.stringify({ login: true }));
          window.location.href = "pages/address";
        }
      },
      error: function () {
        alert("Ocurrió un error al iniciar sesión");
      }
    });
  });
</script>

<?php include("includes/footer.php") ?>