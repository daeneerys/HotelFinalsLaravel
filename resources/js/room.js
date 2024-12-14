document.addEventListener("DOMContentLoaded", function () {
    //Room Viewing Javascript
    const tabs = document.querySelectorAll(".tab-button");
    const tabContents = document.querySelectorAll(".room-tab-content");

    tabs.forEach((button) => {
        button.addEventListener("click", function () {
            const tab = this.getAttribute("data-tab");

            // Remove active class and color from all tabs
            tabs.forEach((btn) => {
                btn.classList.remove("active-tab");
                btn.classList.remove("text-jungle-brown"); // Remove font color for inactive tabs
            });

            // Add active class and color to the clicked tab
            this.classList.add("active-tab");
            this.classList.add("text-jungle-brown"); // Add font color to active tab

            // Hide all room tab contents by default
            tabContents.forEach((tabContent) =>
                tabContent.classList.add("hidden")
            );

            // Show the content for the clicked tab
            if (tab === "guest") {
                // If Guest Rooms tab is clicked, only show guest rooms
                document
                    .getElementById("guest_rooms")
                    .classList.remove("hidden");
                document.getElementById("suites_rooms").classList.add("hidden");
                document.getElementById("villa_rooms").classList.add("hidden");
                document
                    .getElementById("specialty_rooms")
                    .classList.add("hidden");
            } else if (tab === "suites") {
                // If Suites tab is clicked, only show suites rooms
                document.getElementById("guest_rooms").classList.add("hidden");
                document
                    .getElementById("suites_rooms")
                    .classList.remove("hidden");
                document.getElementById("villa_rooms").classList.add("hidden");
                document
                    .getElementById("specialty_rooms")
                    .classList.add("hidden");
            } else if (tab === "villas") {
                // If Villas tab is clicked, only show villas
                document.getElementById("guest_rooms").classList.add("hidden");
                document.getElementById("suites_rooms").classList.add("hidden");
                document
                    .getElementById("villa_rooms")
                    .classList.remove("hidden");
                document
                    .getElementById("specialty_rooms")
                    .classList.add("hidden");
            } else if (tab === "specialty") {
                // If Specialty Suites tab is clicked, only show specialty rooms
                document.getElementById("guest_rooms").classList.add("hidden");
                document.getElementById("suites_rooms").classList.add("hidden");
                document.getElementById("villa_rooms").classList.add("hidden");
                document
                    .getElementById("specialty_rooms")
                    .classList.remove("hidden");
            } else {
                // If "View All" tab is clicked, show all rooms
                document
                    .getElementById("guest_rooms")
                    .classList.remove("hidden");
                document
                    .getElementById("suites_rooms")
                    .classList.remove("hidden");
                document
                    .getElementById("villa_rooms")
                    .classList.remove("hidden");
                document
                    .getElementById("specialty_rooms")
                    .classList.remove("hidden");
            }
        });
    });

    // Set the default active tab (View All)
    document.getElementById("viewAllRooms").classList.add("active-tab");
    document.getElementById("viewAllRooms").classList.add("text-jungle-brown");
    document.getElementById("viewAllRooms").classList.remove("text-gray-800");
});
