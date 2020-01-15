<? require_once "snippets/start.view.php" ?>
<? require_once "snippets/navbar.view.php" ?>

<div class="main">
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
