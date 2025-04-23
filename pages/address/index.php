<?php include("../../includes/header.php") ?>

<div class="container">
  <h1>Direcciones</h1>
  <a href="/address-front/pages/address/create-address.php" class="btn btn-success">Crear Dirección</a>

  <table class="table" id="table">
    <thead>
      <tr>
        <th scope="col">ID</th>
        <th scope="col">Nombre</th>
        <th scope="col">Apellido</th>
        <th scope="col">Correo Electrónico</th>
        <th scope="col">Dirección</th>
        <th scope="col">Acciones</th>
      </tr>
    </thead>
    <tbody>

    </tbody>
  </table>
</div>

<script>
  const { login } = JSON.parse(localStorage.getItem("user")) ?? false;

  if (!login) {
    window.location.href = "/address-front";
  }

  $(document).ready(function () {
    // Realizar la solicitud GET a la URL
    $.ajax({
      url: "http://localhost:8082/address",
      method: "GET",
      success: function (data) {
        if (Array.isArray(data)) {
          $("#addresses-table tbody").empty();

          // Iterar sobre los datos y agregar filas a la tabla
          data.forEach(function (address) {
            var row = `<tr>
            <th scope="row" class="text-danger">${address.id}</th>
            <td>${address.first_name}</td>
            <td>${address.last_name}</td>
            <td>${address.email}</td>
            <td>${address.address}</td>
            <td>
              <a href="#" class="btn btn-primary" data-id="${address.id}">Editar</a>
              <button class="btn btn-danger" data-id="${address.id}">Eliminar</button>
            </td>
          </tr>`;

            // Añadir la fila al cuerpo de la tabla
            $("#table tbody").append(row);
          });
        }
      },
      error: function () {
        alert("Ocurrió un error al cargar las direcciones");
      }
    });
  });

  // Función para eliminar una dirección
  $(document).on("click", ".btn-danger", function () {
    const $button = $(this);
    const addressId = $button.data("id");

    if (confirm("¿Estás seguro de eliminar esta dirección?")) {
      $.ajax({
        url: `http://localhost:8082/address/id/${addressId}`,
        method: "DELETE",
        success: function () {
          alert("Dirección eliminada exitosamente");

          $button.closest("tr").remove();
        },
        error: function () {
          alert("Error al eliminar la dirección");
        }
      });
    }
  });


  $(document).on("click", ".btn-primary", function () {
    var addressId = $(this).data("id");
    window.location.href = `/address-front/pages/address/edit-address.php?id=${addressId}`;
  });


</script>

<?php include("../../includes/footer.php") ?>