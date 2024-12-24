import "./bootstrap";
import "flowbite";

document.addEventListener("DOMContentLoaded", function () {
    const navbar = document.getElementById("navbar");
    const currentRoute = navbar.getAttribute("data-route");

    // Check for routes where the transparent effect should apply
    const scrollBehaviorRoutes = ["home", ""]; // Add empty string for fallback in case '/' is unnamed

    if (scrollBehaviorRoutes.includes(currentRoute)) {
        // Add scroll behavior
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
        // Set navbar to solid green for other routes
        navbar.classList.remove("bg-transparent");
        navbar.classList.add("bg-jungle-green");
    }
});
