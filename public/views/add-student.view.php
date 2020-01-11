<? require_once "snippets/start.view.php" ?>
<div class="main">
    <div id="add-student-wrapper">
        <form id="add-student">
            <label for="fname">First Name</label>
            <input type="text" id="fname" name="firstname" placeholder="Your name..">

            <label for="lname">Last Name</label>
            <input type="text" id="lname" name="lastname" placeholder="Your last name..">

            <input type="submit" value="Add Student">
        </form>
    </div>
</div>
<? require_once "snippets/end.view.php" ?>
