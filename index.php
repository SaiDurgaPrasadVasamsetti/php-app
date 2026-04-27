<?php
include 'db.php';

// INSERT DATA
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name  = $_POST['name'];
    $email = $_POST['email'];
    $marks = $_POST['marks'];

    $stmt = $conn->prepare("INSERT INTO student (name, email, marks) VALUES (?, ?, ?)");
    $stmt->bind_param("ssi", $name, $email, $marks);
    $stmt->execute();
}

// FETCH DATA
$result = $conn->query("SELECT * FROM student ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Management</title>
</head>
<body>

<h2>Add Student</h2>

<form method="POST">
    <input name="name" placeholder="Name" required>
    <input name="email" placeholder="Email" required>
    <input name="marks" type="number" placeholder="Marks" required>
    <button type="submit">Save</button>
</form>

<hr>

<h2>Student List</h2>

<table border="1" cellpadding="10">
<tr>
    <th>ID</th>
    <th>Name</th>
    <th>Email</th>
    <th>Marks</th>
</tr>

<?php
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['id']}</td>
                <td>{$row['name']}</td>
                <td>{$row['email']}</td>
                <td>{$row['marks']}</td>
              </tr>";
    }
} else {
    echo "<tr><td colspan='4'>No data found</td></tr>";
}
?>

</table>

</body>
</html>
