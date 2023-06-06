<div class="menu-bar">
    <h1 class="logo">Patient<span>Q</span></h1>
    <ul>
        <li><a href="../roots/home.php">Home</a></li>
        
        <li><a href="#">Patient <i class="fas fa-caret-down"></i></a>
            <div class="dropdown-menu">
                <ul>
                  <li><a href="../patient/admit-patient.php">Admit Patient</a></li>
                  <li><a href="../patient/search-patient.php">Search Patient</a></li>
                  <li><a href="../patient/delete-patient.php">Delete Patient</a></li>
                  <li><a href="../payment/search-residents.php">Admitted patients</a></li>
                </ul>
              </div>
        </li>

        <li><a href="#">Payment <i class="fas fa-caret-down"></i></a>
            <div class="dropdown-menu">
                <ul>
                  <li><a href="../payment/search-residents.php">Residents</a></li>
                </ul>
              </div>
        </li>

        <li><a href="#">Doctor <i class="fas fa-caret-down"></i></a>
            <div class="dropdown-menu">
                <ul>
                  <li><a href="../doctor/add-doctor.php">Add Doctor</a></li>
                  <li><a href="../doctor/search-doctor.php">Search Doctor</a></li>
                  <li><a href="../doctor/delete-doctor.php">Delete Doctor</a></li>
                </ul>
              </div>
        </li>

        <li><a href="#">Search/Query <i class="fas fa-caret-down"></i></a>
            <div class="dropdown-menu">
                <ul>
                  <li><a href="../department/search-department.php">Department</a></li>
                  <li><a href="../charge/search-charge.php">Charge Sheet</a></li>
                  <li><a href="../hospital/search-room.php">Hospital Room</a></li>
                  <li><a href="../purpose/search-purpose.php">Purpose</a></li>
                </ul>
              </div>
        </li>

        <li><a href="#">Delete<i class="fas fa-caret-down"></i></a>
            <div class="dropdown-menu">
                <ul>
                  <li><a href="../patient/delete-patient.php">Delete Patient</a></li>
                  <li><a href="../doctor/delete-doctor.php">Delete Doctor</a></li>
                  <li><a href="../payment/delete-payment-history.php">Delete Payment</a></li>
                </ul>
              </div>
        </li>

        <li><a href="#">Log Out<i class="fas fa-caret-down"></i></a>
          <div class="dropdown-menu">
                <ul>
                <form action="../roots/source-codes.php" method="POST">
                  <button type="submit" name="logout_btn" class="btn btn-danger">Log Out</button>
                </form>
                </ul>
              </div>
        </li>
    </ul>
</div>
