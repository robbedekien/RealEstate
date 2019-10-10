//logout
$("#btnLogout").click(() => {
  $.ajax({
    url: "api/api-logout.php"
  }).done(response => {
    window.location.href = "index";
  });
});

//register - show validation is sent
$("#btnRegister").click(() => {
  $(".error").text("");
  $.ajax({
    url: "api/api-register.php",
    method: "POST",
    data: $("form").serialize(),
    dataType: "JSON"
  }).done(response => {
    if (response.status == 1) {
      $("#registerForm").toggleClass("disabled");
      $("#validateDiv").toggleClass("disabled");
      $.ajax({
        url: "api/api-send-validate-email.php",
        method: "POST",
        data: { id: response.message },
        dataType: "JSON"
      });
    } else {
      $(".error").text(response.message);
    }
  });
});

$("#btnLogin").click(() => {
  $.ajax({
    url: "api/api-login.php",
    method: "POST",
    data: $("form").serialize(),
    dataType: "JSON"
  }).done(response => {
    console.log(response);
    if (response.status == 1) {
      window.location.href = "index";
    } else {
      $(".error").text(response.message);
    }
  });
});

$("#btnProfileMenu").click(() => {
  window.location.href = "profile";
});

$("#btnProfile").click(() => {
  $("#updateBanner").addClass("disabled");
  $.ajax({
    url: "api/api-update-profile.php",
    method: "POST",
    data: $("form").serialize(),
    dataType: "JSON"
  }).done(response => {
    if (response.status == 1) {
      $("#updateBanner").removeClass("disabled");
    } else {
      $(".error").text(response.message);
    }
  });
});

$("#propertyImages").change(function(e) {
  if (e.target.files.length > 0) {
    var fileName = e.target.files[0].name;
    $(".custom-file-label").text(fileName);
  }
});

$("form#propertyAddForm").submit(e => {
  e.preventDefault();
  var formData = new FormData(document.getElementById("propertyAddForm"));

  $.ajax({
    url: "api/api-add-property.php",
    type: "POST",
    data: formData,
    dataType: "JSON",
    success: function(data) {
      if (data.status == 1) {
        window.location.href = "index";
      } else {
        $(".error").text(data.message);
      }
    },
    cache: false,
    contentType: false,
    processData: false
  });
});

$("#searchNavbar").on("input", e => {
  if (window.location.href == "http://localhost/ProjectWebDevCph/index") {
    $.ajax({
      url: "api/api-search.php",
      method: "POST",
      data: { searchValue: $("#searchNavbar").val() },
      dataType: "JSON"
    }).done(response => {
      $(".property").hide();
      jQuery.each(response, function() {
        console.log(`#${this}`);
        $(`#${this}`).show();
      });
    });
  }
});

if (window.location.href !== "http://localhost/ProjectWebDevCph/index") {
  $("#searchForm").hide();
}

$(".delete").click(e => {
  Swal.fire({
    title: "Are you sure?",
    text: "You won't be able to revert this!",
    type: "warning",
    showCancelButton: true,
    confirmButtonColor: "#4b830d",
    cancelButtonColor: "#d33",
    confirmButtonText: "Yes, delete it!"
  }).then(result => {
    if (result.value) {
      let id = e.target.id.split("_")[1];
      Swal.fire("Deleted!", "The property has been deleted.", "success");
      $(`#prop${id}`).modal("hide");
      $(`#${id}`).hide();
      $.ajax({
        url: "api/api-delete-property.php",
        method: "POST",
        data: { id: id },
        dataType: "JSON"
      });
    }
  });
});

$("form#propertyUpdateForm").submit(e => {
  e.preventDefault();
  var formData = new FormData(document.getElementById("propertyUpdateForm"));

  $.ajax({
    url: "api/api-update-property.php",
    type: "POST",
    data: formData,
    dataType: "JSON",
    success: function(data) {
      if (data.status == 1) {
        console.log("test");
        $("#updateBanner").removeClass("disabled");
      } else {
        $(".error").text(data.message);
      }
    },
    cache: false,
    contentType: false,
    processData: false
  });
});

$("#btnDeleteProfile").click(e => {
  Swal.fire({
    title: "Are you sure?",
    text: "You won't be able to revert this!",
    type: "warning",
    showCancelButton: true,
    confirmButtonColor: "#4b830d",
    cancelButtonColor: "#d33",
    confirmButtonText: "Yes, delete it!"
  }).then(result => {
    if (result.value) {
      Swal.fire("Deleted!", "Your profile has been deleted.", "success").then(
        () => {
          window.location.href = "index";
        }
      );
      $.ajax({
        url: "api/api-delete-profile.php",
        method: "POST",
        dataType: "JSON"
      }).done(response => {});
    }
  });
});
