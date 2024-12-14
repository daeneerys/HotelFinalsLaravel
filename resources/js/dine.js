import "./bootstrap";
import "flowbite";

document.addEventListener("DOMContentLoaded", function () {
    // Set the default tab
    const defaultTabType = "treetop-feast";

    // Show the default tab content
    document.querySelector(`.${defaultTabType}-container`).style.display =
        "block";

    // Highlight the default button
    const defaultButton = document.querySelector(
        `[data-dinetab="${defaultTabType}"]`
    );
    defaultButton.classList.add("active-tab", "text-jungle-brown");
    defaultButton.classList.remove("text-gray-800");
    
    //Dine Viewing
    document.querySelectorAll(".dine-tab-button").forEach((button) => {
        button.addEventListener("click", () => {
            const tabType = button.getAttribute("data-dinetab");

            // Hide all tab content
            document
                .querySelectorAll(".dine-tab-content")
                .forEach((content) => {
                    content.style.display = "none";
                });

            // Show the selected tab content
            document.querySelector(`.${tabType}-container`).style.display =
                "block";

            // Highlight the active button
            document.querySelectorAll(".dine-tab-button").forEach((btn) => {
                btn.classList.remove("active-tab", "text-jungle-brown");
                btn.classList.add("text-gray-800");
            });
            button.classList.add("active-tab", "text-jungle-brown");
            button.classList.remove("text-gray-800");
        });
    });
});
