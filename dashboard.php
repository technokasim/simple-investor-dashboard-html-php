<?php 
session_start();

if (!isset($_SESSION["username"])) {
    header("Location: index.php"); 
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Admin Dashboard | Investo</title>
    <!-- ======= Styles ====== -->
    <link rel="stylesheet" href="assets/css/style.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</head>

<body>
    <!-- =============== Navigation ================ -->
    <div class="container">
        <div class="navigation">
            <ul>
                <li>
                    <a href="#">
                        <span class="icon">
                            <ion-icon name="stats-chart-outline"></ion-icon>
                        </span>
                        <span class="title">Investo</span>
                    </a>
                </li>

                <li>
                    <a href="#">
                        <span class="icon">
                            <ion-icon name="home-outline"></ion-icon>
                        </span>
                        <span class="title">Dashboard</span>
                    </a>
                </li>

                <li>
                    <a href="#">
                        <span class="icon">
                            <ion-icon name="people-outline"></ion-icon>
                        </span>
                        <span class="title">Customers</span>
                    </a>
                </li>

                <li>
                    <a href="#">
                        <span class="icon">
                            <ion-icon name="chatbubble-outline"></ion-icon>
                        </span>
                        <span class="title">Messages</span>
                    </a>
                </li>

                <li>
                    <a href="#">
                        <span class="icon">
                            <ion-icon name="help-outline"></ion-icon>
                        </span>
                        <span class="title">Help</span>
                    </a>
                </li>

                <li>
                    <a href="#">
                        <span class="icon">
                            <ion-icon name="settings-outline"></ion-icon>
                        </span>
                        <span class="title">Settings</span>
                    </a>
                </li>

                <li>
                    <a href="#">
                        <span class="icon">
                            <ion-icon name="lock-closed-outline"></ion-icon>
                        </span>
                        <span class="title">Password</span>
                    </a>
                </li>

                <li>
                    <a href="#" id="signOutButton">
                        <span class="icon">
                            <ion-icon name="log-out-outline"></ion-icon>
                        </span>
                        <span class="title">Sign Out</span>
                    </a>
                </li>
            </ul>
        </div>

        <!-- ========================= Main ==================== -->
        <div class="main">
            <div class="topbar">
                <div class="toggle">
                    <ion-icon name="menu-outline"></ion-icon>
                </div>

                <div class="search">
                    <label>
                        <input type="text" placeholder="Search here">
                        <ion-icon name="search-outline"></ion-icon>
                    </label>
                </div>

                <div class="user">
                    <img src="assets/imgs/customer01.jpg" alt="">
                </div>
            </div>

            <!-- ======================= Cards ================== -->
            <div class="cardBox">
                <div class="card">
                    <div>
                        <div class="numbers" id="shareHoldersCount"></div>
                        <div class="cardName">Share Holders</div>
                    </div>

                    <div class="iconBx">
                        <ion-icon name="person-circle-outline"></ion-icon>
                    </div>
                </div>



                <div class="card">
                    <div>
                        <div class="numbers" id="highestPercentage"></div>
                        <div class="cardName">High Percent</div>
                    </div>

                    <div class="iconBx">
                        <ion-icon name="trending-up-outline"></ion-icon>
                    </div>
                </div>

                <div class="card">
                    <div>
                        <div class="numbers" id="totalInvestment"></div>
                        <div class="cardName">Total Investment</div>
                    </div>

                    <div class="iconBx">
                        <ion-icon name="wallet-outline"></ion-icon>
                    </div>
                </div>

                <div class="card">
                    <div>
                        <div class="numbers" id="totalProfit"></div>
                        <div class="cardName">Total Profit</div>
                    </div>

                    <div class="iconBx">
                        <ion-icon name="bag-check-outline"></ion-icon>
                    </div>
                </div>
            </div>

            <!-- ================ Order Details List ================= -->
            <div class="details">
                <div class="recentOrders">
                    <div class="cardHeader">
                        <h2>Recent Investment</h2>
                        <a href="#" class="btn">View All</a>
                    </div>

                    <table>
                        <thead>
                            <tr>
                                <th>Share Holder</th>
                                <th>Percent</th>
                                <th>Investment</th>
                                <th>Profit</th>
                            </tr>
                        </thead>
                        <tbody id="table-data">
                        </tbody>
                    </table>
                </div>
                <div class="recentCustomers">
                    <div class="cardHeader">
                        <h2>Chart</h2>
                    </div>

                    <canvas id="myPieChart"></canvas>

                </div>
            </div>
        </div>
    </div>

    <script>
    fetch('fetch/get_data.php')
        .then(response => response.json())
        .then(data => {
            const shareHoldersCount = data.length;
            const shareHoldersCountElement = document.getElementById('shareHoldersCount');
            shareHoldersCountElement.textContent = shareHoldersCount;


            const totalInvestment = data.reduce((sum, item) => sum + parseFloat(item.investment), 0);
            const totalInvestmentElement = document.getElementById('totalInvestment');
            totalInvestmentElement.textContent = totalInvestment.toFixed(2);

            const highestPercentage = Math.max(...data.map(item => parseFloat(item.percent)));
            const highestPercentageElement = document.getElementById('highestPercentage');
            highestPercentageElement.textContent = highestPercentage;

            const totalProfit = data.reduce((sum, item) => sum + parseFloat(item.profit), 0);
            const totalProfitElement = document.getElementById('totalProfit');
            totalProfitElement.textContent = totalProfit.toFixed(2);
        })
        .catch(error => console.error('Error:', error));
    fetch('fetch/get_data.php')
        .then(response => response.json())
        .then(data => {
            var labels = data.map(item => item.share_holder);
            var values = data.map(item => item.percent);

            var ctx = document.getElementById('myPieChart').getContext('2d');
            var myPieChart = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: labels,
                    datasets: [{
                        data: values,
                        backgroundColor: [
                            'red', 'blue', 'yellow', 'green', 'orange'
                        ]
                    }]
                }
            });
        })
        .catch(error => console.error('Error:', error));


    fetch('fetch/get_data.php')
        .then(response => response.json())
        .then(data => {
            // Populate the table with data
            const tableData = document.getElementById('table-data');
            data.forEach(item => {
                const row = document.createElement('tr');
                row.innerHTML = `
                        <td>${item.share_holder}</td>
                        <td>${item.percent}</td>
                        <td>${item.investment}</td>
                        <td>${item.profit}</td>
                    `;
                tableData.appendChild(row);
            });
        })
        .catch(error => console.error('Error:', error));

    document.getElementById('signOutButton').addEventListener('click', function() {
        fetch('fetch/signout.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'action=signout',
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    window.location.href = 'index.php';
                } else {
                    console.error('Signout failed:', data.error);
                }
            })
            .catch(error => console.error('Error:', error));
    });
    </script>

    <!-- =========== Scripts =========  -->
    <script src="assets/js/main.js"></script>

    <!-- ====== ionicons ======= -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>