<?php
    session_start();
    if (isset($_SESSION['name'])) { 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Homepage</title>
    <link rel="stylesheet" href="../css/admin/sidebar.css">
    <link rel="stylesheet" href="../css/admin/admin-main.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  
</head>
<body>
<div class="sidebar" id="sidebar">
        <div class="sidebar-header">
        <button class="toggle-btn" id="toggleBtn">
                <i class="fas fa-bars"></i>
            </button>
            <a href='../admin/homepage.php' class="sidebar-title">Witchcraft.code</a>
        </div>

        <div class="profile-section">
            <img src="../image/witchghost.png" alt="Admin" class="profile-pic">
            <div class="profile-info">
                <h4><?php echo $_SESSION['name']; ?></h4>
                <p>Administrator</p>
            </div>
        </div>
        <div class="sidebar-content">
            <a href="../admin/profile/profile.php" class="sidebar-item">
            <i class="fa-solid fa-id-badge"></i>
                <span>Profile</span>
            </a>
            <a href="../admin/playerList/playerList.php" class="sidebar-item">
            <i class="fa-solid fa-user-group"></i>
                <span>Player List</span>
            </a>
            <a href="../admin/QA/QA.php" class="sidebar-item">
                <i class="fas fa-question"></i>
                <span>Q&A List</span>
            </a>
            <a href="../admin/leaderboard/leaderboard.php" class="sidebar-item active">
                <i class="fas fa-trophy"></i>
                <span>Leaderboard</span>
            </a>
            <a href="../admin/certificate/certificate.php" class="sidebar-item">
                <i class="fas fa-certificate"></i>
                <span>Certificate</span>
            </a>
            <a href="../admin/feedback/feedback.php" class="sidebar-item">
            <i class="fa-solid fa-comments"></i>
                <span>Feedback</span>
            </a>
            <a href="../login_register/logout.php" class="sidebar-item">
                <i class="fas fa-sign-out-alt"></i>
                <span>Log Out</span>
            </a>
        </div>
    </div>

    <div class="main-content">
        <div class="main-content-items">
            <div class="main-title">
                <h2>Functions</h2>
            </div>
            <div class="alteration">
                <ul>
                    <li><a href="../admin/profile/profile.php">Profile</a></li>
                    <li><a href="../admin/playerList/playerList.php">Player list</a></li>
                    <li><a href="../admin/leaderboard/leaderboard.php">View leaderboard</a></li>
                    <li><a href="../admin/certificate/certificate.php">Certificate list</a></li> 
                    <li><a href="../admin/feedback/feedback.php">Feedback</a></li>  
                </ul>
        </div>
        <div class="main-content-items">
            <div class="main-title">
                <h2><a href="../admin/QA/QA.php">Question and Answer alteration</a></h2>
            </div>
            <div class="alteration">
                <ul>
                    <li><a href="../admin/QA/EP1/ep1.php">EP1</a></li>
                    <li><a href="../admin/QA/ep2/ep2.php">EP2</a></li>
                    <li><a href="../admin/QA/EP3/ep3.php">EP3</a></li>
                    <li><a href="../admin/QA/EP4/ep4.php">EP4</a></li>
                </ul>
            </div>
        </div>
       
            <div class="main-title">
            <h2><center>Analysis for Overall Performance</center></h2>
            </div>
            <div class="charts">
            <div class="chart-container">
                <canvas id="topPerformersChart"></canvas>
            </div>
            <div class="chart-container">
                <canvas id="percentileDonutChart" ></canvas>
            </div>
            <div class="chart-container">
                <canvas id="episodeMetricsChart"></canvas>
            </div>
            
            <div class="chart-container">
                <canvas id="episodeChart"></canvas>
            </div>
                </div>
            </div>
            </div>
 
                        
                    
    <script src="../Javascript/sidebar.js"></script>
    <script>
        fetch('../admin/analysis/api.php')
            .then(response => response.json())
            .then(data => {
                createTopPerformersChart(data.topPerformers);
                createEpisodeChart(data.episodeProgress);
                createEpisodeMetricsChart(data.episodeMetrics);
                createPercentileDonutChart(data.percentileDistribution);
            })
            .catch(error => console.error('Error:', error));


        function createTopPerformersChart(data) {
            new Chart(document.getElementById('topPerformersChart'), {
                type: 'bar',
                data: {
                    labels: data.map(item => item.userId),
                    datasets: [{
                        label: 'Total Score',
                        data: data.map(item => item.totalScore),
                        backgroundColor: 'rgba(255, 159, 64, 0.6)'
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        title: {
                            display: true,
                            text: 'Top Performers'
                        }
                    }
                }
            });
        }

        function createEpisodeChart(data) {
            new Chart(document.getElementById('episodeChart'), {
                type: 'bar',
                data: {
                    labels: data.map(item => item.episodeId),
                    datasets: [{
                        label: 'Number of Users',
                        data: data.map(item => item.userCount),
                        backgroundColor: 'rgba(54, 162, 235, 0.6)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        title: {
                            display: true,
                            text: 'Number of Users per Episode'
                        },
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        x: {
                            title: {
                                display: true,
                                text: 'Episode ID'
                            }
                        },
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Number of Users'
                            }
                        }
                    }
                }
            });
        }
        function createEpisodeMetricsChart(data) {
    new Chart(document.getElementById('episodeMetricsChart'), {
        type: 'bar',
        data: {
            labels: data.map(item => 'Episode ' + item.EPISODE_ID),
            datasets: [
                {
                    type: 'bar',
                    label: 'Average Total Score',
                    data: data.map(item => item.avg_total_score_per_episode),
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1,
                    yAxisID: 'y-axis-score'
                },
                {
                    type: 'bar',
                    label: 'Average Score',
                    data: data.map(item => item.avg_score),
                    backgroundColor: 'rgba(255, 206, 86, 0.2)',
                    borderColor: 'rgba(255, 206, 86, 1)',
                    borderWidth: 1,
                    yAxisID: 'y-axis-score'
                }
            ]
        },
        options: {
            responsive: true,
            plugins: {
                title: {
                    display: true,
                    text: 'Episode Metrics'
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            let label = context.dataset.label || '';
                            if (label) {
                                label += ': ';
                            }
                            return label + context.formattedValue;
                        }
                    }
                }
            },
            scales: {
                x: {
                    stacked: true,
                    title: {
                        display: true,
                        text: 'Episodes'
                    }
                },
                'y-axis-score': {
                    type: 'linear',
                    display: true,
                    position: 'left',
                    title: {
                        display: true,
                        text: 'Score'
                    },
                    ticks: {
                        callback: function(value) {
                            return value.toFixed(0);
                        }
                    }
                }
            }
        }
    });
}

        function createPercentileDonutChart(data) {
    const ctx = document.getElementById('percentileDonutChart').getContext('2d');
    if (ctx) { // Check if context is obtained
        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: data.map(item => item.percentile),
                datasets: [{
                    data: data.map(item => item.count),
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.6)',
                        'rgba(54, 162, 235, 0.6)',
                        'rgba(255, 206, 86, 0.6)',
                        'rgba(75, 192, 192, 0.6)',
                        'rgba(153, 102, 255, 0.6)',
                        'rgba(255, 159, 64, 0.6)',
                        'rgba(199, 199, 199, 0.6)',
                        'rgba(83, 102, 255, 0.6)',
                        'rgba(60, 186, 84, 0.6)',
                        'rgba(251, 99, 142, 0.6)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)',
                        'rgba(199, 199, 199, 1)',
                        'rgba(83, 102, 255, 1)',
                        'rgba(60, 186, 84, 1)',
                        'rgba(251, 99, 142, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    title: {
                        display: true,
                        text: 'User Percentiles Distribution'
                    },
                    legend: {
                        position: 'top'
                    }
                }
            }
        });
    } else {
        console.error('Failed to get canvas context');
    }
}


    </script>
</body>
</html>
<?php
    } else {
        header("Location: ../../login_register/login.php");
    }