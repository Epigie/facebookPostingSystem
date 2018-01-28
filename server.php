<?php
require_once 'connect.php';

if($_SERVER['REQUEST_METHOD'] == 'GET' && $_GET['reqtype'] == 'get'){
    $selectStm = "SELECT * FROM posts INNER JOIN users ON users.id = posts.user_id ORDER BY posts.post_id DESC";
    $selectQuery = $connect->prepare($selectStm);
    $selectQuery->execute();
    $results = $selectQuery->fetchAll();
    foreach($results as $result){
    echo '<div class="post mb-3">
        <div class="card">
            <div class="card-body">
                <i class="fa fa-trash fa-fw float-right text-danger post-action" onclick="deletePost(\'delete\', '.$result['post_id'].')"></i>
                <i class="fa fa-edit fa-fw float-right text-primary post-action editPost" data-toggle="modal"  data-target=".editModal" onclick="getEditPost(\'getEditPost\', '.$result['post_id'].');"></i>
                <h5>'.$result['name'].'</h5>
                <span>'.$result['created_at'].'</span>
                <p>'.$result['post_content'].'</p>
            </div>
        </div>
        </div>';
    }
}else if($_SERVER['REQUEST_METHOD'] == 'GET' && !empty($_GET['post_id']) && $_GET['reqtype'] == 'delete'){
      $postId = $_GET['post_id'];
      $deleteStm = 'DELETE FROM posts WHERE post_id = :id';
      $deleteQuery =$connect->prepare($deleteStm);
      $deleteQuery->bindParam(':id', $postId);
      $check = $deleteQuery->execute();
    //   if($check){
    //       echo '<div class="alert alert-success">Post Deleted</div>';
    //   }else{
    //       echo '<div class="alert alert-danger">Something goes Wrong !!!!</div>';
    //   }
}else if($_SERVER['REQUEST_METHOD'] == 'GET' && !empty($_GET['post_id']) && $_GET['reqtype'] == 'getEditPost'){
   $postId = $_GET['post_id'];
   $editStm = "SELECT * FROM posts WHERE post_id = :postId";
   $editQuery = $connect->prepare($editStm);
   $editQuery->bindParam(':postId', $postId);
   $editQuery->execute();
   $result = $editQuery->fetch();
    echo '<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">Edit Post</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  <form>
  <div class="modal-body">    
        <div class="form-group">
          <textarea  id="editContent" class="form-control" name="editContent" rows="3" autofocus>'.$result['post_content'].'</textarea>
        </div>
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    <button type="submit" class="btn btn-primary"  id="edit-post-btn" onclick="return editPost(\'editPost\','.$result['post_id'].');">Save changes</button>
    </form>
  </div>';
}

if($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['reqtype'] == 'insert'){
    $userId = 5;
    $insertStm = "INSERT INTO posts(`user_id`, `post_content`) VALUES(:userId, :postContent)";
    $insertQuery = $connect->prepare($insertStm);
    $insertQuery->bindParam(':userId', $userId);
    $insertQuery->bindParam(':postContent', $_POST['content']);
    $insertQuery->execute();
}else if($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['reqtype'] == 'editPost'){
   $postId = $_POST['postId'];
   $content = $_POST['content'];
   $editStm = "UPDATE posts SET post_content = :content WHERE post_id=:postId";
   $editQuery = $connect->prepare($editStm);
   $editQuery->bindParam(':content',$content);
   $editQuery->bindParam(':postId', $postId);
   $editQuery->execute();
}

?>
