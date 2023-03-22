var users = (function () {
  var instance = {};

  input_listener();
  initDataTable(instance);

  var form_add_user = null;
  var form_delete_user = null;
  $(document).ready(function () {
    form_add_user = new bootstrap.Modal(
      document.getElementById("form-add-user"),
      {
        keyboard: false,
      }
    );
    form_delete_user = new bootstrap.Modal(
      document.getElementById("form-delete-user"),
      {
        keyboard: false,
      }
    );
  });
  function initDataTable(instance) {
    var table = new DataTable("#dt-users", {
      dom: "Bfrtip",
      buttons: [
        {
          text: "Add User",
          attr: {
            class: "btn btn-primary",
            type: "button",
            id: "btn-add-user",
          },
          action: onAddUserClicked,
        },
        {
          text: "Update",
          attr: {
            class: "btn btn-warning",
            type: "button",
            id: "btn-edit-user",
          },
          action: onUpdateClicked,
        },
        {
          text: "Delete",
          attr: {
            class: "btn btn-danger",
            type: "button",
            id: "btn-delete-user",
          },
          action: onDeleteClicked,
        },
      ],
      columnDefs: [
        {
          orderable: false,
          className: "select-checkbox",
          targets: 0,
        },
        {
          visible: false,
          targets: 1,
        },
      ],
      select: {
        style: "multi",
        selector: "td:first-child",
      },
      order: [[1, "asc"]],
    });
    instance.dt = table;
  }

  function onAddUserClicked(e, dt, node, config) {
    $("#form-add-user #id").remove();
    $("#img-preview-container").empty();
    var formAddUser = $("#form-add-user");
    formAddUser.find("#name").val(null);
    formAddUser.find("#email").val(null);
    formAddUser.find("#phone").val(null);
    formAddUser.find("#username").val(null);
    formAddUser.find("#address").val(null);

    formAddUser.find("form").prop("action", path.baseurl + "users/store");
    form_add_user.show();
  }

  function onUpdateClicked(e, dt, node, config) {
    var data = instance.dt.rows({ selected: true }).data();
    if (data.length != 1) {
      alert("Pilih Satu baris data");
      $(node).prop("disabled", false);
      return;
    }
    data = data[0];
    var formAddUser = $("#form-add-user");
    formAddUser
      .find("form")
      .append(
        "<input id='id' type='hidden' name='id' value='" + data[1] + "'>"
      );

    formAddUser.find("#name").val(data[2]);
    formAddUser.find("#email").val(data[4]);
    formAddUser.find("#phone").val(data[5]);
    formAddUser.find("#username").val(data[3]);
    $("#form-add-user #role option:contains(" + data[7] + ")")
      .prop("selected", true)
      .parent()
      .trigger("change");
    formAddUser.find("#address").val(data[6]);
    console.log(data[7]);
    if (data[8] != "Tidak Ada Photo") {
      $("#img-preview-container").append(data[8]);
      formAddUser
        .find("form")
        .append(
          "<input type='hidden' name='old_pp' value='" +
            $("#avatar-" + data[1]).attr("src") +
            "'>"
        );
    }
    formAddUser.find("form").prop("action", path.baseurl + "users/update");

    form_add_user.show();
  }

  function onDeleteClicked() {
    var data = instance.dt.rows({ selected: true }).data();
    if (data.length == 0) {
      alert("Pilih Minimal Satu baris data");
      $(node).prop("disabled", false);
      return;
    }
    var ids = [];
    data.map((e) => ids.push(e[1]));
    console.log(ids);
    $("#form-delete-user form #ids").val(ids);
    $("#form-delete-user form #pp").val(ids);
    form_delete_user.show();
  }

  function refreshTable(data) {
    instance.dt.destroy();
    var tbody = $("#dt-users tbody");
    tbody.empty();

    rows = "";

    data.forEach((row) => {
      var imgEl = row.avatar
        ? "<img style='width: 40%; height: auto' src='" + row.avatar + ">"
        : "Tidak Ada Photo";
      row +=
        "<tr><td></td>" +
        "<td>" +
        row.id +
        "</td>" +
        "<td>" +
        row.nama +
        "</td>" +
        "<td>" +
        row.username +
        "</td>" +
        "<td>" +
        row.email +
        "</td>" +
        "<td>" +
        row.phone +
        "</td>" +
        "<td>" +
        row.address +
        "</td>" +
        "<td>" +
        row.role_name +
        "</td>" +
        "<td>" +
        imgEl +
        "</td>" +
        "</tr>";
    });

    tbody.append(rows);
    initDataTable();
  }

  function input_listener() {
    $("#avatar").change(function () {
      var preview = $("#img-preview-container");
      preview.empty();
      var [file] = this.files;

      if (file) {
        var image =
          "<img id='img-preview' src='" +
          URL.createObjectURL(file) +
          "' style='width:25%'>";
        preview.append(image);
      } else preview.empty();
    });
  }

  var aku = {
    initDT: initDataTable,
  };

  return aku;
})();
