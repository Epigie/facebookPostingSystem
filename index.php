<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Facebook</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" type="text/css" media="screen" href="css/font-awesome.min.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="css/bootstrap.min.css" />   
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
      <div class="container">
        <a class="navbar-brand" href="#">Facebook</a>
      </div>
    </nav>
    <div class="container">
      <div class="row">
        <div class="col-md-6 m-auto">
          <div id="msg"></div>
          <div class="mb-3">
              <form onsubmit="return insertPost();">
                <div class="form-group">
                  <textarea placeholder="Write Something ..." id="content" class="form-control" name="content" rows="3" onkeyup="check();"></textarea>
                </div>
                <button class="btn btn-primary" id="post-btn" type="submit" disabled>Post</button>
              </form>
          </div>
        </div>
      </div> 
      <div class="row">
        <div class="col-md-6 m-auto">
           <div id="posts">
           </div> 
        </div>
      </div>
    </div>
      <!-- Modal -->
      <div class="modal fade editModal" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content" id="edit-modal-content">
          
        </div>
      </div>
    </div>
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/popper.min.js"></script> 
    <script src="js/bootstrap.min.js"></script>
     
    <script src="js/plugin.js"></script>
</body>
</html>