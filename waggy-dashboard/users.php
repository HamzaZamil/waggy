<?php
include "includes/header.php";
require_once 'model/User.php'; 

$user = new User();
$users = $user->getAllUsers();
?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800" style="color:#858796;">Users dashboard</h1>


    <div class="row">
        <div>
            <button type="button" class="button1" style="background-color:#000;" onclick="openAddModal()">
                <span class="button__text">Add New User</span>
                <span class="button__icon" style="background-color:#000;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" viewBox="0 0 24 24" stroke-width="2"
                        stroke-linejoin="round" stroke-linecap="round" stroke="currentColor" height="24" fill="none"
                        class="svg">
                        <line y2="19" y1="5" x2="12" x1="12"></line>
                        <line y2="12" y1="12" x2="19" x1="5"></line>
                    </svg>
                </span>
            </button>
        </div>
        <div class="pt-5 pb-3">
            <h2>Users Table</h2>
            <table class="responsive-table">
                <thead>
                    <tr>
                        <th>User ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Gender</th>
                        <th>Birth Date</th>
                        <th>Phone Number</th>
                        <th>Address</th>
                        <th>State</th>
                        <th>Role</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $users->fetch(PDO::FETCH_ASSOC)): ?>
                    <tr>
                        <td data-label="User ID"><?php echo $row['user_id']; ?></td>
                        <td data-label="First Name"><?php echo $row['user_first_name']; ?></td>
                        <td data-label="Last Name"><?php echo $row['user_last_name']; ?></td>
                        <td data-label="Email"><?php echo $row['user_email']; ?></td>
                        <td data-label="Gender"><?php echo $row['user_gender']; ?></td>
                        <td data-label="Birth Date"><?php echo $row['user_birth_of_date']; ?></td>
                        <td data-label="Phone Number"><?php echo $row['user_phone_number']; ?></td>
                        <td data-label="Address"><?php echo $row['user_address_line_one']; ?></td>
                        <td data-label="State"><?php echo $row['user_state']; ?></td>
                        <td data-label="Role"><?php echo $row['user_role']; ?></td>
                        <td data-label="Actions">
                            <div class="action-buttons">
                            <button class="edit-btn" onclick="openEditModal(this, <?php echo $row['user_id']; ?>)">Edit</button>
                                <form method="POST" action="process_user.php" style="display: inline;">
                                    <input type="hidden" name="deleteUserId" value="<?php echo $row['user_id']; ?>">
                                    <button type="submit" class="delete-btn"
                                        onclick="return confirm('Are you sure you want to delete this user?');">Delete</button>
                                </form>
                            </div>
                        </td>

                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
    <!-- /.container-fluid -->

    <!-- Edit Modal -->
  <!-- Edit Modal -->
<div class="modal" id="editModal" style="display: none; justify-content: center; align-items: center; height: 100vh;">
    <div class="modal-content" style="width: 50%; text-align: center;">
        <button class="close-btn" style="background:#db4f4f;" onclick="closeEditModal()">X</button>
        <h3>Edit User</h3>
        <form id="editForm" method="POST" action="process_user.php">
            <input type="hidden" id="editUserId" name="editUserId">
            <div class="form-group">
                <label for="firstName">First Name:</label>
                <input type="text" id="firstName" name="editFirstName">
            </div>
            <div class="form-group">
                <label for="lastName">Last Name:</label>
                <input type="text" id="lastName" name="editLastName">
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="editEmail">
            </div>
            <div class="form-group">
                <label for="gender">Gender:</label>
                <select id="gender" name="editGender">
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                </select>
            </div>
            <div class="form-group">
                <label for="birthDate">Birth Date:</label>
                <input type="date" id="birthDate" name="editBirthDate">
            </div>
            <div class="form-group">
                <label for="phone">Phone Number:</label>
                <input type="text" id="phone" name="editPhone">
            </div>
            <div class="form-group">
                <label for="address">Address:</label>
                <input type="text" id="address" name="editAddress">
            </div>
            <div class="form-group">
                    <label for="editState">State:</label>
                    <select id="editState" name="editState" required>
                        <option value="Active">Active</option>
                        <option value="Deactivate">Deactivate</option>
                    </select>
                </div>
            <div class="form-group">
                <label for="role">Role:</label>
                <select id="role" name="editRole">
                    <option value="superadmin">Superadmin</option>
                    <option value="admin">Admin</option>
                    <option value="user">User</option>
                </select>
            </div>
            <button class="save-btn" type="submit"
                style="background-color: #000; color: white; padding: 10px; border: none; cursor: pointer; width: 100px; margin-top: 20px;">Save User</button>
        </form>
    </div>
</div>


    <!-- Add User Modal -->
    <div class="modal" id="addModal"
        style="display: none; justify-content: center; align-items: center; height: 100vh;">
        <div class="modal-content" style="width: 50%; text-align: center;">
            <button class="close-btn" style="background:#db4f4f;" onclick="closeAddModal()">X</button>
            <h3 style="text-align: center;">Add New User</h3>
            <form id="addForm" method="POST" action="process_user.php">
                <div class="form-group">
                    <label for="newFirstName">First Name:</label>
                    <input type="text" id="newFirstName" name="newFirstName" required>
                </div>
                <div class="form-group">
                    <label for="newLastName">Last Name:</label>
                    <input type="text" id="newLastName" name="newLastName" required>
                </div>
                <div class="form-group">
                    <label for="newEmail">Email:</label>
                    <input type="email" id="newEmail" name="newEmail" required>
                </div>
                <div class="form-group">
                    <label for="newGender">Gender:</label>
                    <select id="newGender" name="newGender" required>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="newBirthDate">Birth Date:</label>
                    <input type="date" id="newBirthDate" name="newBirthDate" required>
                </div>
                <div class="form-group">
                    <label for="newPhone">Phone Number:</label>
                    <input type="text" id="newPhone" name="newPhone" required>
                </div>
                <div class="form-group">
                    <label for="newAddress">Address:</label>
                    <input type="text" id="newAddress" name="newAddress" required>
                </div>
                <div class="form-group">
                    <label for="newState">State:</label>
                    <select id="newState" name="newState" required>
                        <option value="Active">Active</option>
                        <option value="Deactivate">Deactivate</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="newRole">Role:</label>
                    <select id="newRole" name="newRole" required>
                        <option value="SuperAdmin">Superadmin</option>
                        <option value="Admin">Admin</option>
                        <option value="User">User</option>
                    </select>
                </div>
                <button class="save-btn" type="submit"
                    style="background-color: #000; color: white; padding: 10px; border: none; cursor: pointer; width: 100px; margin-top: 20px;">Save
                    User</button>
            </form>
        </div>
    </div>

    <!-- End of Main Content -->



</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="login.html">Logout</a>
            </div>
        </div>
    </div>
</div>

<script>
function openAddModal() {
    document.getElementById("addModal").style.display = "flex";
}

function closeAddModal() {
    document.getElementById("addModal").style.display = "none";
}

function openEditModal(button, userId) {
    const row = button.closest('tr');
    const firstName = row.cells[1].innerText;
    const lastName = row.cells[2].innerText;
    const email = row.cells[3].innerText;
    const birthDate = row.cells[5].innerText;
    const phone = row.cells[6].innerText;
    const address = row.cells[7].innerText;
    const state = row.cells[8].innerText;

    
    document.getElementById("firstName").value = firstName;
    document.getElementById("lastName").value = lastName;
    document.getElementById("email").value = email;
    document.getElementById("birthDate").value = birthDate;
    document.getElementById("phone").value = phone;
    document.getElementById("address").value = address;
    document.getElementById('editState').value = state;
    // Set user ID
    document.getElementById("editUserId").value = userId;

    document.getElementById("editModal").style.display = "flex";
}


function closeEditModal() {
    document.getElementById("editModal").style.display = "none";
}
</script>