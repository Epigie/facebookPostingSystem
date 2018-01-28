function check(){
    var content = document.getElementById('content').value;
    var postBtn = document.getElementById('post-btn');
    if(content != ''){
        postBtn.removeAttribute('disabled')
    }else{
        postBtn.setAttribute('disabled', 'disabled')
    }
}
//Start Get data

var xhr = new XMLHttpRequest();

function getPost(){
    xhr.onreadystatechange = function(){
        var posts = document.getElementById('posts');

        if(this.readyState == 4 && this.status == 200){
           posts.innerHTML = this.responseText;
        }
    }

    xhr.open('GET', 'server.php?reqtype=get', true);
    xhr.send();
}
getPost();

function insertPost(){
    var content = document.getElementById('content').value;
    xhr.onreadystatechange = function(){
        var posts = document.getElementById('posts');

        if(this.readyState == 4 && this.status == 200){
           posts.innerHTML = this.responseText;
           document.getElementById('content').value = '';
           getPost();
        }
    }

    xhr.open('POST', 'server.php', true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.send('reqtype=insert&&content=' + content);
    return false;   
}

function deletePost(reqtype='', postId = ''){
    var postId = postId;
    var reqtype = reqtype;
    if(confirm('Are You Sure ?')){ 
        xhr.onreadystatechange = function(){
            var posts = document.getElementById('posts');

            if(this.readyState == 4 && this.status == 200){
                
              document.getElementById('msg').innerHTML =  this.responseText;
               getPost(); 
            }
        }

        xhr.open('GET', 'server.php?reqtype='+reqtype+'&&post_id='+ postId, true);
        xhr.send();
  }
}

function getEditPost(reqtype ='', postId = ''){
    var reqtype = reqtype;
    var postId = postId;
    var editContainer = document.getElementById('edit-modal-content');
    xhr.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
           editContainer.innerHTML = this.responseText;
        }
    }

    xhr.open('GET', 'server.php?reqtype='+reqtype+'&&post_id='+ postId, true);
    xhr.send();
}

function editPost(reqtype='', postId=''){  
    var reqtype= reqtype;
    var postId = postId;  
    var content = document.getElementById('editContent').value;
    xhr.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
           posts.innerHTML = this.responseText;
           $('.editModal').modal('hide');
           getPost();
        }
    }

    xhr.open('POST', 'server.php', true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.send('reqtype='+reqtype+'&&postId='+postId+'&&content=' + content);
    return false;   
}