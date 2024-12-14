import "./bootstrap";
import "flowbite";

document.addEventListener("DOMContentLoaded", function () {
    const navbar = document.getElementById("navbar");
    const currentRoute = navbar.getAttribute("data-route");

    // Apply scroll behavior only if not on the "offers" or "room" page
    if (
        currentRoute !== "offers" &&
        currentRoute !== "room" &&
        currentRoute !== "dine" &&
        currentRoute !== "amenities" &&
        currentRoute !== "login" &&
        currentRoute !== "register"
    ) {
        document.addEventListener("scroll", function () {
            if (window.scrollY > 50) {
                navbar.classList.remove("bg-transparent");
                navbar.classList.add("bg-jungle-green");
            } else {
                navbar.classList.remove("bg-jungle-green");
                navbar.classList.add("bg-transparent");
            }
        });
    } else {
        // If the current page is "offers" or "room", ensure the navbar stays colored
        navbar.classList.remove("bg-transparent");
        navbar.classList.add("bg-jungle-green");
    }
});
