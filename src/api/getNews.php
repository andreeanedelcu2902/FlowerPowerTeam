<?php
require 'config.php';

function getNews() {
    $sql = "SELECT full_name
            FROM screen_actor_guild_awards
            GROUP BY full_name
            ORDER BY COUNT(*) DESC
            LIMIT 10";

    $conn = mysqli_connect('localhost', 'root', '', 'prtw');
    $result = mysqli_query($conn, $sql);

    $news = array();

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $actorName = $row['full_name'];
            if (!empty($actorName)) {
                $apiKey = '130e4b683803cfef9425e511a96e7f80';
                $apiEndpoint = "https://gnews.io/api/v4/search";

                $query = http_build_query([
                    'q' => $actorName,
                    'apikey' => $apiKey,
                    'lang' => 'en',
                    'max' => 5
                ]);

                $url = $apiEndpoint . '?' . $query;

                // Initialize cURL
                $ch = curl_init();

                // Set cURL options
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

                // Execute the cURL request
                $response = curl_exec($ch);

                // Check for errors
                if ($response === false) {
                    echo "Error accessing the API: " . curl_error($ch);
                    return $news;
                }

                // Close cURL resource
                curl_close($ch);

                $data = json_decode($response, true);

                if (isset($data['articles'])) {
                    $articles = $data['articles'];

                    if (!empty($articles)) {
                        foreach ($articles as $article) {
                            if (!isset($article['title']) || !isset($article['description']) || !isset($article['url'])) {
                                continue;
                            }

                            $title = $article['title'];
                            $description = $article['description'];
                            $url = $article['url'];
                            $image = $article['image']; 


                            $news[] = array(
                                'title' => $title,
                                'description' => $description,
                                'url' => $url,
                                'image' => $image
                            );
                        }
                    }
                } else {
                    ;
                }
            }
        }
    }

    mysqli_close($conn);

    return $news;
}
?>
