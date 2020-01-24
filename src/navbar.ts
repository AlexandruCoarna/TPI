const links: NodeListOf<HTMLAnchorElement> = document.querySelectorAll("[customUrl]");

links.forEach(link => {
    if (link.href.split("?")[0] === window.location.href.split("?")[0]) {
        link.className += "active selector-top";
    }

    link.onclick = (event: MouseEvent) => {
        const element = event.target as HTMLAnchorElement;
        if (element.href.split("?")[0] === window.location.href.split("?")[0]) {
            element.className += "active selector-top";
        } else {
            element.classList.replace("active", "some-custom-class-empty-3939");
            element.classList.replace("selector-top", "some-custom-class-empty-3939");
        }
    };
});

const navItems = document.querySelectorAll('.nav-items');
const toggleLink: HTMLAnchorElement = document.querySelector('#toggle-icon');
const icon: HTMLElement = document.querySelector(".fa");

toggleLink.onclick = () => {
    navItems.forEach(navItem => navItem.classList.toggle('toggle-show'));

    if (icon.classList.contains("fa-bars")) {
        icon.classList.replace("fa-bars", "fa-times");
    } else {
        icon.classList.replace("fa-times", "fa-bars");
    }
};
