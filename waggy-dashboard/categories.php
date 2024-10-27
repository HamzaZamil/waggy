<?php
include("includes/header.php")
?>

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- Page Heading -->
                    <h1>Categories dashboard</h1>
                    <div class="row" style="">
                        <div>
                            <button type="button" class="button1" style="background-color:#000;" onclick="openAddModalCategory()">
                                <span class="button__text">Add Category</span>
                                <span class="button__icon" style="background-color:#000;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" viewBox="0 0 24 24" stroke-width="2" stroke-linejoin="round" stroke-linecap="round" stroke="currentColor" height="24" fill="none" class="svg">
                                        <line y2="19" y1="5" x2="12" x1="12"></line>
                                        <line y2="12" y1="12" x2="19" x1="5"></line>
                                    </svg>
                                </span>
                            </button>
                        </div>
                    
                        <div class="pt-5 pb-3" style = "margin-right:150px;">
                            <h2>Categories Table</h2>
                            <table class="responsive-table">
                                <thead>
                                    <tr>
                                        <th>Category ID</th>
                                        <th>Category Name</th>
                                        <th>Category Description</th>
                                        <th>Category Picture</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td data-label="Category ID">1</td>
                                        <td data-label="Category Name">Electronics</td>
                                        <td data-label="Category Description">Devices and gadgets</td>
                                        <td data-label="Category Picture"><img src="electronics.jpg" alt="Electronics" width="50"></td>
                                        <td data-label="Actions">
                                            <div class="action-buttons">
                                                <button class="edit-btn" onclick="openEditModalCategory(this)">Edit</button>
                                                <button class="delete-btn">Delete</button>
                                            </div>
                                        </td>
                                    </tr>
                                    <!-- More rows can be added here -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                    
                    <!-- Edit Modal -->
                    <div id="editModalCategory" class="modal" style="display: none; justify-content: center; align-items: center; height: 100vh;">
                        <div class="modal-content" style="width: 50%; text-align: center;">
                            <button class="close-btn" style="background:#db4f4f;" onclick="closeEditModalCategory()" >X</button>
                            <h2>Edit Category</h2>
                        <form id="editForm">
                            <div class="form-group">
                                <label for="categoryName">Category Name:</label>
                                <input type="text" id="categoryName" required>
                            </div>
                            <div class="form-group">
                                <label for="categoryDescription">Category Description:</label>
                                <input type="text" id="categoryDescription" required>
                            </div>
                            <div class="form-group">
                                <label for="categoryPicture">Category Picture URL:</label>
                                <input type="text" id="categoryPicture" required>
                            </div>    
                            <button class="save-btn" type="submit"
                    style="background-color: #000; color: white; padding: 10px; border: none; cursor: pointer; width: 100px; margin-top: 20px;">Save
                    </button>
                        </form>
                        </div>
                    </div>
                    
                    <!-- Add Modal -->
                    <div id="addModalCategory" class="modal" style="display: none; justify-content: center; align-items: center; height: 100vh;">
                        <div class="modal-content" style="width: 50%; text-align: center;">
                            <button class="close-btn" style="background:#db4f4f;" onclick="closeAddModalCategory()" >X</button>
                            <h2>Add Category</h2>
                        <form id="addForm">
                            <div class="form-group">
                                <label for="newCategoryName">Category Name:</label>
                                <input type="text" id="newCategoryName" required>
                            </div>
                            <div class="form-group">
                                <label for="newCategoryDescription">Category Description:</label>
                                <input type="text" id="newCategoryDescription" required>
                            </div>
                            <div class="form-group">    
                                <label for="newCategoryPicture">Category Picture URL:</label>
                                <input type="text" id="newCategoryPicture" required>
                            </div>    
                            <button class="save-btn" type="submit"
                    style="background-color: #000; color: white; padding: 10px; border: none; cursor: pointer; width: 100px; margin-top: 20px;">
                    Add</button>
                        </form>
                        </div>
                    </div>
                </div>
                     
        
                </div>
                <!-- End of Content Wrapper -->
        
            </div>
            <!-- End of Page Wrapper -->
        
            <!-- Scroll to Top Button-->
            <a class="scroll-to-top rounded" href="#page-top">
                <i class="fas fa-angle-up"></i>
            </a>
        
            <!-- Logout Modal-->
            <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog"     aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Select "Logout" below if you are ready to end your current session.
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <a class="btn btn-primary" href="login.php">Logout</a>
                    </div>
                    </div>
                </div>
             </div>

            <!-- Bootstrap core JavaScript-->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        
            <!-- Core plugin JavaScript-->
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>
        
            <!-- Custom scripts for all pages-->
<script src="js/sb-admin-2.min.js"></script>
<script src="js/modal.js"></script>
<script>
    // Open Category Edit Modal and populate form with data from the table row
    function openEditModalCategory(button) {
        document.getElementById("editModalCategory").style.display = "flex";

        // Get the parent row of the button
        const row = button.closest("tr");

        // Retrieve data from the row cells
        const categoryName = row.cells[1].textContent;
        const categoryDescription = row.cells[2].textContent;
        const categoryPicture = row.cells[3].querySelector('img').getAttribute('src');

        // Populate the form fields in the modal
        document.getElementById("categoryName").value = categoryName;
        document.getElementById("categoryDescription").value = categoryDescription;
        document.getElementById("categoryPicture").value = categoryPicture;
    }

    // Close Category Edit Modal
    function closeEditModalCategory() {
        document.getElementById("editModalCategory").style.display = "none";
    }

    // Open Add Category Modal
    function openAddModalCategory() {
        document.getElementById("addModalCategory").style.display = "flex";
    }

    // Close Add Category Modal
    function closeAddModalCategory() {
        document.getElementById("addModalCategory").style.display = "none";
    }

    // Close modal if user clicks outside of it
    window.onclick = function(event) {
        const editModalCategory = document.getElementById("editModalCategory");
        const addModalCategory = document.getElementById("addModalCategory");

        if (event.target == editModalCategory) {
            editModalCategory.style.display = "none";
        } else if (event.target == addModalCategory) {
            addModalCategory.style.display = "none";
        }
    }
</script>
</body>        
</html>                    