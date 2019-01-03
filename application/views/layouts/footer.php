<?php if($this->session->userdata('userSessId') ): ?>
  <div class="footer">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <p class="pull-left">Last In: <?php echo date("F d Y h:i:A", strtotime($this->session->userdata('lastIn') ) ); ?></p>
          <p class="pull-right">Elapsed time : {elapsed_time}</p>
        </div>
      </div>
    </div>
  </div>
<?php endif; ?>
<script src="https://apis.google.com/js/client:platform.js?onload=renderButton" async defer></script>
<script src="<?php echo base_url().'assets/bootstrap/js/bootstrap.min.js' ?>"></script>
<script src="<?php echo base_url().'assets/js/bootstrap-typeahead.js' ?>"></script>

<script>
function onSuccess(googleUser) {
  var profile = googleUser.getBasicProfile();
  gapi.client.load('plus', 'v1', function () {
    var request = gapi.client.plus.people.get({
      'userId': 'me'
    });
    //Display the user details
    request.execute(function (resp) {
      var postForm = {
        'user_name' : resp.displayName,
        'user_email' : resp.emails[0].value,
        'user_uname' : resp.name.givenName
      };
      $.ajax({
        url: "/users/insertGoogleInfo",
        type: "POST",
        data: postForm
      }).success(function(res) {
        window.location = "/";
      });
    });
  });
}

function onFailure(error) {}

$(function() {
  $(window).load(function() {
    gapi.load('auth2', function() {
      gapi.auth2.init();
    });
  })
})

function renderButton() {
    gapi.signin2.render('gSignIn', {
        'scope': 'profile email',
        'width': 240,
        'height': 50,
        'longtitle': true,
        'theme': 'dark',
        'onsuccess': onSuccess,
        'onfailure': onFailure
    });
}

function signOut() {
  var auth2 = gapi.auth2.getAuthInstance().signOut();
  auth2.then(function () {
    console.log('User signed out.');
    document.location.href = "https://www.google.com/accounts/Logout?continue=https://appengine.google.com/_ah/logout?continue=http://localhost/users/logout";
  });
}
</script>
<script src="<?php echo base_url().'assets/js/script.js' ?>"></script>
</body>
</html>