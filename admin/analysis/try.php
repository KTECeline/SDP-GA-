<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        .chart-container {
            width: 45%;
            margin: 20px;
            display: inline-block;
        }
    </style>
</head>
<body>
    <h1><center>Analysis for Overall Performance</center></h1>

    <div class="chart-container">
        <canvas id="averageScoresChart"></canvas>
    </div>
    <div class="chart-container">
        <canvas id="topPerformersChart"></canvas>
    </div>
    <div class="chart-container">
        <canvas id="episodeChart"></canvas>
    </div>
    <div class="chart-container">
        <canvas id="episodeMetricsChart"></canvas>
    </div>


    <script>
        fetch('../../admin/analysis/api.php')
            .then(response => response.json())
            .then(data => {
                createAverageScoresChart(data.averageScores);
                createTopPerformersChart(data.topPerformers);
                createEpisodeChart(data.episodeProgress);
                createEpisodeMetricsChart(data.episodeMetrics);
            })
            .catch(error => console.error('Error:', error));

        function createAverageScoresChart(data) {
            new Chart(document.getElementById('averageScoresChart'), {
                type: 'line',
                data: {
                    labels: data.map(item => item.episodeId),
                    datasets: [{
                        label: 'Average Score',
                        data: data.map(item => item.averageScore),
                        borderColor: 'rgba(153, 102, 255, 1)',
                        tension: 0.1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        title: {
                            display: true,
                            text: 'Average Scores per Episode'
                        }
                    }
                }
            });
        }

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
                            type: 'line',
                            label: 'Average Time Spent (minutes)',
                            data: data.map(item => item.avg_time_spent / 60), // Convert seconds to minutes
                            backgroundColor: 'rgba(54, 162, 235, 0.2)',
                            borderColor: 'rgba(54, 162, 235, 1)',
                            borderWidth: 1,
                            yAxisID: 'y-axis-time'
                        },
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
                                    if (context.dataset.yAxisID === 'y-axis-time') {
                                        const minutes = Math.floor(context.raw);
                                        const seconds = Math.round((context.raw - minutes) * 60);
                                        return label + minutes + ' min ' + seconds + ' sec';
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
                        'y-axis-time': {
                            type: 'linear',
                            display: true,
                            position: 'left',
                            title: {
                                display: true,
                                text: 'Time (minutes)'
                            },
                            ticks: {
                                callback: function(value) {
                                    return value.toFixed(0) + ' min';
                                }
                            }
                        },
                        'y-axis-score': {
                            type: 'linear',
                            display: true,
                            position: 'right',
                            title: {
                                display: true,
                                text: 'Score'
                            }
                        }
                    }
                }
            });
        }
    </script>
</body>
</html>
