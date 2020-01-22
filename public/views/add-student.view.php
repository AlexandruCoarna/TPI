<? require_once "snippets/start.view.php" ?>
<? require_once "snippets/navbar.view.php" ?>

<div class="main">
    <div class="center-text">
        Add Students
    </div>
    <div id="add-student-wrapper">
        <form id="add-student">
            <label for="fname">First Name *</label>
            <input type="text" id="fname" name="first_name" placeholder="First Name">

            <label for="lname">Last Name *</label>
            <input type="text" id="lname" name="last_name" placeholder="Last Name">

            <label for="pnumber">Phone Number *</label>
            <input type="text" id="pnumber" name="phone_number" placeholder="Phone Number">

            <label for="email">Email *</label>
            <input type="text" id="email" name="email" placeholder="Email">

            <label for="pidnumber">Personal Id Number *</label>
            <input type="text" id="pidnumber" name="personal_id_number" placeholder="Personal Id Number">

            <input type="submit" value="Add Student">
        </form>
        <div class="center-text">
            Fields with * are required!
        </div>
    </div>
</div>
<script src="../bundles/add-student.bundle.js"></script>
<? require_once "snippets/end.view.php" ?>
