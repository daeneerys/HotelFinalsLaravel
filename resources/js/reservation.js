document.addEventListener("DOMContentLoaded", function () {
    console.log("Working");

    let today = new Date();
    let currentYear = today.getFullYear();
    let currentMonth = today.getMonth(); // 0-indexed (0 - January, 11 - December)

    // Track the selected dates
    let selectedStartDate = null;
    let selectedEndDate = null;

    // Calculate the date one year from today
    const oneYearLater = new Date(today);
    oneYearLater.setFullYear(today.getFullYear() + 1);

    // Function to generate calendars for two consecutive months
    function generateCalendars(year, month) {
        // Adjust month and year if needed
        const nextMonth = month + 1 > 11 ? 0 : month + 1;
        const nextMonthYear = month + 1 > 11 ? year + 1 : year;

        // Generate two calendars
        generateCalendar(year, month, "calendar1");
        generateCalendar(nextMonthYear, nextMonth, "calendar2");
    }

    // Function to generate a single calendar
    function generateCalendar(year, month, containerId) {
        const daysInMonth = new Date(year, month + 1, 0).getDate();
        const firstDayOfMonth = new Date(year, month, 1).getDay();

        const monthNames = [
            "January",
            "February",
            "March",
            "April",
            "May",
            "June",
            "July",
            "August",
            "September",
            "October",
            "November",
            "December",
        ];

        const calendarContainer = document.getElementById(containerId);
        calendarContainer.innerHTML = ""; // Clear previous content in this container

        const monthContainer = document.createElement("div");
        monthContainer.classList.add("p-4", "h-auto", "relative");

        monthContainer.innerHTML = `
            <h4 class="text-center text-lg font-light mb-2">${
                monthNames[month]
            } ${year}</h4>
            <table class="table-auto w-full text-center font-light font-poppins">
                <thead>
                    <tr>
                        <th class="px-0 py-3">Sun</th>
                        <th class="px-0 py-3">Mon</th>
                        <th class="px-0 py-3">Tue</th>
                        <th class="px-0 py-3">Wed</th>
                        <th class="px-0 py-3">Thu</th>
                        <th class="px-0 py-3">Fri</th>
                        <th class="px-0 py-3">Sat</th>
                    </tr>
                </thead>
                <tbody>
                    ${generateMonthBody(
                        firstDayOfMonth,
                        daysInMonth,
                        month,
                        year
                    )}
                </tbody>
            </table>
        `;

        calendarContainer.appendChild(monthContainer);

        makeDaysSelectable();
    }

    // Function to generate the days for the month body
    function generateMonthBody(firstDay, daysInMonth, month, year) {
        let rows = "";
        let dayCounter = 1;

        // Generate empty cells for the first row (before the first day of the month)
        rows += "<tr>";
        for (let i = 0; i < firstDay; i++) {
            rows += '<td class="px-2 py-1"></td>';
        }

        // Add the days for the month
        for (let i = firstDay; i < 7; i++) {
            if (dayCounter > daysInMonth) break;
            rows += generateDayCell(dayCounter, month, year);
            dayCounter++;
        }
        rows += "</tr>";

        // Continue generating rows for the rest of the month
        while (dayCounter <= daysInMonth) {
            rows += "<tr>";
            for (let i = 0; i < 7; i++) {
                if (dayCounter > daysInMonth) break;
                rows += generateDayCell(dayCounter, month, year);
                dayCounter++;
            }
            rows += "</tr>";
        }

        return rows;
    }

    // Function to generate the individual day cell
    function generateDayCell(dayCounter, month, year) {
        const currentDate = new Date(year, month, dayCounter);
        const dateStr = `${year}-${String(month + 1).padStart(2, "0")}-${String(
            dayCounter
        ).padStart(2, "0")}`;

        let isDisabled = false;

        // Disable past dates
        if (currentDate < today) {
            isDisabled = true;
        }

        // Disable dates beyond 1 year from today
        if (currentDate > oneYearLater) {
            isDisabled = true;
        }

        const dayClass = isDisabled ? "bg-gray-300 cursor-not-allowed" : "day";

        return `<td class="px-2 py-1 ${dayClass}" data-date="${dateStr}" ${isDisabled ? 'style="pointer-events: none; opacity: 0.5;"' : ""}>${dayCounter}</td>`;
    }

    function makeDaysSelectable() {
        // Clone all '.day' elements to remove existing listeners
        const days = document.querySelectorAll(".day");
        days.forEach((day) => {
            const newDay = day.cloneNode(true);
            day.parentNode.replaceChild(newDay, day);
        });

        // Attach fresh listeners
        document.querySelectorAll(".day").forEach(function (day) {
            day.addEventListener("click", function () {
                const clickedDate = new Date(day.dataset.date);

                // Reset selections if both dates are already set
                if (selectedStartDate && selectedEndDate) {
                    selectedStartDate = null;
                    selectedEndDate = null;
                    clearDateHighlights();
                }

                // If no start date is selected, set this as the start date
                if (!selectedStartDate) {
                    selectedStartDate = clickedDate;
                    day.classList.add("bg-jungle-green", "text-white");
                }
                // If a start date exists, highlight the range immediately
                else {
                    selectedEndDate = clickedDate;
                    highlightDateRange(selectedStartDate, selectedEndDate);
                }
            });
        });
    }

    // Function to highlight the date range (including single or consecutive days)
    function highlightDateRange(startDate, endDate) {
        const start = startDate < endDate ? startDate : endDate;
        const end = startDate < endDate ? endDate : startDate;
    
        console.log(start);
        console.log(end);
    
        document.querySelectorAll(".day").forEach(function (day) {
            const dayDate = new Date(day.dataset.date);
    
            // Highlight dates within the range
            if (dayDate >= start && dayDate <= end) {
                day.classList.add("bg-jungle-green", "text-white");
            }
        });
    
        // Update the Arrival date display dynamically
        const arrivalDay = start.getDate();
        const monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
        const arrivalMonth = monthNames[start.getMonth()];
        const departureDay = end.getDate();
        const departureMonth = monthNames[end.getMonth()];
    
        // Dynamically set values in the HTML
        document.querySelector('.arrival-day').textContent = arrivalDay; // Day
        document.querySelector('.arrival-month').textContent = arrivalMonth; // Month
        document.querySelector('.departure-day').textContent = departureDay; // Day
        document.querySelector('.departure-month').textContent = departureMonth; // Month

        // Update the hidden input fields with the formatted dates
        document.getElementById("check-in-date").value = formatDate(start);
        document.getElementById("check-out-date").value = formatDate(end);
    }

    function formatDate(date) {
        // Ensure the date is a valid Date object
        if (!(date instanceof Date)) {
            date = new Date(date);
        }
    
        // Format the date in 'YYYY-MM-DD' format
        const year = date.getFullYear();
        const month = (date.getMonth() + 1).toString().padStart(2, '0'); // Months are zero-based, so add 1
        const day = date.getDate().toString().padStart(2, '0');
        
        return `${year}-${month}-${day}`;
    }

    // Function to clear all highlights
    function clearDateHighlights() {
        document.querySelectorAll(".day").forEach(function (day) {
            day.classList.remove("bg-jungle-green", "text-white");
        });
    }

    // Event listeners for arrows
    document
        .getElementById("prev-month")
        .addEventListener("click", function () {
            currentMonth--;
            if (currentMonth < 0) {
                currentMonth = 11;
                currentYear--;
            }
            generateCalendars(currentYear, currentMonth);
        });

    document
        .getElementById("next-month")
        .addEventListener("click", function () {
            currentMonth++;
            if (currentMonth > 11) {
                currentMonth = 0;
                currentYear++;
            }
            generateCalendars(currentYear, currentMonth);
        });

    // Initial calendar generation
    generateCalendars(currentYear, currentMonth);

 // Room Option Dropdown Generation
    const roomDropdownMenu = document.getElementById("room-dropdown-menu");
    const selectedRoom = document.getElementById("room-selected-option");

    async function fetchRooms() {
        try {
            const response = await fetch("/rooms-with-prices");
            const rooms = await response.json();

            roomDropdownMenu.innerHTML = ""; // Clear existing options

            // Dynamically create room options
            rooms.forEach(room => {
                const div = document.createElement("div");
                div.innerHTML = `${room.room_name} - &#8369;${room.price_per_night} per night`;
                div.className = "px-4 py-2 hover:bg-indigo-100 cursor-pointer";
                div.onclick = () => selectRoom(room.room_name, room.price_per_night);
                roomDropdownMenu.appendChild(div);
            });
        } catch (error) {
            console.error("Error fetching rooms:", error);
        }
    }

    function toggleRoomDropdown(event) {
        event.preventDefault();
        roomDropdownMenu.classList.toggle("hidden");
        if (!roomDropdownMenu.classList.contains("hidden")) {
            fetchRooms(); // Fetch rooms when dropdown is opened
        }
    }

    function selectRoom(name, price) {
        console.log('Selected room name:', name); // Debug log
        selectedRoom.innerHTML = `${name} - &#8369;${price} per night`;
        document.getElementById("selected-room").value = name;
        roomDropdownMenu.classList.add("hidden");
    }

    // Amenity Option Dropdown Generation
    const amenityDropdownMenu = document.getElementById("amenity-dropdown-menu");
    const selectedAmenity = document.getElementById("amenity-selected-option");

    async function fetchAmenities() {
        try {
            const response = await fetch("/amenity-with-prices");
            const amenities = await response.json();

            amenityDropdownMenu.innerHTML = ""; // Clear existing options

            // Dynamically create amenity options
            amenities.forEach(amenity => {
                const div = document.createElement("div");
                div.innerHTML = `${amenity.amenity_name} - &#8369;${amenity.price_per_use} per night`;
                div.className = "px-4 py-2 hover:bg-indigo-100 cursor-pointer";
                div.onclick = () => selectAmenity(amenity.amenity_name, amenity.price_per_use);
                amenityDropdownMenu.appendChild(div);
            });
        } catch (error) {
            console.error("Error fetching amenities:", error);
        }
    }

    function toggleAmenityDropdown(event) {
        event.preventDefault();
        amenityDropdownMenu.classList.toggle("hidden");
        if (!amenityDropdownMenu.classList.contains("hidden")) {
            fetchAmenities(); // Fetch amenities when dropdown is opened
        }
    }

    function selectAmenity(name, price) {
        selectedAmenity.innerHTML = `${name} - &#8369;${price} per night`;
        document.getElementById("selected-amenity").value = name;
        amenityDropdownMenu.classList.add("hidden");
    }

    // Close dropdown if clicked outside
    window.addEventListener("click", function (e) {
        // For Room Dropdown
        if (!e.target.closest("#room-dropdown-button") && !e.target.closest("#room-dropdown-menu")) {
            roomDropdownMenu.classList.add("hidden");
        }
        // For Amenity Dropdown
        if (!e.target.closest("#amenity-dropdown-button") && !e.target.closest("#amenity-dropdown-menu")) {
            amenityDropdownMenu.classList.add("hidden");
        }
    });

    // Attach the event listeners to the buttons
    document.getElementById("room-dropdown-button").addEventListener("click", toggleRoomDropdown);
    document.getElementById("amenity-dropdown-button").addEventListener("click", toggleAmenityDropdown);

    //Check Room Availability
    document.getElementById("check-availability-btn").addEventListener("click", function(event) {
        event.preventDefault(); // Prevent form submission
    
        // Get the selected room name (this should be selected by the user)
        const roomName = document.getElementById("selected-room").value;

        console.log('Room name being sent:', roomName); // Debug log
    
        if (!roomName) {
            alert("Please select a room before checking availability.");
            return;
        }
    
    
        // Show the modal
        const modal = document.getElementById("availability-modal");
        modal.classList.remove("hidden");
    
        // Perform the API call to check room availability
        fetch('/check-room-availability', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') // Add CSRF token if needed
            },
            body: JSON.stringify({ room_name: roomName }) // Send the room name in the request body
        })
        .then(response => response.json())
        .then(data => {
            const modalMessage = document.getElementById("modal-message");
    
            if (data.available) {
                modalMessage.textContent = data.message; // Room is available
            } else {
                modalMessage.textContent = data.message; // Room is not available
            }
        })
        .catch(error => {
            console.error("There was an error checking room availability:", error);
        });
    
        // Handle closing the modal
        document.getElementById("close-modal-btn").addEventListener("click", function() {
            modal.classList.add("hidden");
        });
    });

    document.getElementById('submit-modal-btn').addEventListener('click', function () {
        // Get values from the form
        const roomName = document.getElementById('selected-room').value;
        const amenityName = document.getElementById('selected-amenity').value;
        const checkInDate = document.getElementById('check-in-date').value;
        const checkOutDate = document.getElementById('check-out-date').value;
        
        console.log(roomName);
        console.log(amenityName);
        console.log(checkInDate);
        console.log(checkOutDate);
        // Validate that all fields are filled
        if (!roomName || !amenityName || !checkInDate || !checkOutDate) {
            alert('Please fill out all the fields');
            return;
        }
    
        // Send reservation request
        fetch('/reserve', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ 
                room_name: roomName, 
                amenity_name: amenityName,  // Ensure this matches the backend parameter
                check_in_date: checkInDate, 
                check_out_date: checkOutDate 
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.url) {
                window.location.href = data.url; // Redirect to Stripe Checkout
            } else {
                // If no URL is returned, show an error
                alert('Error: Unable to create reservation or payment session.');
            }
        })
        .catch(error => {
            // Log any errors and show an alert
            console.error('Error:', error);
            alert('An error occurred while processing your reservation.');
        });
    });
});
