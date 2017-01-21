  <!DOCTYPE html>
  <html>
    <head>
      <!--Import Google Icon Font-->
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
      <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>

      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    </head>

  <body style="background: url('circuit_board_art-wallpaper-1920x1080.jpg') no-repeat center center fixed;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;">
      <!--Import jQuery before materialize.js-->
      <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
      <script type="text/javascript" src="js/materialize.min.js"></script>
      <script src="Source/simple-modal.js" type="text/javascript" charset="utf-8"></script>
      <script src="http://crypto-js.googlecode.com/svn/tags/3.1.2/build/rollups/md5.js"></script>
            <script>
 $(document).ready(function(){
    // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
    $('.modal').modal();
  });
</script>
 <div id="card" class="row">
             <div class="row"></div>
             <div class="row"></div>
                <div class="row"></div>
             <div class="row"></div>
                <div class="row"></div>
             <div class="row"></div>
                <div class="row"></div>
             <div class="row"></div>
                <div class="row"></div>
             <div class="row"></div>
                <div class="row"></div>
             <div class="row"></div>
                <div class="row"></div>
            
        <div class="col s6 offset-s3">
             <p class="z-depth-5">
                    <form class="col s12"  action="generate_qrcode.php" method="post">
          <div class="card blue-grey darken-1">
            <div class="card-content white-text">
              <span class="card-title">Generate Qr Code</span>
              <div class="row">
 
      <div class="row">
        <div class="input-field col s4">
          <input placeholder="Enter the Person's name Name here" id="name" type="text" name="firstname" class="validate" required>
          <label for="name">Name</label>
           </div>
        <div class="input-field col s7">
          <input placeholder="Enter the Person's Email" id="email" type="email" name="email" class="validate" required>
          <label for="email">Email</label>
        </div>
     
      </div>
       <div class="row">
        <div class="input-field col s12">
          <input id="password" type="password" name="password" class="validate" required>
          <label for="password">Enter the autehntication code to grant invitation</label>
        </div>
      </div>

  </div>
            </div>
             <p class="z-depth-5">
            <div class="card-action">
  <button class="btn waves-effect waves-light" type="submit" name="action">Submit
    <i class="material-icons right">send</i>
  </button>
  </p>
      </form>
            </div>
          </div>
          </p>
        </div>
      </div>
      <div class="container" id="code">    
      <div class="row"></div>
             <div class="row"></div>
                <div class="row"></div>
             <div class="row"></div>
                <div class="row"></div>
             <div class="row"></div>
                <div class="row"></div>
             <div class="row"></div>
                <div class="row"></div>
             <div class="row"></div>
                <div class="row"></div>
             <div class="row"></div>
                <div class="row"></div>
                <div class="col s6 offset-s4"><img class="materialboxed" id="qrcode" width="650" src=""></div></div>
                 
      <script>
      /*
      document.getElementById("code").style.visibility = "hidden";
      function getqrcode(){
            Materialize.toast('name :' + document.getElementById("name").value, 4000) // 4000 is the duration of the toast

          $.ajax({
  type: "POST",
  url: "generate_qrcode.php",
 //   dataType: "json",
  data: {name : document.getElementById("name").value, email : document.getElementById("email").value},
   success: function (response) {
           // you will get response from your php page (what you echo or print)                 
          // Materialize.toast(response.name) // 4000 is the duration of the toast
        //    $('#modal1').modal('open');
            
            document.getElementById("card").style.visibility = "hidden";
            document.getElementById("qrcode").src ="qrcode.png"
            document.getElementById("code").style.visibility = "visible";
            openModal();
            //document.getElementById("invite_of").innerHTML = "This is the invite for :" + document.getElementById("name").value;
            
        },
});
}
  function verifyPasword() {
  }

        function openModal (){
  var SM = new SimpleModal();
      SM.show({
        "model":"modal-ajax",
        "title": document.getElementById("name").value + "'s Invite is",
        "param":{
          "url":"qrcode.png",
          "onRequestComplete": function(){ }
        }
      });
        }
           $(document).ready(function(){
    $('.materialboxed').materialbox();
  });
  */
      </script>
          
    </body>
  </html>
  