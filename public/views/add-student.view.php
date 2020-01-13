<? require_once "snippets/start.view.php" ?>
<? require_once "snippets/navbar.view.php" ?>

<div class="main">
    <div id="add-student-wrapper">
        <form id="add-student" onsubmit="onAddStudentsubmit(event)">
            <label for="fname">First Name</label>
            <input type="text" id="fname" name="firstName" placeholder="First Name">

            <label for="lname">Last Name</label>
            <input type="text" id="lname" name="lastName" placeholder="Last Name">

            <label for="pnumber">Phone Number</label>
            <input type="text" id="pnumber" name="phoneNumber" placeholder="Phone Number">

            <label for="email">Email</label>
            <input type="text" id="email" name="email" placeholder="Email">

            <label for="country">Country</label>
            <input type="text" id="country" name="country" placeholder="Country">

            <label for="city">City</label>
            <input type="text" id="city" name="city" placeholder="City">

            <input type="submit" value="Add Student">
        </form>
    </div>
</div>
<script src="../js/add-student.js"></script>
<? require_once "snippets/end.view.php" ?>
