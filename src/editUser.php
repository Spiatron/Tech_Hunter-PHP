<?php
session_start();
require_once "dataConnection.php";
if (isset($_SESSION['username']) && $_SESSION['role'] === 'admin') {
    $username = $_SESSION['username'];
} else {
    echo "Please login to proceed";
    header("Location: ./login.php");
    exit();
}
if (isset($_POST['edit_user'])) {
    $user_id = $_POST['user_id'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $role = $_POST['role'];

    $update_query = "UPDATE users SET username='$username', email='$email', role='$role' WHERE id='$user_id'";
    if (mysqli_query($conn, $update_query)) {
        echo "<script>alert('User updated successfully.');</script>";
    } else {
        echo "<script>alert('Error updating user: " . mysqli_error($conn) . "');</script>";
    }
}
if (isset($_GET['delete']))
{
    $user_id = $_GET['delete'];
    $delete_query = "DELETE FROM users WHERE id='$user_id'";
    if (mysqli_query($conn, $delete_query))
    {
        echo "<script>alert('User deleted successfully.'); window.location.href='editUser.php';</script>";
        exit();
    }
    
    else
    {
        echo "<script>alert('Error deleting user: " . mysqli_error($conn) . "');</script>";
    }
}
$query = "SELECT * FROM users";
$result = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tech Hunter</title>
    <!-- fontawesome cdn -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- bootstrap css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- custom css -->
    <link rel="stylesheet" href="../styles/main.css">
    <link rel="stylesheet" href="../styles/universalBg.css">
</head>

<body data-bs-theme="dark" class="bg-image">
    <div class="container mt-5">
        <span>
             <h2>Edit Users</h2>
        </span>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Actions to take here</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['username']; ?></td>
                        <td><?php echo $row['email']; ?></td>
                        <td><?php echo $row['role']; ?></td>
                        <td>
                            <button class="adminBtnEdit me-1" onclick="editUser(<?php echo $row['id']; ?>, '<?php echo $row['username']; ?>', '<?php echo $row['email']; ?>', '<?php echo $row['role']; ?>')">Edit</button>
                            <a href="./editUser.php?delete=<?php echo $row['id']; ?>" class="adminBtnDelete" onclick="return confirm('Are you sure that you want to delete this user?')">Delete</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        <a href="./adminSetting.php" class="adminGoBackbtn">Go back</a>  
    </div>
                   
    <!-- Edit User Modal -->     
    <div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editUserModalLabel">Edit User</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="user_id" id="editUserId">
                        <div class="mb-3">
                            <label for="editUsername" class="form-label">Username</label>
                            <input type="text" class="form-control" id="editUsername" name="username" required>
                        </div>
                        <div class="mb-3">
                            <label for="editEmail" class="form-label">Email</label>
                            <input type="email" class="form-control" id="editEmail" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="editRole" class="form-label">Role</label>
                            <select class="form-control" id="editRole" name="role" required>
                                <option value="admin">Admin</option>
                                <option value="user">User</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="edit_user" class="btn btn-primary">Save changes</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="../../bootstrap-5.0.2-dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function editUser(id, username, email, role) {
            document.getElementById('editUserId').value = id;
            document.getElementById('editUsername').value = username;
            document.getElementById('editEmail').value = email;
            document.getElementById('editRole').value = role;
            var editUserModal = new bootstrap.Modal(document.getElementById('editUserModal'));
            editUserModal.show();
        }
    </script>

<!-- jquery -->
<script src="../js/jquery-3.6.0.js"></script>
    <!-- isotope js -->
    <script src="https://unpkg.com/isotope-layout@3/dist/isotope.pkgd.js"></script>
    <!-- bootstrap js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <!-- custom js -->
    <script src="../js/script.js"></script>
</body>
</html>