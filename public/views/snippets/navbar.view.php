<style>
    .navbar {
        overflow: hidden;
        background-color: #333;
        margin: 0 auto;
        width: 80%;
    }

    .navbar a {
        float: left;
        display: block;
        color: #f2f2f2;
        text-align: center;
        padding: 14px 16px;
        text-decoration: none;
        font-size: 17px;
    }

    .navbar a:hover {
        background-color: #ddd;
        color: black;
    }

    .navbar a.active {
        background-color: #4CAF50;
        color: white;
    }

    .navbar .icon {
        display: none;
    }

    @media screen and (max-width: 750px) {
        .navbar a:not(:first-child) {
            display: none;
        }

        .navbar a.icon {
            float: right;
            display: block;
        }

        .navbar.responsive {
            position: relative;
        }

        .navbar.responsive .icon {
            position: absolute;
            right: 0;
            top: 0;
        }

        .navbar.responsive a {
            float: none;
            display: block;
            text-align: left;
        }

        .navbar, .main {
            width: 100%;
        }
    }

</style>

<div class="navbar" id="navbar">
    <a href="/" customUrl="true">Student List</a>
    <a href="/add-student" customUrl="true">Add Student</a>
    <a href="javascript:void(0);" class="icon" onclick="myFunction()">
        <i class="fa fa-bars"></i>
    </a>
</div>

<script>
    function myFunction() {
        let navElem = document.querySelector("#navbar");
        if (navElem.className === "navbar") {
            navElem.className += " responsive";
        } else {
            navElem.className = "navbar";
        }
    }

    let links = document.querySelectorAll("[customUrl=true]");
    for (let i = 0; i < links.length; i++) {
        if (links[i].href === window.location.href) {
            links[i].className += "active";
        } else {
            links[i].className = null;
        }
    }
</script>
