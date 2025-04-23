<?php include("../../includes/header.php") ?>

<div class="container p-4">
  <h2>Agregar Dirección</h2>
  <form id="create-form">
    <div class="mb-3">
      <label class="form-label">Nombre</label>
      <input type="text" class="form-control" name="first_name" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Apellido</label>
      <input type="text" class="form-control" name="last_name" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Correo Electrónico</label>
      <input type="email" class="form-control" name="email" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Dirección</label>
      <input type="text" class="form-control" name="address" required>
    </div>
    <button type="submit" class="btn btn-success">Guardar</button>
  </form>
</div>

<script>
  const { login } = JSON.parse(localStorage.getItem("user")) ?? false;

  if (!login) {
    window.location.href = "/address-front";
  }

  $("#create-form").on("submit", function (e) {
    e.preventDefault();

    const data = {
      first_name: $('input[name="first_name"]').val(),
      last_name: $('input[name="last_name"]').val(),
      email: $('input[name="email"]').val(),
      address: $('input[name="address"]').val(),
    };

    $.ajax({
      url: "http://localhost:8082/address",
      method: "POST",
      contentType: "application/json",
      data: JSON.stringify(data),
      success: function () {
        alert("Dirección agregada con éxito");
        window.location.href = "/address-front/pages/address";
      },
      error: function () {
        alert("Error al agregar la dirección");
      }
    });
  });
</script>

<?php include("../../includes/footer.php") ?>