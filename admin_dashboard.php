<!-- admin_dashboard.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="admin_dashboard.css">
</head>
<body>
    <div class="container">
        <nav class="sidebar">
            <h2>Admin Dashboard</h2>
            <ul>
                <li><a href="admin_dashboard.php">Dashboard</a></li>
                <li><a href="view_users.php">Manage Users</a></li>
                <li><a href="manage_blood_stock.php">Manage Blood Stock</a></li>
                <li><a href="view_donors.php">Manage Donors</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>

        <div class="main-content">
            <header>
                <h1>Welcome, Admin!</h1>
                <p>Manage the blood donation system from here.</p>
            </header>

            <section>
                <div class="stats">
                    <div class="card">
                        <h3>Total Users</h3>
                        <p>
                            <?php
                                require 'dbcon.php';
                                $userCountQuery = "SELECT COUNT(*) as total_users FROM user";
                                $result = mysqli_query($conn, $userCountQuery);
                                $data = mysqli_fetch_assoc($result);
                                echo $data['total_users'];
                            ?>
                        </p>
                    </div>

                    <div class="card">
                        <h3>Total Donors</h3>
                        <p>
                            <?php
                                $donorCountQuery = "SELECT COUNT(*) as total_donors FROM donors";
                                $result = mysqli_query($conn, $donorCountQuery);
                                $data = mysqli_fetch_assoc($result);
                                echo $data['total_donors'];
                            ?>
                        </p>
                    </div>

                    <div class="card">
                        <h3>Available Blood Units</h3>
                        <p>
                            <?php
                                $bloodCountQuery = "SELECT SUM(quantity) as total_units FROM blood_stock";
                                $result = mysqli_query($conn, $bloodCountQuery);
                                $data = mysqli_fetch_assoc($result);
                                echo $data['total_units'];
                            ?>
                        </p>
                    </div>

                    <div class="card">
                        <h3>Blood Requests</h3>
                        <p>
                            <?php
                                $requestCountQuery = "SELECT COUNT(*) as total_requests FROM blood_requests";
                                $result = mysqli_query($conn, $requestCountQuery);
                                $data = mysqli_fetch_assoc($result);
                                echo $data['total_requests'];
                            ?>
                        </p>
                    </div>
                </div>
            </section>

            <section class="tables">
                <h2>Latest Blood Donation Requests</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Request ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Blood Group</th>
                            <th>Quantity (in units)</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $query = "SELECT * FROM blood_requests ORDER BY id DESC LIMIT 5";
                            $result = mysqli_query($conn, $query);
                            while($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>";
                                echo "<td>" . $row['id'] . "</td>";
                                echo "<td>" . $row['name'] . "</td>";
                                echo "<td>" . $row['email'] . "</td>";
                                echo "<td>" . $row['blood_group'] . "</td>";
                                echo "<td>" . $row['quantity'] . "</td>";
                                echo "<td>" . $row['status'] . "</td>";
                                echo "</tr>";
                            }
                        ?>
                    </tbody>
                </table>
            </section>
        </div>
    </div>
</body>
</html>
