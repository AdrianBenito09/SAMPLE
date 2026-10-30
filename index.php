<?php
include "database.php";

$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST["username"] ?? "");
    $password = $_POST["password"] ?? "";

    if ($username === "") {
        $message = "USERNAME IS REQUIRED";
    } elseif ($password === "") {
        $message = "PASSWORD IS REQUIRED";
    } else {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO users (user, pass) VALUES (?, ?)";
        $stmt = mysqli_prepare($db_connection, $sql);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "ss", $username, $hash);

            if (mysqli_stmt_execute($stmt)) {
                $message = "Registration successful";
            } else {
                $message = "Registration failed";
            }

            mysqli_stmt_close($stmt);
        } else {
            $message = "Database error";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <h2>WELCOME TO:</h2>
        username <br>
        <input type="text" name="username"><br>
        password <br>
        <input type="password" name="password">
        <input type="submit" name="submit" value="register">
        

        <?php if ($message !== "") : ?>
            <p><?php echo htmlspecialchars($message); ?></p>
        <?php endif; ?>
    </form>
</body>
</html>
