<?php
    include '../config/koneksi.php';

    session_start();
    if ($_SESSION['user_id'] <> true) {
        echo "<script>
            alert('Anda harus login terlebih dahulu.');
            window.location.href='./index.php?p=login';
        </script>";
    }

    switch ($_GET['action']) {
        case 'add':
            $story_id = $_POST['story_id'];
            $user_id = $_SESSION['user_id'];
            $comment = htmlspecialchars(strip_tags($_POST['comment']));
            $created_at = date('Y-m-d H:i:s');
            $updated_at = date('Y-m-d H:i:s');
            
            $query = "INSERT INTO comments (story_id, user_id, comment, created_at, updated_at) VALUES ('$story_id', '$user_id', '$comment', '$created_at', '$updated_at')";
            $result = mysqli_query($koneksi, $query);
            if ($result) {
                $data = array(
                    'data' => 'success',
                    'status' => '201'
                );
            } else {
                $data = [
                    'data' => 'fail',
                    'status' => '400'
                ];
            }
            echo json_encode($data);
            break;

        case 'delete':
            $comment_id = $_POST['comment_id'];
            
            $query = "DELETE FROM comments WHERE id='$comment_id'";
            $result = mysqli_query($koneksi, $query);
            if ($result) {
                $data = array(
                    'data' => 'success',
                    'status' => '201'
                );
            } else {
                $data = [
                    'data' => 'fail',
                    'status' => '400'
                ];
            }
            echo json_encode($data);
            break;
        
        default:
            # code...
            break;
    }    
?>
