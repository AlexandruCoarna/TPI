<? require_once "snippets/start.view.php" ?>
<? require_once "snippets/navbar.view.php" ?>

<div class="main">
    <p>
        Filter Students
    </p>
    <form id="filter-students">
        <label for="criteria">Criteria</label>
        <select name="criteria" id="criteria">
            <option value="firstName">First Name</option>
        </select>

        <label for="value">Value</label>
        <input type="text" name="value" id="value" placeholder="Value">
    </form>

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
        </tr>
        <tr id="student-entries-placeholder"></tr>
        </tbody>
    </table>
</div>
<script src="../bundles/student-list.bundle.js"></script>
<? require_once "snippets/end.view.php" ?>
