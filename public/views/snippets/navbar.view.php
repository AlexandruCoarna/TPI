<div class="nav-wrapper">
    <nav class="nav">
        <div class="item title">
            <a href="javascript:void(0);">
                <? /** @var string $title */ ?>
                <? echo $title ?>
            </a>
        </div>
        <div class="item toggle">
            <a href="javascript:void(0);" id="toggle-icon"><i class="fa fa-bars"></i></a>
        </div>
        <div class="nav-items">
            <div class="item">
                <a href="/" customUrl="true">Student List</a>
            </div>
            <div class="item">
                <a href="/add-student" customUrl="true">Add Student</a>
            </div>
        </div>

    </nav>
</div>

<script>
    const links = document.querySelectorAll("[customUrl=true]");

    links.forEach(link => {
        if (link.href.split("?")[0] === window.location.href.split("?")[0]) {
            link.className += "active selector-top";
        } else {
            link.className = null;
        }
    });

    function classToggle() {

    }

    const navItems = document.querySelectorAll('.nav-items');

    document.querySelector('#toggle-icon').onclick = () => {
        navItems.forEach(navItem => navItem.classList.toggle('toggle-show'));
    }

</script>
