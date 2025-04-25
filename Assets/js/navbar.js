// Determine the correct path to fetch navbar.html
let baseFetchPath;
let depth = window.location.pathname.split('/').filter(Boolean).length;

if (depth === 1) {
    baseFetchPath = 'Assets/html/navbar.php';        // Root level
} else if (depth === 2) {
    baseFetchPath = '../Assets/html/navbar.php';     // One level deep
} else {
    baseFetchPath = '../../Assets/html/navbar.php';  // Two levels deep
}

fetch(baseFetchPath)
    .then(response => response.text())
    .then(data => {
        document.getElementById("navbar-container").innerHTML = data;

        // Adjust links based on current path
        let basePath;
        if (depth === 1) {
            basePath = '';        // Root level
        } else if (depth === 2) {
            basePath = '../';     // One level deep
        } else {
            basePath = '../../';  // Two levels deep
        }
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
