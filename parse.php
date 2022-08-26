<?php
    $connect = mysqli_connect("localhost", "root", "", "user_info");
    $db_table_names = ["posts", "comments"];

    function count_json_data($table_name) {
        return count(json_decode(file_get_contents("https://jsonplaceholder.typicode.com/$table_name")));
    }

    foreach ($db_table_names as $table_name) {
        $data = file_get_contents("https://jsonplaceholder.typicode.com/$table_name");
        $json_data = json_decode($data, true);
        if ($table_name == "posts") {
            foreach ($json_data as $row) {
                $sql = "INSERT INTO posts (userId, id, title, body)
                        VALUES ('".$row["userId"]."', '".$row["id"]."', '".$row["title"]."', '".$row["body"]."')";
                mysqli_query($connect, $sql);
            }
        }
        elseif ($table_name == "comments") {
            foreach ($json_data as $row) {
                $sql = "INSERT INTO comments (postId, id, name, email, body)
                        VALUES ('".$row["postId"]."', '".$row["id"]."', '".$row["name"]."', '".$row["email"]."', '".$row["body"]."')";
                mysqli_query($connect, $sql);
            }
        }
    }

    $posts_count = count_json_data($db_table_names[0]);
    $comments_count = count_json_data($db_table_names[1]);

    echo "Загружено $posts_count записей и $comments_count комментариев";
?>