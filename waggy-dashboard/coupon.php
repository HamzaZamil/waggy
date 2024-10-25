<?php
include("includes/header.php")
?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Coupon dashboard</h1>

    <div class="row">
        <div>
            <button type="button" style="background:#000;" class="button1" onclick="openAddModal()">
                <span class="button__text">Add Coupon</span>
                <span class="button__icon" style="background:#000;"><svg xmlns="http://www.w3.org/2000/svg" width="24"
                        viewBox="0 0 24 24" stroke-width="2" stroke-linejoin="round" stroke-linecap="round"
                        stroke="currentColor" height="24" fill="none" class="svg">
                        <line y2="19" y1="5" x2="12" x1="12"></line>
                        <line y2="12" y1="12" x2="19" x1="5"></line>
                    </svg></span>
            </button>
        </div>
        <div class="pt-5 pb-3" style="margin-right:300px">
            <h2>Coupon Table</h2>
            <table class="responsive-table">
                <thead>
                    <tr>
                        <th>Coupon Id</th>
                        <th>Coupon Discount</th>
                        <th>Deadline</th>
                        <th>Validity</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td data-label="Product Image"><img src="https://via.placeholder.com/50" alt="Product 1"></td>
                        <td data-label="Product Category">Widgets</td>
                        <td data-label="Product Quantity">100</td>
                        <td data-label="Product Status">Instock</td>
                        <td data-label="Actions">
                            <div class="action-buttons">
                                <button class="edit-btn" onclick="openEditModal(this)">Edit</button>
                                <button class="delete-btn">Delete</button>
                            </div>
                        </td>
                    </tr>
                    <tr>

                        <td data-label="Product Image"><img src="https://via.placeholder.com/50" alt="Product 2"></td>
                        <td data-label="Product Category">Gadgets</td>
                        <td data-label="Product Quantity">50</td>
                        <td data-label="Product Status">Out of Stock</td>
                        <td data-label="Actions">
                            <div class="action-buttons">
                                <button class="edit-btn" onclick="openEditModal(this)">Edit</button>
                                <button class="delete-btn">Delete</button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <!-- Edit Modal -->
    <div id="editModal" class="modal"
        style="display: none; justify-content: center; align-items: center; height: 100vh;">
        <div class="modal-content" style="width: 50%; text-align: center;">
            <button class="close-btn" style="background:#db4f4f;" onclick="closeEditModal()">X</button>
            <h2>Edit Coupon</h2>
            <form id="addForm">
                <div class="form-group">
                    <label for="newProductName">Coupon Discount:</label>
                    <input type="text" id="newProductName" name="newProductName"><br><br>
                </div>
                <div class="form-group">
                    <label for="newProductDescription">DeadLine:</label>
                    <input type="text" id="newProductDescription" name="newProductDescription"><br><br>
                </div>
                <div class="form-group">
                    <label for="newProductStatus">Validity:</label>
                    <select id="newProductStatus" name="newProductStatus">
                        <option value="instock">Instock</option>
                        <option value="outofstock">Out of Stock</option>
                    </select><br><br>
                </div>
                <button class="save-btn" type="submit"
                    style="background-color: #000; color: white; padding: 10px; border: none; cursor: pointer; width: 100px; margin-top: 20px;">Save
                </button>
            </form>
        </div>
    </div>

    <!-- Add Modal -->
    <div id="addModal" class="modal"
        style="display: none; justify-content: center; align-items: center; height: 100vh;">
        <div class="modal-content" style="width: 50%; text-align: center;">
            <button class="close-btn" style="background:#db4f4f;" onclick="closeAddModal()">X</button>
            <h2>Add Coupon</h2>
            <form id="addForm">
                <div class="form-group">
                    <label for="newProductName">Coupon Discount:</label>
                    <input type="text" id="newProductName" name="newProductName"><br><br>
                </div>
                <div class="form-group">
                    <label for="newProductDescription">DeadLine:</label>
                    <input type="text" id="newProductDescription" name="newProductDescription"><br><br>
                </div>
                <div class="form-group">
                    <label for="newProductStatus">Validity:</label>
                    <select id="newProductStatus" name="newProductStatus">
                        <option value="instock">Instock</option>
                        <option value="outofstock">Out of Stock</option>
                    </select><br><br>
                </div>
                <button class="save-btn" type="submit"
                    style="background-color: #000; color: white; padding: 10px; border: none; cursor: pointer; width: 100px; margin-top: 20px;">Save
                </button>
            </form>
        </div>
    </div>
    <!-- Footer -->
    <footer class="sticky-footer bg-white">
        <div class="container my-auto">
            <div class="copyright text-center my-auto">
                <span>Copyright &copy; Your Website 2020</span>
            </div>
        </div>
    </footer>
    <!-- End of Footer -->

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

</body>

</html>