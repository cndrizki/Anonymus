<section class="notif">
    <div class="container">
        <div class="notif-header">
            <div class="image">
                <img src="images/user.png" class="img-fluid">
            </div>
            <h1 class="font-new-rocker text-uppercase text-white">Anonymous</h1>
        </div>
        <div class="notif-content">

            <?php
                $user_id = $_SESSION['user_id'];
                $sql_story_count = "SELECT count(*) as total_story FROM stories WHERE user_id='$user_id'";
                $result_story_count = mysqli_query($koneksi, $sql_story_count);
                $story_count = mysqli_fetch_assoc($result_story_count);
                $jum_story = $story_count['total_story'];

                if ($jum_story > 0) {
                    $sql_story = "SELECT * FROM stories WHERE user_id='$user_id'";
                    $result_story = mysqli_query($koneksi, $sql_story);
                    $story_id = array();
                    while ($story=mysqli_fetch_assoc($result_story)) {
                        $storyId = $story['id'];
                        if (isset($story_id[$storyId])) {
                            $story_id[$storyId] .= $storyId;
                        } else {
                            $story_id[$storyId] = $storyId;
                        }
                    }
                    $date = date('Y-m-d');
    
                    $story_id_array = implode(',', array_map('intval', $story_id));
                    
                    $sql_like_count = "SELECT count(*) as total_like FROM likes WHERE story_id IN ($story_id_array) AND user_id != '$user_id' AND created_at LIKE '$date%'";
                    $result_like_count = mysqli_query($koneksi, $sql_like_count);
                    $like_count = mysqli_fetch_assoc($result_like_count);
                    $jum_like = $like_count['total_like'];
    
                    $sql_comment_count = "SELECT count(*) as total_comment FROM comments WHERE story_id IN ($story_id_array) AND user_id != '$user_id' AND created_at LIKE '$date%'";
                    $result_comment_count = mysqli_query($koneksi, $sql_comment_count);
                    $comment_count = mysqli_fetch_assoc($result_comment_count);
                    $jum_comment = $comment_count['total_comment'];
                } else {
                    $jum_like = 0;
                    $jum_comment = 0;
                }
                
                if($jum_like == 0 && $jum_comment == 0){
            ?>
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-md-12 text-center">
                                <p class="font-new-rocker f-s-30 mt-2">Nofication not found.</p>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
                } else {

                    $sql_like = "SELECT * FROM likes WHERE story_id IN ($story_id_array) AND user_id != '$user_id' AND created_at LIKE '$date%'";
                    $result_like = mysqli_query($koneksi, $sql_like);                
                    while($like = mysqli_fetch_assoc($result_like)) {
            ?>
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="form-group row">
                                <div class="col-md-1 col-sm-12 text-center">
                                    <img src="images/user.png" style="width: 50px;">                                        
                                </div>
                                <div class="col-md-11">
                                    <p class="font-new-rocker f-s-20 mt-2">Someone liked your story.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
                    }

                    $sql_comment = "SELECT * FROM comments WHERE story_id IN ($story_id_array) AND user_id != '$user_id' AND created_at LIKE '$date%'";
                    $result_comment = mysqli_query($koneksi, $sql_comment);                
                    while($comment = mysqli_fetch_assoc($result_comment)) {
                ?>
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="form-group row">
                                <div class="col-md-1 col-sm-12 text-center">
                                    <img src="images/user.png" style="width: 50px;">                                        
                                </div>
                                <div class="col-md-11">
                                    <p class="font-new-rocker f-s-20 mt-2">Someone commented your story.</p>
                                </div>
                            </div>
                        </div>
                    </div>
            <?php 
                    }
                }
            ?>
        </div>
    </div>
</section>