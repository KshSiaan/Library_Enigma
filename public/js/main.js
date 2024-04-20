function menuToggle() {
    var menu = document.querySelector(".menubar");
    menu.classList.toggle("show-menu");
}

document.addEventListener("click", function (event) {
    var menu = document.querySelector(".menubar");
    var isClickInsideMenu = menu.contains(event.target);
    var isMenuOpen = menu.classList.contains("show-menu");

    if (!isClickInsideMenu && isMenuOpen) {
        // Click occurred outside the menu while menu is open, so close it
        menu.classList.remove("show-menu");
    }
});

document
    .querySelector(".menu-toggle")
    .addEventListener("click", function (event) {
        // Stop the propagation of the click event to prevent it from closing the menu
        event.stopPropagation();
    });

document.addEventListener("alpine:init", () => {
    Alpine.data("imageSlider", () => ({
        currentIndex: 1,
        images: [
            "https://unsplash.it/640/425?image=30",
            "https://unsplash.it/640/425?image=40",
            "https://unsplash.it/640/425?image=50",
        ],
        previous() {
            if (this.currentIndex > 1) {
                this.currentIndex = this.currentIndex - 1;
            }
        },
        forward() {
            if (this.currentIndex < this.images.length) {
                this.currentIndex = this.currentIndex + 1;
            }
        },
    }));
});
