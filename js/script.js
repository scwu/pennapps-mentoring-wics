$(document).ready(function(){
    
    $(window).bind('scroll',chk_scroll);
    $('#pennapps-mentor-submit').click(function(evt) {
      evt.preventDefault();
      var name = $('#name').val();
      var year = $('#year').val();
      var major = $('#major').val();
      var email = $('#email').val();
      var comments = $('#comments').val();
      $.ajax({
        url: "/send.php",
            type: "POST",
            dataType: "json",
            data: {
              'name' : name,
              'year' : year,
              'major' : major,
              'email' : email,
              'comments' : comments
            },
            success: function(response) {
              if (response['Response'] == 'Success') {
                $('#signup_form').empty();
                $('#signup_form').append('<p>Congrats, you have signed up for the PennApps Mentorship Program. Stay Tuned for more info.</p>');
              } else {
                $('form').prepend('<p>' + response['Error'] + ' Please try again.</p>');
                
              }
             },
            error: function() {
              alert("Error");
            },
      });
  });
});

function chk_scroll(e)
{
  e.stopPropagation();
    var height = $('#myCarousel').height();
    if ($(this).scrollTop() > height) {
      $('.navbar').removeClass('transparent');
      $('.navbar').addClass('navbar-inverse');
    }
    else if ($(this).scrollTop() < height) {
      $('.navbar').addClass('transparent');
      $('.navbar').removeClass('navbar-inverse');
    }
}
