<? require_once "snippets/start.view.php" ?>
<? require_once "snippets/navbar.view.php" ?>

<div class="main">
    <div class="center-text">
        Filter Students
    </div>
    <form id="filter-students" onsubmit="event.preventDefault();">
        <label for="criteria">Criteria</label>
        <select name="criteria" id="criteria">
            <option value="first_name">First Name</option>
            <option value="last_name">Last Name</option>
            <option value="phone_number">Phone Number</option>
            <option value="email">Email</option>
            <option value="personal_id_number">Personal Id Number</option>
        </select>

        <label for="value">Value</label>
        <input type="text" name="value" id="value" placeholder="Value">
    </form>
    <hr>

    <br>

    <table id="student-list">
        <tbody>
        <tr>
            <th>No.</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Phone Number</th>
            <th>Email</th>
            <th>Personal Id Number</th>
            <th>Actions</th>
        </tr>
        <tr id="student-entries-placeholder"></tr>
        </tbody>
    </table>

    <div id="student-empty-placeholder"></div>
</div>
<script src="../bundles/student-list.bundle.js"></script>
<? require_once "snippets/end.view.php" ?>
