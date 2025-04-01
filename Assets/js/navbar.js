// Determine the correct path to fetch navbar.html
let baseFetchPath = window.location.pathname.includes("/Pages/") ? "../Assets/html/navbar.html" : "Assets/html/navbar.html";

fetch(baseFetchPath)
    .then(response => response.text())
    .then(data => {
        document.getElementById("navbar-container").innerHTML = data;

        // Adjust links based on current path
        let basePath = window.location.pathname.includes("/Pages/") ? "../" : "";
        document.querySelectorAll("#navbar-container .nav-link").forEach(link => {
            let href = link.getAttribute("href");
            if (href !== "#" && !href.startsWith("http")) {
                link.setAttribute("href", basePath + href);
            }
        });

        // Adjust the logo link separately
        let logo = document.querySelector("#navbar-container .logo a");
        if (logo) {
            let logoHref = logo.getAttribute("href");
            logo.setAttribute("href", basePath + logoHref);
        }
    })
    .catch(error => console.error("Error loading navbar:", error));
