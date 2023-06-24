<?php

require 'config.php';

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    $userId = $_SESSION['id'];

    if (isset($_POST['actorId'])) {
        $actorId = $_POST['actorId'];

        $sql = "INSERT INTO favorite_actors (user_id, actor_id) VALUES ($userId, $actorId)";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            $response = array(
                'status' => 'success',
                'message' => 'Adăugat la favorite!'
            );
            echo json_encode($response);
            
        } else {
            $response['status'] = 'error';
            $response['message'] = 'An error occurred while adding the actor to your favorites list.';
        }

        echo json_encode($response);
        $favoriteActors = getFavoriteActors($userId);
        return $favoriteActors;
    }
}
function getFavoriteActors($userId)
{
    require 'config.php'; 

    $favoriteActors = array(); 

    
    $sql = "SELECT favorite_actors.actor_name
            FROM favorite_actors
            WHERE favorite_actors.user_id = $userId";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $favoriteActors[] = $row;
        }
    }

    return $favoriteActors;
}

?>
