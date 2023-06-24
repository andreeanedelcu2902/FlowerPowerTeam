<?php
    include 'statistics.php';
    include 'getNews.php';
    
?>


<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AcVis-Home</title>
    <link rel="stylesheet" href="../static/styles/style_news.css">
    <script src="../scripts/chart.js-4.3.0/package/dist/chart.umd.js"></script>
</head>
<body>

    <div class="header">
        <img src="../static/styles/resources/BG.png" alt="Imga" class="imga">
        <div class="search-container">
        <form method="POST" action="search.php">
          <input class="search-input" type="text" name="searchInput" placeholder="Search" />
          <button type="submit" class="search-button"><img src="../static/styles/resources/magnifying_glass.png" alt="Search"></button>
        </form>
      </div>
    </div>

    <div class="top">
        <ul class="menu">
          <li><a href="../views/HOME.html" class="home">HOME</a></li>
          <li><a href="news.php" class="news">NEWS</a></li>
          <li><a href="../views/HELP.html" class="help">HELP</a></li>
          <li><a href="account.php" class="account">MY ACCOUNT</a></li>
        </ul>
    </div>
    <div class="sign-up-button">
      <a href="../views/SIGN_UP.html" class="signup-link">Sign Up</a>
  </div>



  <div class="chart-wrapper">

<div class=chart-container>
 <canvas id="chart"></canvas>

<script>

    var actori = <?php echo json_encode($actori); ?>;
    var premii = <?php echo json_encode($premii); ?>;


    var chartData = {
        labels: actori,
        datasets: [{
            label: 'Number of SAG awards',
            data: premii,
            backgroundColor: 'rgba(255, 99, 132, 0.5)',
            borderColor: 'rgba(255, 99, 132, 1)',
            borderWidth: 1
        }]
    };

    var ctx = document.getElementById('chart').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: chartData,
        options: {
            responsive: true,
            aspectRatio: 0.7,
            scales: {
                y: {
                    beginAtZero: true,
                    precision: 0
                }
            },
            plugins: {
                title: {
                display: true,
                text: 'Top 10 actors', 
                font: {
                    size: 24, 
                    family: 'Arial, sans-serif', 
                    weight: 'bold' 
                }, 
                color: 'rgba(255, 99, 71, 0.5)'
                
            },
                legend: {
                    labels: {
                        color: 'rgba(0, 0, 0, 1)'
                        
                    }
                },
                tooltip: {
                    bodyColor: 'rgba(0, 0, 0, 1)' 
                }
            }
        }
    });

    function exportToCSV() {
    var csvContent = "data:text/csv;charset=utf-8,";
    csvContent += "Actor,Number of SAG awards\n";
    for (var i = 0; i < actori.length; i++) {
        csvContent += actori[i] + "," + premii[i] + "\n";
    }
    var encodedURI = encodeURI(csvContent);
    var link = document.createElement("a");
    link.setAttribute("href", encodedURI);
    link.setAttribute("download", "statistici.csv");
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
}

function exportToWebP() {
    var canvas = document.getElementById("chart");
    canvas.toBlob(function(blob) {
        var link = document.createElement("a");
        link.setAttribute("href", URL.createObjectURL(blob));
        link.setAttribute("download", "statistici.webp");
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
    }, "image/webp");
}

function exportToSVG() {
    var chart = document.getElementById("chart");
    var svg = chart.outerHTML;
    var link = document.createElement("a");
    link.setAttribute("href", "data:image/svg+xml;charset=utf-8," + encodeURIComponent(svg));
    link.setAttribute("download", "chart.svg");
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
}



</script>

<button onclick="exportToCSV()" style="background-color: pink; color: 8B008B; padding: 10px 20px; border: 2px solid #8B008B; border-radius: 5px; cursor: pointer;">Export CSV</button>
<button onclick="exportToWebP()" style="background-color: pink; color: 8B008B; padding: 10px 20px; border: 2px solid #8B008B; border-radius: 5px; cursor: pointer;">Export WebP</button>
<button onclick="exportToSVG()" style="background-color: pink; color: 8B008B; padding: 10px 20px; border: 2px solid #8B008B; border-radius: 5px; cursor: pointer;">Export SVG</button>

</div>

<div class=chart-container>
<div id="chartContainer">
<canvas id="topCategoriesChart"></canvas>

<script>


    var categories = <?php echo json_encode($categorii); ?>;
    var votes = <?php echo json_encode($voturi); ?>;

    var chartData = {
        labels: categories,
        datasets: [{
            data: votes,
            backgroundColor: ["#FF6384", "#36A2EB", "#FFCE56", "#4BC0C0", "#9966FF"],
            borderColor: "#FFF",
            borderWidth: 1
        }]
    };

    var ctx = document.getElementById('topCategoriesChart').getContext('2d');
    new Chart(ctx, {
        type: 'pie',
        data: chartData,
        options: {
            responsive: true,
            aspectRatio: 0.7,
            plugins: {
                title: {
                display: true,
                text: 'Top 5 most voted categories', 
                font: {
                    size: 24, 
                    family: 'Arial, sans-serif',
                    weight: 'bold' 
                }, 
                color: 'rgba(255, 99, 71, 0.5)'
            },
                legend: {
                    labels: {
                        color: 'rgba(0, 0, 0, 1)'
                    }
                },
                tooltip: {
                    bodyColor: 'rgba(0, 0, 0, 1)' 
                }
            }
        }
    });

    function exportTopCategoriesToCSV() {
        var csvContent = "data:text/csv;charset=utf-8,";
        csvContent += "Category,Total Votes\n";
        for (var i = 0; i < categories.length; i++) {
            csvContent += categories[i] + "," + votes[i] + "\n";
        }
        var encodedURI = encodeURI(csvContent);
        var link = document.createElement("a");
        link.setAttribute("href", encodedURI);
        link.setAttribute("download", "top_categories.csv");
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
    }

    function exportTopCategoriesToWebP() {
        var canvas = document.getElementById("topCategoriesChart");
        canvas.toBlob(function(blob) {
            var link = document.createElement("a");
            link.setAttribute("href", URL.createObjectURL(blob));
            link.setAttribute("download", "top_categories.webp");
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        }, "image/webp");
    }

    function exportTopCategoriesToSVG() {
        var chart = document.getElementById("topCategoriesChart");
        var svg = chart.outerHTML;
        var link = document.createElement("a");
        link.setAttribute("href", "data:image/svg+xml;charset=utf-8," + encodeURIComponent(svg));
        link.setAttribute("download", "top_categories.svg");
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
    }
</script>

<button onclick="exportTopCategoriesToCSV()" style="background-color: pink; color: 8B008B; padding: 10px 20px; border: 2px solid #8B008B; border-radius: 5px; cursor: pointer;">Export CSV</button>
<button onclick="exportTopCategoriesToWebP()"style="background-color: pink; color: 8B008B; padding: 10px 20px; border: 2px solid #8B008B; border-radius: 5px; cursor: pointer;">Export WebP</button>
<button onclick="exportTopCategoriesToSVG()"style="background-color: pink; color: 8B008B; padding: 10px 20px; border: 2px solid #8B008B; border-radius: 5px; cursor: pointer;">Export SVG</button>

</div>
</div>



<div class=chart-container>
<div id="movieChartContainer" >
    <canvas id="movieChart"></canvas>
</div>

<script>
    var movies = <?php echo json_encode(array_column($movies, 'show')); ?>;
    var nominations = <?php echo json_encode(array_column($movies, 'numar_nominalizari')); ?>;

    var chartData = {
        labels: movies,
        datasets: [{
            label: 'Number of nominations',
            data: nominations,
            backgroundColor: 'rgba(75, 192, 192, 0.5)',
            borderColor: 'rgba(75, 192, 192, 1)',
            borderWidth: 1
        }]
    };

    var ctx = document.getElementById('movieChart').getContext('2d');
    new Chart(ctx, {
        type: 'line',
        data: chartData,
        options: {
            responsive: true,
            aspectRatio: 0.7,
            scales: {
                y: {
                    beginAtZero: true,
                    precision: 0
                }
            },
            plugins: {
                title: {
                display: true,
                text: 'Top 5 most voted shows', 
                font: {
                    size: 24, // Mărimea textului titlului
                    family: 'Arial, sans-serif', // Fontul titlului
                    weight: 'bold' // Grosimea textului titlului
                }, 
                color: 'rgba(255, 99, 71, 0.5)'
            },
                legend: {
                    labels: {
                        color: 'rgba(0, 0, 0, 1)' // Culoarea textului legendei
                    }
                },
                tooltip: {
                    bodyColor: 'rgba(0, 0, 0, 1)' // Culoarea textului in tooltip-uri
                }
            }
        }
    });

    function exportMoviesToCSV() {
        var csvContent = "data:text/csv;charset=utf-8,";
        csvContent += "Show,Număr nominalizări\n";
        for (var i = 0; i < movies.length; i++) {
            var show = movies[i];
            var numarNominalizari = nominations[i];
            csvContent += show + "," + numarNominalizari + "\n";
        }
        var encodedUri = encodeURI(csvContent);
        var link = document.createElement("a");
        link.setAttribute("href", encodedUri);
        link.setAttribute("download", "movies.csv");
        document.body.appendChild(link);
        link.click();
    }

    function exportChartToWebP() {
        var link = document.createElement("a");
        link.href = document.getElementById('movieChart')
            .toDataURL('image/webp')
            .replace('image/webp', 'image/octet-stream');
        link.download = 'movieChart.webp';
        link.click();
    }

    function exportChartToSVG() {
        var svg = document.getElementById('movieChart')
            .toDataURL('image/svg+xml')
            .replace('image/svg+xml', 'image/octet-stream');
        var link = document.createElement("a");
        link.href = svg;
        link.download = 'movieChart.svg';
        link.click();
    }
</script>

<button onclick="exportMoviesToCSV()"style="background-color: pink; color: 8B008B; padding: 10px 20px; border: 2px solid #8B008B; border-radius: 5px; cursor: pointer;">Export CSV</button>
<button onclick="exportChartToWebP()" style="background-color: pink; color: 8B008B; padding: 10px 20px; border: 2px solid #8B008B; border-radius: 5px; cursor: pointer;">Export WebP</button>
<button onclick="exportChartToSVG()" style="background-color: pink; color: 8B008B; padding: 10px 20px; border: 2px solid #8B008B; border-radius: 5px; cursor: pointer;">Export SVG</button>

</div>
</div>

<div class="news-container">
<h2 class="news-title">Other news</h2>
    <?php

        $news = getNews();
        
        if ($news) {
           
            foreach ($news as $article) {
                echo '<div class="article">';
                echo '<h3>' . $article['title'] . '</h3>';
                echo '<p>' . $article['description'] . '</p>';
                echo '<img src="' . $article['image']. '">';
                echo '<a href="' . $article['url'] . '">Read more</a>';
                echo '</div>';
            }
        } else {
            echo '<p>No news available.</p>';
           
        }
    ?>
</div>



</body>
</html>
