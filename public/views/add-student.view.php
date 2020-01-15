<? require_once "snippets/start.view.php" ?>
<? require_once "snippets/navbar.view.php" ?>

<div class="main">
    <div id="add-student-wrapper">
        <form id="add-student">
            <label for="fname">First Name *</label>
            <input type="text" id="fname" name="firstName" placeholder="First Name">

            <label for="lname">Last Name *</label>
            <input type="text" id="lname" name="lastName" placeholder="Last Name">

            <label for="pnumber">Phone Number *</label>
            <input type="text" id="pnumber" name="phoneNumber" placeholder="Phone Number">

            <label for="email">Email *</label>
            <input type="text" id="email" name="email" placeholder="Email">

            <label for="pidnumber">Personal Id Number *</label>
            <input type="text" id="pidnumber" name="personalIdNumber" placeholder="Personal Id Number">

            <input type="submit" value="Add Student">
        </form>
        <p>
            Fields with * are required!
        </p>

    </div>
</div>
<script src="../bundles/add-student.bundle.js"></script>
<? require_once "snippets/end.view.php" ?>
