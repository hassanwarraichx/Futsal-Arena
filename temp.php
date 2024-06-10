<?php
require 'config.php';
session_start();

// Check if admin is logged in, if not, redirect to admin login page
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}

// Handle CRUD operations for coaches
if (isset($_POST['coach_action'])) {
    switch ($_POST['coach_action']) {
        case 'create':
            $name = $_POST['name'];
            $mobile = $_POST['mobile'];
            $email = $_POST['email'];
            $experience = $_POST['experience'];
            $specialties = $_POST['specialties'];
            $sql = "INSERT INTO coaches (name, mobile, email, experience, specialties) VALUES ('$name', '$mobile', '$email', '$experience', '$specialties')";
            $conn->query($sql);
            break;
        case 'update':
            $id = $_POST['id'];
            $name = $_POST['name'];
            $mobile = $_POST['mobile'];
            $email = $_POST['email'];
            $experience = $_POST['experience'];
            $specialties = $_POST['specialties'];
            $sql = "UPDATE coaches SET name='$name', mobile='$mobile', email='$email', experience='$experience', specialties='$specialties' WHERE id='$id'";
            $conn->query($sql);
            break;
        case 'delete':
            $id = $_POST['id'];
            $sql = "DELETE FROM coaches WHERE id='$id'";
            $conn->query($sql);
            break;
    }
}

// Handle CRUD operations for coaching sessions
if (isset($_POST['session_action'])) {
    switch ($_POST['session_action']) {
        case 'create':
            $coach_id = $_POST['coach_id'];
            $location = $_POST['location'];
            $date = $_POST['date'];
            $time_slot = $_POST['time_slot'];
            $max_trainees = $_POST['max_trainees'];
            $field_no = $_POST['field_no'];
            $sql = "INSERT INTO coaching_sessions (coach_id, location, date, time_slot, max_trainees, field_no) VALUES ('$coach_id', '$location', '$date', '$time_slot', '$max_trainees', '$field_no')";
            $conn->query($sql);
            break;
        case 'update':
            $id = $_POST['id'];
            $coach_id = $_POST['coach_id'];
            $location = $_POST['location'];
            $date = $_POST['date'];
            $time_slot = $_POST['time_slot'];
            $max_trainees = $_POST['max_trainees'];
            $field_no = $_POST['field_no'];
            $sql = "UPDATE coaching_sessions SET coach_id='$coach_id', location='$location', date='$date', time_slot='$time_slot', max_trainees='$max_trainees', field_no='$field_no' WHERE id='$id'";
            $conn->query($sql);
            break;
        case 'delete':
            $id = $_POST['id'];
            $sql = "DELETE FROM coaching_sessions WHERE id='$id'";
            $conn->query($sql);
            break;
    }
}

// Fetch coaches data from the database and store in an array
$coaches_query = "SELECT * FROM coaches";
$coaches_result = $conn->query($coaches_query);
$coaches = [];
if ($coaches_result->num_rows > 0) {
    while ($row = $coaches_result->fetch_assoc()) {
        $coaches[] = $row;
    }
}

// Fetch sessions data from the database
$sessions_query = "SELECT coaching_sessions.*, coaches.name AS coach_name FROM coaching_sessions LEFT JOIN coaches ON coaching_sessions.coach_id = coaches.id";
$sessions_result = $conn->query($sessions_query);

// Define available locations and time slots
$locations = ["Wapda Town", "Model Town", "DHA"]; // Example locations
$time_slots = [
    "06:00-07:00", "07:00-08:00", "08:00-09:00", "09:00-10:00", 
    "10:00-11:00", "11:00-12:00", "12:00-13:00", "13:00-14:00", 
    "14:00-15:00", "15:00-16:00", "16:00-17:00", "17:00-18:00", 
    "18:00-19:00", "19:00-20:00", "20:00-21:00", "21:00-22:00",
    "22:00-23:00", "23:00-00:00", "00:00-01:00", "01:00-02:00",
    "02:00-03:00", "03:00-04:00", "04:00-05:00", "05:00-06:00"
];

$fields = range(1, 2); // Example field numbers
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Coaching</title>
    <link rel="stylesheet" href="dashboard_style.css">
</head>
<body>
    <header>
        <h1>Admin Dashboard - Coaching</h1>
        <nav>
            <ul>
            <li><button> <a href="dashboard.php">User and Booking </a></li>
                <li><button> <a href="coach_dashboard.php">Coaching</a></li>
                <li><button> <a href="trainee_dashboard.php">Trainees</a></button></li>
                <li><button> <a href="contact_dashboard.php">Customers info</a></button></li>
                <li><button> <a href="venue_dashboard.php">Venues</a></button></li>    
                <li><button> <a href="wallet_dashboard.php">User Wallets</a></button></li>  
                <li><button> <a href="admin_walletdashboard.php">My Wallet</a></button></li>    
                <li><button> <a href="transcation_dashboard.php">Transactions</a></button></li>                         
                <li><button> <a href="index.html">Logout</a></button></li>
            </ul>
        </nav>
    </header>

    <main>
        <section>
            <h2>Coaches</h2>
            <table>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Mobile</th>
                    <th>Email</th>
                    <th>Experience</th>
                    <th>Specialties</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
                <?php
                if (count($coaches) > 0) {
                    foreach ($coaches as $row) {
                        echo "<tr>";
                        echo "<td>" . $row["id"] . "</td>";
                        echo "<td>" . $row["name"] . "</td>";
                        echo "<td>" . $row["mobile"] . "</td>";
                        echo "<td>" . $row["email"] . "</td>";
                        echo "<td>" . $row["experience"] . "</td>";
                        echo "<td>" . $row["specialties"] . "</td>";
                        echo "<td>" . $row["created_at"] . "</td>";
                        echo "<td>
                                <form action='' method='POST' style='display:inline;'>
                                    <input type='hidden' name='id' value='" . $row["id"] . "'>
                                    <input type='hidden' name='coach_action' value='delete'>
                                    <button type='submit'>Delete</button>
                                </form>
                                <button onclick=\"populateCoachForm('" . $row["id"] . "', '" . $row["name"] . "', '" . $row["mobile"] . "', '" . $row["email"] . "', '" . $row["experience"] . "', '" . $row["specialties"] . "')\">Update</button>
                              </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='8'>No coaches found</td></tr>";
                }
                ?>
            </table>

            <h3>Add / Update Coach</h3>
            <form action="" method="POST">
                <input type="hidden" name="coach_action" value="create" id="coach_action">
                <input type="hidden" name="id" id="coach_id">
                <input type="text" name="name" placeholder="Name" id="coach_name" required>
                <input type="text" name="mobile" placeholder="Mobile" id="coach_mobile" required>
                <input type="email" name="email" placeholder="Email" id="coach_email" required>
                <input type="number" name="experience" placeholder="Experience (years)" id="coach_experience" required>
                <textarea name="specialties" placeholder="Specialties" id="coach_specialties"></textarea>
                <button type="submit">Submit</button>
            </form>
        </section>
        
        <section>
            <h2>Coaching Sessions</h2>
            <table>
                <tr>
                    <th>ID</th>
                    <th>Coach</th>
                    <th>Location</th>
                    <th>Date</th>
                    <th>Time Slot</th>
                    <th>Max Trainees</th>
                    <th>Field No.</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
                <?php
                if ($sessions_result->num_rows > 0) {
                    while ($row = $sessions_result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["id"] . "</td>";
                        echo "<td>" . $row["coach_name"] . "</td>";
                        echo "<td>" . $row["location"] . "</td>";
                        echo "<td>" . $row["date"] . "</td>";
                        echo "<td>" . $row["time_slot"] . "</td>";
                        echo "<td>" . $row["max_trainees"] . "</td>";
                        echo "<td>" . $row["field_no"] . "</td>";
                        echo "<td>" . $row["created_at"] . "</td>";
                        echo "<td>
                                <form action='' method='POST' style='display:inline;'>
                                    <input type='hidden' name='id' value='" . $row["id"] . "'>
                                    <input type='hidden' name='session_action' value='delete'>
                                    <button type='submit'>Delete</button>
                                </form>
                                <button onclick=\"populateSessionForm('" . $row["id"] . "', '" . $row["coach_id"] . "', '" . $row["location"] . "', '" . $row["date"] . "', '" . $row["time_slot"] . "', '" . $row["max_trainees"] . "', '" . $row["field_no"] . "')\">Update</button>
                              </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='9'>No coaching sessions found</td></tr>";
                }
                ?>
            </table>

            <h3>Add / Update Coaching Session</h3>
            <form action="" method="POST">
                <input type="hidden" name="session_action" value="create" id="session_action">
                <input type="hidden" name="id" id="session_id">
                <select name="coach_id" id="session_coach_id" required>
                    <option value="">Select Coach</option>
                    <?php
                    if (count($coaches) > 0) {
                        foreach ($coaches as $row) {
                            echo "<option value='" . $row["id"] . "'>" . $row["name"] . "</option>";
                        }
                    }
                    ?>
                </select>
                <select name="location" id="session_location" required>
                    <option value="">Select Location</option>
                    <?php
                    foreach ($locations as $location) {
                        echo "<option value='$location'>$location</option>";
                    }
                    ?>
                </select>
                <input type="date" name="date" id="session_date" required>
                <select name="time_slot" id="session_time_slot" required>
                    <option value="">Select Time Slot</option>
                    <?php
                    foreach ($time_slots as $time_slot) {
                        echo "<option value='$time_slot'>$time_slot</option>";
                    }
                    ?>
                </select>
                <input type="number" name="max_trainees" placeholder="Max Trainees" id="session_max_trainees" required>
                <select name="field_no" id="session_field_no" required>
                    <option value="">Select Field No.</option>
                    <?php
                    foreach ($fields as $field) {
                        echo "<option value='$field'>Field $field</option>";
                    }
                    ?>
                </select>
                <button type="submit">Submit</button>
            </form>
        </section>
    </main>
    <footer>
        <p>&copy; 2024 Futsal Range</p>
    </footer>
    <script>
        function populateCoachForm(id, name, mobile, email, experience, specialties) {
            document.getElementById('coach_id').value = id;
            document.getElementById('coach_name').value = name;
            document.getElementById('coach_mobile').value = mobile;
            document.getElementById('coach_email').value = email;
            document.getElementById('coach_experience').value = experience;
            document.getElementById('coach_specialties').value = specialties;
            document.getElementById('coach_action').value = 'update';
        }

        function populateSessionForm(id, coach_id, location, date, time_slot, max_trainees, field_no) {
            document.getElementById('session_id').value = id;
            document.getElementById('session_coach_id').value = coach_id;
            document.getElementById('session_location').value = location;
            document.getElementById('session_date').value = date;
            document.getElementById('session_time_slot').value = time_slot;
            document.getElementById('session_max_trainees').value = max_trainees;
            document.getElementById('session_field_no').value = field_no;
            document.getElementById('session_action').value = 'update';
        }
    </script>
</body>
</html>






























