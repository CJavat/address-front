<?php include("../../includes/header.php") ?>

<div class="container p-4">
  <h2>Editar Dirección</h2>
  <form id="edit-form">
    <input type="hidden" id="address-id" name="id">

    <div class="mb-3">
      <label for="first-name" class="form-label">Nombre</label>
      <input type="text" class="form-control" id="first-name" name="first_name" required>
    </div>

    <div class="mb-3">
      <label for="last-name" class="form-label">Apellido</label>
      <input type="text" class="form-control" id="last-name" name="last_name" required>
    </div>

    <div class="mb-3">
      <label for="email" class="form-label">Correo Electrónico</label>
      <input type="email" class="form-control" id="email" name="email" required>
    </div>

    <div class="mb-3">
      <label for="address" class="form-label">Dirección</label>
      <input type="text" class="form-control" id="address" name="address" required>
    </div>

    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
  </form>
</div>

<script>
  const urlParams = new URLSearchParams(window.location.search);
  const addressId = urlParams.get('id');

  const { login } = JSON.parse(localStorage.getItem("user")) ?? false;

  if (!login) {
    window.location.href = "/address-front";
  }

  $(document).ready(function () {
    if (addressId) {
      $.ajax({
        url: `http://localhost:8082/address/id/${addressId}`,
        method: "GET",
        success: function (data) {
          if (data) {
            // Rellenar el formulario con los datos obtenidos
            $('#address-id').val(data.id);
            $('#first-name').val(data.first_name);
            $('#last-name').val(data.last_name);
            $('#email').val(data.email);
            $('#address').val(data.address);
          }
        },
        error: function () {
          alert("Error al cargar los datos de la dirección.");
        }
      });
    }
  });

  // Enviar la solicitud para actualizar la dirección
  $("#edit-form").on("submit", function (e) {
    e.preventDefault();

    const data = {
      id: $('#address-id').val(),
      first_name: $('#first-name').val(),
      last_name: $('#last-name').val(),
      email: $('#email').val(),
      address: $('#address').val(),
    };

    $.ajax({
      url: `http://localhost:8082/address/${data.id}`,
      method: "PUT",  // Usamos PUT para actualizar
      contentType: "application/json",
      data: JSON.stringify(data),
      success: function () {
        alert("Dirección actualizada con éxito");
        window.location.href = "/address-front/pages/address";
      },
      error: function () {
        alert("Error al actualizar la dirección");
      }
    });
  });
</script>

<?php include("../../includes/footer.php") ?>