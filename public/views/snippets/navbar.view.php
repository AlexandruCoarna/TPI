<style>
    .topnav {
        overflow: hidden;
        background-color: #333;
        margin: 0 auto;
        width: 80%;
    }

    .topnav a {
        float: left;
        display: block;
        color: #f2f2f2;
        text-align: center;
        padding: 14px 16px;
        text-decoration: none;
        font-size: 17px;
    }

    .topnav a:hover {
        background-color: #ddd;
        color: black;
    }

    .topnav a.active {
        background-color: #4CAF50;
        color: white;
    }

    .topnav .icon {
        display: none;
    }

    @media screen and (max-width: 750px) {
        .topnav a:not(:first-child) {
            display: none;
        }

        .topnav a.icon {
            float: right;
            display: block;
        }

        .topnav.responsive {
            position: relative;
        }

        .topnav.responsive .icon {
            position: absolute;
            right: 0;
            top: 0;
        }

        .topnav.responsive a {
            float: none;
            display: block;
            text-align: left;
        }

        .topnav, .main {
            width: 100%;
        }
    }

</style>
<div class="topnav" id="navbar">
    <a href="/" customUrl="true">Student List</a>
    <a href="/add-student" customUrl="true">Add Student</a>
    <a href="javascript:void(0);" class="icon" onclick="myFunction()">
        <i class="fa fa-bars"></i>
    </a>
</div>

<script>
    function myFunction() {
        let navElem = document.getElementById("navbar");
        if (navElem.className === "topnav") {
            navElem.className += " responsive";
        } else {
            navElem.className = "topnav";
        }
    }

    let navElem = document.getElementById("navbar");
    let currentLocation = window.location.href;
    let links = navElem.querySelectorAll("[customUrl=true]");
    for (let i = 0; i < links.length; i++) {
        if (links[i].href === currentLocation) {
            links[i].className += "active";
        } else {
            links[i].className = null;
        }
    }
</script>
