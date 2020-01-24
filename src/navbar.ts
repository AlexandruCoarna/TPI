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

toggleLink.onclick = () => {
    navItems.forEach(navItem => navItem.classList.toggle('toggle-show'));
};
