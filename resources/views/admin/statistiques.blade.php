@extends('layouts.app')

@section('content')
    <h1 class="text-center mb-5 text-primary">Statistiques de la plateforme</h1>

    <div class="container">
        <div class="row">
            <!-- Card for Total Annonces -->
            <div class="col-md-3 mb-4">
                <div class="card custom-card shadow-lg border-danger">
                    <div class="card-header bg-danger text-white text-center">
                        <i class="material-icons md-36">campaign</i> <!-- Icône des annonces -->
                        <h3>Nombre total d'annonces</h3>
                    </div>
                    <div class="card-body bg-light text-center">
                        <p class="display-4 text-dark">{{ $totalAnnonces }}</p>
                    </div>
                </div>
            </div>

            <!-- Card for Total Demandes -->
            <div class="col-md-3 mb-4">
                <div class="card custom-card shadow-lg border-success">
                    <div class="card-header bg-success text-white text-center">
                        <i class="material-icons md-36">request_page</i> <!-- Icône des demandes -->
                        <h3>Nombre total de demandes</h3>
                    </div>
                    <div class="card-body bg-light text-center">
                        <p class="display-4 text-dark">{{ $totalDemandes }}</p>
                    </div>
                </div>
            </div>

            <!-- Card for Total Clients -->
            <div class="col-md-3 mb-4">
                <div class="card custom-card shadow-lg border-info">
                    <div class="card-header bg-info text-white text-center">
                        <i class="material-icons md-36">person</i> <!-- Icône des clients -->
                        <h3>Nombre total de clients</h3>
                    </div>
                    <div class="card-body bg-light text-center">
                        <p class="display-4 text-dark">{{ $totalClients }}</p>
                    </div>
                </div>
            </div>

            <!-- Card for Total Agents -->
            <div class="col-md-3 mb-4">
                <div class="card custom-card shadow-lg border-warning">
                    <div class="card-header bg-warning text-white text-center">
                        <i class="material-icons md-36">supervisor_account</i> <!-- Icône des agents -->
                        <h3>Nombre total d'agents</h3>
                    </div>
                    <div class="card-body bg-light text-center">
                        <p class="display-4 text-dark">{{ $totalAgents }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Chart.js Graph Section -->
        <div class="row mt-5">
            <div class="col-md-6">
                <div class="card custom-card shadow-lg">
                    <div class="card-header text-center">
                        <h3>Répartition des utilisateurs</h3>
                    </div>
                    <div class="card-body">
                        <canvas id="userChart"></canvas>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card custom-card shadow-lg">
                    <div class="card-header text-center">
                        <h3>Répartition des annonces et demandes</h3>
                    </div>
                    <div class="card-body">
                        <canvas id="statChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f4f7fa;
        }

        h1 {
            font-size: 2.5rem;
            font-weight: 700;
            color: #1a73e8;
        }

        .custom-card {
            border-radius: 15px;
            overflow: hidden;
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
        }

        .custom-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            font-size: 1.5rem;
            font-weight: bold;
            padding: 20px;
        }

        .card-body {
            padding: 30px 15px;
        }

        .display-4 {
            font-size: 3.5rem;
            font-weight: 600;
            color: #333;
        }

        .container {
            margin-top: 50px;
        }

        .row {
            display: flex;
            justify-content: space-between;
        }

        .card-body {
            padding: 15px;
        }

        /* Adding unique colors for cards */
        .border-danger {
            border-left: 5px solid #dc3545;
        }

        .border-success {
            border-left: 5px solid #28a745;
        }

        .border-info {
            border-left: 5px solid #17a2b8;
        }

        .border-warning {
            border-left: 5px solid #ffc107;
        }

        /* Styling for Graph Titles */
        .card-header h3 {
            font-size: 1.8rem;
            color: #444;
        }

        /* Customize the canvas for the chart */
        canvas {
            max-height: 300px;
            max-width: 100%;
        }

    </style>

    <!-- Include Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // User distribution chart
            var userCtx = document.getElementById('userChart').getContext('2d');
            var userChart = new Chart(userCtx, {
                type: 'pie',
                data: {
                    labels: ['Clients', 'Agents'],
                    datasets: [{
                        label: 'Répartition des utilisateurs',
                        data: [{{ $totalClients }}, {{ $totalAgents }}],
                        backgroundColor: ['#007bff', '#28a745'],
                        borderColor: ['#0056b3', '#218838'],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        tooltip: {
                            callbacks: {
                                label: function(tooltipItem) {
                                    return tooltipItem.raw + ' utilisateurs';
                                }
                            }
                        }
                    }
                }
            });

            // Statistics chart (Annonces & Demandes)
            var statCtx = document.getElementById('statChart').getContext('2d');
            var statChart = new Chart(statCtx, {
                type: 'bar',
                data: {
                    labels: ['Annonces', 'Demandes'],
                    datasets: [{
                        label: 'Répartition Annonces et Demandes',
                        data: [{{ $totalAnnonces }}, {{ $totalDemandes }}],
                        backgroundColor: ['#dc3545', '#ffc107'],
                        borderColor: ['#c82333', '#e0a800'],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        tooltip: {
                            callbacks: {
                                label: function(tooltipItem) {
                                    return tooltipItem.raw + ' éléments';
                                }
                            }
                        }
                    }
                }
            });
        });
    </script>
@endsection
