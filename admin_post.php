<?php
    session_start(); 
    if(!isset($_SESSION["user"])) {
      header("location:login.php");
    }
    include_once("model/user.php");
    include_once("model/post.php");

    $current_user = unserialize($_SESSION["user"]);
    
    $post = Post::getPost($current_user->id);
    
    include_once('header.php');
    include_once('nav.php');
?>

<div class="container pt-5">
    <a class="btn btn-outline-info float-right" href="create_post.php"><i class="fas fa-plus-circle"></i> New Post</a>
    <table class="table mt-5">
        <thead class="thead-dark">
            <tr class="text-center">
                <th>Title</th>
                <th>Content</th>
                <th>Description</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($post as $key => $value){ ?>
            <tr data-id="<?php echo $value->id ?>">
                <td class="ad-post-title"><?php echo $value->title ?></td>
                <td class="ad-post-content"><?php echo $value->content ?></td>
                <td class="ad-post-description"><?php echo $value->description ?></td>
                <td>
                    <a href="edit_post.php?post_id=<?php echo $value->id ?>" class="btn btn-sm btn-outline-info"><i class="fas fa-pencil-alt"></i></a>
                    <span class="btn btn-sm btn-outline-danger"><i class="fas fa-trash-alt"></i></span>
                    <span class="btn btn-sm btn-outline-info"><i class="far fa-file-pdf"></i></span>
                    <span class="btn btn-sm btn-outline-primary"><i class="fas fa-reply"></i></span>

                </td>
            </tr>
            <?php } ?>    
        </tbody>
    </table>
</div>
<?php 
    include_once('footer.php');
?>