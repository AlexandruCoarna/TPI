<? require_once "snippets/start.view.php" ?>
<? require_once "snippets/navbar.view.php" ?>
<div class="main">
    <div id="add-student-wrapper">
        <form id="add-student">
            <label for="fname">First Name</label>
            <input type="text" id="fname" name="firstname" placeholder="First Name">
            <label for="lname">Last Name</label>
            <input type="text" id="lname" name="lastname" placeholder="Last Name">
            <input type="submit" value="Add Student">
        </form>
    </div>
</div>
<? require_once "snippets/end.view.php" ?>
