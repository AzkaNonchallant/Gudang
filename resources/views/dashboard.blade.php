<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        :root {
            --primary-color: #4361ee;
            --secondary-color: #3f37c9;
            --accent-color: #4895ef;
            --success-color: #4cc9f0;
            --text-dark: #2b2d42;
            --text-light: #8d99ae;
            --bg-light: #f8f9fa;
            --card-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            --border-radius: 16px;
        }
        
        body {
            background-color: var(--bg-light);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: var(--text-dark);
        }
        
        .dashboard-header {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            padding: 2rem 0;
            margin-bottom: 2rem;
            border-radius: 0 0 var(--border-radius) var(--border-radius);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
        
        .dashboard-title {
            font-weight: 700;
            margin-bottom: 0.5rem;
        }
        
        .dashboard-subtitle {
            font-weight: 300;
            opacity: 0.9;
        }
        
        .stats-card {
            background: white;
            border-radius: var(--border-radius);
            box-shadow: var(--card-shadow);
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            border: none;
            transition: transform 0.3s, box-shadow 0.3s;
        }
        
        .stats-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12);
        }
        
        .chart-container {
            background: white;
            border-radius: var(--border-radius);
            box-shadow: var(--card-shadow);
            padding: 1.5rem;
            margin-bottom: 2rem;
            border: none;
        }
        
        .chart-header {
            display: flex;
            justify-content: between;
            align-items: center;
            margin-bottom: 1.5rem;
        }
        
        .chart-title {
            font-weight: 600;
            color: var(--text-dark);
            margin: 0;
        }
        
        .chart-actions {
            display: flex;
            gap: 0.5rem;
        }
        
        .btn-chart-action {
            background: var(--bg-light);
            border: 1px solid #e9ecef;
            border-radius: 8px;
            padding: 0.4rem 0.8rem;
            font-size: 0.85rem;
            color: var(--text-light);
            transition: all 0.2s;
        }
        
        .btn-chart-action:hover {
            background: var(--primary-color);
            color: white;
            border-color: var(--primary-color);
        }
        
        .btn-chart-action.active {
            background: var(--primary-color);
            color: white;
            border-color: var(--primary-color);
        }
        
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }
        
        .stat-item {
            background: white;
            border-radius: var(--border-radius);
            box-shadow: var(--card-shadow);
            padding: 1.5rem;
            text-align: center;
            transition: transform 0.3s;
        }
        
        .stat-item:hover {
            transform: translateY(-5px);
        }
        
        .stat-value {
            font-size: 2rem;
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: 0.5rem;
        }
        
        .stat-label {
            color: var(--text-light);
            font-size: 0.9rem;
        }
        
        .stat-icon {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
            background: rgba(67, 97, 238, 0.1);
            color: var(--primary-color);
            font-size: 1.5rem;
        }
        
        @media (max-width: 768px) {
            .stats-grid {
                grid-template-columns: 1fr;
            }
            
            .chart-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
            }
            
            .chart-actions {
                width: 100%;
                justify-content: space-between;
            }
        }
    </style>
</head>
<body>
    <div class="dashboard-header">
        <div class="container">
            <h1 class="dashboard-title">Dashboard</h1>
            <p class="dashboard-subtitle">Overview of stock inventory and trends</p>
        </div>
    </div>

    <div class="container">
        <!-- Stats Summary -->
        <div class="stats-grid">
            <div class="stat-item">
                <div class="stat-icon">
                    📦
                </div>
                <div class="stat-value">
                    {{ is_array($values) ? array_sum($values) : $values->sum() }}
                </div>
                <div class="stat-label">Total Stock Items</div>
            </div>
            <div class="stat-item">
                <div class="stat-icon">
                    📅
                </div>
                <div class="stat-value">
                    {{ is_array($labels) ? count($labels) : $labels->count() }}
                </div>
                <div class="stat-label">Tracking Days</div>
            </div>
            <div class="stat-item">
                <div class="stat-icon">
                    📈
                </div>
                <div class="stat-value">
                    {{ is_array($values) ? max($values) : $values->max() }}
                </div>
                <div class="stat-label">Peak Stock Day</div>
            </div>
            <div class="stat-item">
                <div class="stat-icon">
                    ⏱️
                </div>
                <div class="stat-value">
                    @php
                        $valuesArray = is_array($values) ? $values : $values->toArray();
                        $count = is_array($labels) ? count($labels) : $labels->count();
                        $average = $count > 0 ? array_sum($valuesArray) / $count : 0;
                    @endphp
                    {{ round($average, 1) }}
                </div>
                <div class="stat-label">Average Daily Stock</div>
            </div>
        </div>

        <!-- Chart Section -->
        <div class="chart-container">
            <div class="chart-header">
                <h2 class="chart-title">Stock Trend Over Time</h2>
                <div class="chart-actions">
                    <button class="btn-chart-action" id="weekView">Week</button>
                    <button class="btn-chart-action" id="monthView">Month</button>
                    <button class="btn-chart-action active" id="allView">All</button>
                </div>
            </div>
            <canvas id="stokChart" height="100"></canvas>
        </div>

        <!-- Additional Info Cards -->
        <div class="row">
            <div class="col-md-6">
                <div class="stats-card">
                    <h5>Recent Stock Activity</h5>
                    <p class="text-muted">Latest stock movements and updates</p>
                    <ul class="list-group list-group-flush">
                        @php
                            $labelsArray = is_array($labels) ? $labels : $labels->toArray();
                            $valuesArray = is_array($values) ? $values : $values->toArray();
                        @endphp
                        @if(count($labelsArray) > 0)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Latest entry
                                <span class="badge bg-primary rounded-pill">{{ end($labelsArray) }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Stock added
                                <span class="badge bg-success rounded-pill">{{ end($valuesArray) }} items</span>
                            </li>
                        @endif
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Data points
                            <span class="badge bg-info rounded-pill">{{ count($labelsArray) }}</span>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-6">
                <div class="stats-card">
                    <h5>Stock Insights</h5>
                    <p class="text-muted">Key metrics and observations</p>
                    <div class="insight-item mb-2">
                        <small class="text-muted">Trend:</small>
                        <div class="progress mt-1" style="height: 6px;">
                            @php
                                $valuesArray = is_array($values) ? $values : $values->toArray();
                                $trend = count($valuesArray) > 1 ? ($valuesArray[count($valuesArray)-1] - $valuesArray[0]) / max($valuesArray) * 100 : 0;
                            @endphp
                            <div class="progress-bar {{ $trend >= 0 ? 'bg-success' : 'bg-warning' }}" 
                                 role="progressbar" 
                                 style="width: {{ abs($trend) }}%"
                                 aria-valuenow="{{ abs($trend) }}" 
                                 aria-valuemin="0" 
                                 aria-valuemax="100">
                            </div>
                        </div>
                        <small class="{{ $trend >= 0 ? 'text-success' : 'text-warning' }}">
                            {{ $trend >= 0 ? 'Increasing' : 'Decreasing' }} trend
                        </small>
                    </div>
                    <div class="insight-item">
                        <small class="text-muted">Consistency:</small>
                        <div class="d-flex align-items-center mt-1">
                            @php
                                $valuesArray = is_array($values) ? $values : $values->toArray();
                                $avg = count($valuesArray) > 0 ? array_sum($valuesArray) / count($valuesArray) : 0;
                                $variance = 0;
                                if (count($valuesArray) > 0) {
                                    $variance = array_sum(array_map(function($x) use ($avg) {
                                        return pow($x - $avg, 2);
                                    }, $valuesArray)) / count($valuesArray);
                                }
                                $maxValue = count($valuesArray) > 0 ? max($valuesArray) : 1;
                                $consistency = max(0, 100 - ($variance / $maxValue * 100));
                            @endphp
                            <div class="progress flex-grow-1 me-2" style="height: 6px;">
                                <div class="progress-bar bg-info" 
                                     role="progressbar" 
                                     style="width: {{ $consistency }}%"
                                     aria-valuenow="{{ $consistency }}" 
                                     aria-valuemin="0" 
                                     aria-valuemax="100">
                                </div>
                            </div>
                            <small class="text-muted">{{ round($consistency) }}%</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const ctx = document.getElementById('stokChart').getContext('2d');
        const stokChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: @json(is_array($labels) ? $labels : $labels->toArray()),
                datasets: [{
                    label: 'Total Stock',
                    data: @json(is_array($values) ? $values : $values->toArray()),
                    borderColor: 'rgba(67, 97, 238, 1)',
                    backgroundColor: 'rgba(67, 97, 238, 0.1)',
                    borderWidth: 3,
                    pointBackgroundColor: 'rgba(67, 97, 238, 1)',
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2,
                    pointRadius: 5,
                    pointHoverRadius: 7,
                    fill: true,
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top',
                        labels: {
                            color: '#2b2d42',
                            font: {
                                size: 13,
                                weight: '600'
                            },
                            padding: 20
                        }
                    },
                    tooltip: {
                        backgroundColor: 'rgba(43, 45, 66, 0.9)',
                        titleFont: {
                            size: 13
                        },
                        bodyFont: {
                            size: 13
                        },
                        padding: 12,
                        cornerRadius: 8
                    }
                },
                scales: {
                    x: {
                        grid: {
                            color: 'rgba(0, 0, 0, 0.05)'
                        },
                        title: {
                            display: true,
                            text: 'Entry Date',
                            color: '#8d99ae',
                            font: {
                                size: 13,
                                weight: '600'
                            }
                        },
                        ticks: {
                            color: '#8d99ae'
                        }
                    },
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(0, 0, 0, 0.05)'
                        },
                        title: {
                            display: true,
                            text: 'Stock Quantity',
                            color: '#8d99ae',
                            font: {
                                size: 13,
                                weight: '600'
                            }
                        },
                        ticks: {
                            color: '#8d99ae'
                        }
                    }
                },
                interaction: {
                    intersect: false,
                    mode: 'index'
                },
                animations: {
                    tension: {
                        duration: 1000,
                        easing: 'linear'
                    }
                }
            }
        });

        // Simple view toggle functionality (visual only)
        document.querySelectorAll('.btn-chart-action').forEach(button => {
            button.addEventListener('click', function() {
                document.querySelectorAll('.btn-chart-action').forEach(btn => {
                    btn.classList.remove('active');
                });
                this.classList.add('active');
            });
        });
    </script>
</body>
</html>