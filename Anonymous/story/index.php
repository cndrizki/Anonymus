<?php
    if (isset($_POST['like'])) {
        $story_id = $_POST['story_id'];
        $user_id = $_SESSION['user_id'];
        $created_at = date('Y-m-d H:i:s');
        $updated_at = date('Y-m-d H:i:s');
        
        $query = "INSERT INTO likes (story_id, user_id, created_at, updated_at) VALUES ('$story_id', '$user_id', '$created_at', '$updated_at')";
        $result = mysqli_query($koneksi, $query);
        if ($result) {
            echo "<script>
                alert('Liked.');
                window.location.href='index.php?p=story';
            </script>";
        }
    }

    if (isset($_POST['commentBtn'])) {
        $story_id = $_POST['story_id'];
        $user_id = $_SESSION['user_id'];
        $comment = htmlspecialchars(strip_tags($_POST['comment']));
        $created_at = date('Y-m-d H:i:s');
        $updated_at = date('Y-m-d H:i:s');
        
        $query = "INSERT INTO comments (story_id, user_id, comment, created_at, updated_at) VALUES ('$story_id', '$user_id', '$comment', '$created_at', '$updated_at')";
        $result = mysqli_query($koneksi, $query);
        if ($result) {
            echo "<script>
                alert('Commented.');
                window.location.href='index.php?p=story';
            </script>";
        }
    }
?>

<section class="post" id="post">
    <div class="container-fluid">
        <div class="post-header">
            <div class="image">
                <img src="images/user.png" class="img-fluid">
            </div>
            <h1 class="font-new-rocker text-uppercase text-white">Anonymous</h1>
        </div>
        <div class="post-content">
            <div class="row">
                <div class="col-md-4 col-sm-12 mb-2">
                    <a href="index.php?p=storyadd" class="btn btn-custome-white d-block">Add</a>
                </div>
                <div class="col-md-4 col-sm-12 mb-2">
                    <a href="index.php?p=mystory" class="btn btn-custome-white d-block">My Story</a>
                </div>
                <div class="col-md-4 col-sm-12 mb-2">
                    <a href="index.php?p=story" class="btn btn-custome-white d-block">All Story</a>
                </div>
            </div>
            <div class="container mt-4">

                <?php
                    $sql_story = "SELECT * FROM stories ORDER BY id DESC";
                    $result_story = mysqli_query($koneksi, $sql_story);
                    while ($row=mysqli_fetch_assoc($result_story)) {
                ?>
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="form-group row mb-2">
                                <div class="col-md-1 col-sm-12 text-center">
                                    <img src="images/user.png" class="img-fluid">                                        
                                </div>
                                <div class="col-md-11">
                                    <textarea class="form-control" rows="3" placeholder="Create your story" readonly><?= $row['story'] ?></textarea>
                                </div>
                            </div>
                            <div class="form-group row text-left">
                                <div class="col-md-1 col-sm-12 text-center"></div>
                                <div class="col-md-11 d-flex">
                                    <?php
                                        $sql_like = "SELECT count(*) as total_like, story_id, user_id, id FROM likes WHERE story_id = '$row[id]'";
                                        $sql_like2 = "SELECT story_id, user_id, id FROM likes WHERE story_id = '$row[id]'";
                                        $result_like = mysqli_query($koneksi, $sql_like);
                                        $result_like2 = mysqli_query($koneksi, $sql_like2);
                                        $like = mysqli_fetch_assoc($result_like);
                                        $jum_like = $like['total_like'];
                                        $liked = '';
                                        while ($value=mysqli_fetch_assoc($result_like2)) {
                                            if ($value['user_id'] == $_SESSION['user_id']) {
                                                $liked .= 'liked';
                                            }
                                        }
                                        $sql_comment = "SELECT count(*) as total_comment, story_id, user_id, id, comment FROM comments WHERE story_id = '$row[id]'";
                                        $sql_comment2 = "SELECT story_id, user_id, id, comment FROM comments WHERE story_id = '$row[id]'";
                                        $result_comment = mysqli_query($koneksi, $sql_comment);
                                        $result_comment2 = mysqli_query($koneksi, $sql_comment2);
                                        $comment = mysqli_fetch_assoc($result_comment);
                                        $jum_comment = $comment['total_comment'];
                                        if($liked == 'liked') {
                                    ?>
                                        <p class="font-new-rocker f-s-10">
                                            <i class="fa fa-heart text-danger f-s-20"></i> <?= $jum_like ?> Like
                                        </p>
                                    <?php
                                        } else {
                                    ?>
                                        <form action="" method="post">
                                            <input type="hidden" name="story_id" value="<?= $row['id'] ?>">
                                            <button type="submit" name="like" class="font-new-rocker f-s-10 text-n-decor text-black button-like"><i class="fa-regular fa-heart text-danger f-s-20"></i> <?= $jum_like ?> Like</button>
                                        </form>
                                    <?php
                                        }
                                    ?>
                                    <a href="javascript:void(0)" id="showComment<?= $row['id'] ?>" class="ml-2 font-new-rocker f-s-10 text-n-decor text-black"><i class="fa-regular fa-comment f-s-20 text-primary"></i> <?= $jum_comment ?> Comment</a>
                                    <?php 
                                        if($_SESSION['user_id'] == $row['user_id']) {
                                    ?>
                                        <i class="text-success font-new-rocker ml-2">My Story</i>
                                    <?php
                                        }
                                    ?>
                                </div>
                            </div>
                            <div class="form-group" id="commentForm<?= $row['id'] ?>">
                                <div class="container">

                                    <form method="post" id="createForm<?= $row['id'] ?>">
                                        <input type="hidden" name="story_id" value="<?= $row['id'] ?>">
                                        <div class="row mt-2">
                                            <div class="col-md-1 col-sm-12 text-center">
                                                <img src="images/user.png" class="img-fluid">
                                            </div>
                                            <div class="col-md-11">
                                                <textarea name="comment" class="form-control" rows="3" placeholder="Create your comment"></textarea>
                                                <button type="submit" id="createComment<?= $row['id'] ?>" class="btn btn-custom font-nerko-one mt-2">Post</button>
                                                <a href="javascript:void(0)" id="closeComment<?= $row['id'] ?>" class="btn btn-custom font-nerko-one mt-2">Close</a>
                                            </div>
                                        </div>
                                    </form>

                                    <?php
                                        if ($jum_comment > 0) {
                                            while ($value=mysqli_fetch_assoc($result_comment2)) {
                                    ?>
                                        <div class="row mt-2">
                                            <div class="col-md-1 col-sm-12 text-center">
                                                <img src="images/user.png" class="img-fluid">
                                            </div>
                                            <div class="col-md-11 text-left">
                                                <textarea class="form-control" rows="3" placeholder="Create your comment" readonly><?= $value['comment'] ?></textarea>
                                                <div class="d-flex">
                                                    <?php 
                                                        if($_SESSION['user_id'] == $value['user_id']) {
                                                    ?>
                                                        <i class="text-success font-new-rocker ml-2">My Comment</i>
                                                    <?php
                                                        }
                                                        
                                                        if($_SESSION['user_id'] == $row['user_id']) {
                                                    ?>
                                                        <form method="post" id="deleteForm<?= $row['id'] ?>">
                                                            <input type="hidden" name="comment_id" value="<?= $value['id'] ?>">
                                                            <button type="submit" id="deleteComment<?= $row['id'] ?>" class="btn btn-danger font-nerko-one btn-sm ml-2 mt-1"><i class="fa fa-trash"></i> Delete</button>
                                                        </form>
                                                    <?php
                                                        }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                            }
                                        }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
                    }
                ?>
                    
            </div>
        </div>
    </div>
</section>

<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

<?php
    $sql_story = "SELECT * FROM stories ORDER BY id DESC";
    $result_story = mysqli_query($koneksi, $sql_story);
    while ($row=mysqli_fetch_assoc($result_story)) {
?>
<script>
    $(document).ready(function () {
            document.getElementById('commentForm<?= $row['id'] ?>').style.display = 'none';

            $('#showComment<?= $row['id'] ?>').on('click', function () {
                document.getElementById('commentForm<?= $row['id'] ?>').style.display = 'block';
            });

            $('#closeComment<?= $row['id'] ?>').on('click', function () {
                document.getElementById('commentForm<?= $row['id'] ?>').style.display = 'none';
            });

            $("#commentForm<?= $row['id'] ?>").on("submit", "#createForm<?= $row['id'] ?>", function(e) {
                e.preventDefault();
                $.ajax({
                    url: 'story/prosesComment.php?action=add',
                    type: 'post',
                    data: $(this).serialize(),
                    dataType: 'json',
                    success: function(response) {
                        if (response.data == 'success') {
                            window.location.reload();
                        }
                    }
                });
            });

            $("#commentForm<?= $row['id'] ?>").on("submit", "#deleteForm<?= $row['id'] ?>", function(e) {
                e.preventDefault();
                $.ajax({
                    url: 'story/prosesComment.php?action=delete',
                    type: 'post',
                    data: $(this).serialize(),
                    dataType: 'json',
                    success: function(response) {
                        if (response.data == 'success') {
                            window.location.reload();
                        }
                    }
                });
            });
    })
</script>
<?php
    }
?>