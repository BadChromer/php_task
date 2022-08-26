<?php
    $connect = mysqli_connect("localhost", "root", "", "user_info");

    if (isset($_POST['submit'])) { 
        $search = $_POST['search'];
        if (!empty($search)) { 
            if (strlen($search) < 3) {
                echo '<p>Слишком короткий поисковый запрос.</p>';
            }
            else {
                $sql = "SELECT postId, body FROM comments WHERE body LIKE '%$search%'";
                $query = mysqli_query($connect, $sql);
                while ($row = mysqli_fetch_assoc($query)) {
                    $postid = $row['postId'];
                    $sql2 = "SELECT title FROM posts WHERE id = $postid";
                    $query2 = mysqli_query($connect, $sql2);
                    while ($result_row = mysqli_fetch_assoc($query2)) {
                        echo "<p>Post ID: ".$row['postId']."</p><p>Post title: ".$result_row['title']."</p><p>Comment: ".$row['body']."</p><hr>";
                    }
                }
            }
        }
        else {
            echo "<p>Поле поиска не должно быть пустым.</p>";
        }
    } 
?>