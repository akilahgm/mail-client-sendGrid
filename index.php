<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="custom.css">
    <script src="jquery.min.js"></script>
</head>
<body>

 



    <button onclick="document.getElementById('id01').style.display='block'" style="width:auto;" class="btn-success">Subscribe</button>
    <div id="id01" class="modal">
      <form class="modal-content animate" action="action.php" method="POST">
        <div class="imgcontainer">
          <span onclick="document.getElementById('id01').style.display='none'" class="close" title="CLOSE">&times;</span>
      </div>
      <div class="container">
            <h1><b>Want to help on home <br>improvement</b></h1>
            <h4>Join others to recieve our exclusive articles where we share our <br> best advice on home improvement.</h4>
            <input type="text" placeholder="Enter email" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}" required>
            <button type="submit" class="btn-primary" name="submit">subscribe</button>
          <h5>Your Email is safe with us and we do not share it.</h5>
        </div>
</form>
</div>

<div class="sendBox">
  <form method="get" action="action.php">
    <label>Subject: </label>
    <input type="text" name="subject" required>
    <br>
    <label>Body: </label>
    <textarea rows="5" cols="76" name="msg" required>
    </textarea>
    <br>
    <button type="submit" name="send">send</button>
  </form>
</div>



<script>
// Get the modal
var modal = document.getElementById('id01');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>

</body>
</html>
