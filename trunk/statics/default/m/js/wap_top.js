
$(window).scroll(

    function () {

      if ($(window).scrollTop() > 200) {

        $("#returnTop").fadeIn("slow");

      }

      else {

        $("#returnTop").fadeOut("slow");

      }

    }

  );
  $("#returnTop").click(function () {

    $("html,body").animate({ scrollTop: 0 },"fast");

  })