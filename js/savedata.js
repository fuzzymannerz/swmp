// Deal with settings page saving
$(function() {
  $("#settingsForm").submit(function(e) {

      e.preventDefault();
      
      var formData = $("#settingsForm").serialize();

      $.ajax({
        type : "POST",
        url: "php/configurator.php",
        data: formData
      })
      .done(function (data) { 
        if (data == "error") {
          $('#settingsError').modal({backdrop:'static', keyboard:false});
          $('#settings_error_content').html(data);
        }else if (data == "saveOK"){
          console.log("Save OK.");

          $('#savedSettings').modal({backdrop:'static', keyboard:false});

          // Redírect back to main page after 3 seconds
          setTimeout(function(){ window.location = "index.php"; }, 3000);
        }

       })
      .fail(function (data) { console.log("Error: " + data); });
  });
});