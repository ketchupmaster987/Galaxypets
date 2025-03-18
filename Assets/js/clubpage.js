document.addEventListener("DOMContentLoaded", function () {
    const planets = [
        {
            name: "Atom's Halo",
            imgSrc: "../Assets/img/planets/lavenderplanet.png",
            altText: "green planet",
            link: "./clubs/AtomsHalo.html",
            population: 5,
            online: 4
        },
        {
            name: "Galaxy Glitter",
            imgSrc: "../Assets/img/planets/greenandpinkplanet.png",
            altText: "blue jelly",
            link: "./clubs/GalaxyGlitter.html",
            population: 3,
            online: 1
        },
        {
            name: "Zero Gravity",
            imgSrc: "../Assets/img/planets/purpleplanet.png",
            altText: "pink jelly",
            link: "./clubs/ZeroGravity.html",
            population: 6,
            online: 5
        },
        {
            name: "Orbitors",
            imgSrc: "../Assets/img/planets/blueplanet.png",
            altText: "pink jelly",
            link: "./clubs/Orbitors.html",
            population: 4,
            online: 0
        }
    ];

    const planetGrid = document.querySelector(".planet-grid");

    planets.forEach(planet => {
        const planetCard = document.createElement("section");
        planetCard.classList.add("planet-card");

        planetCard.innerHTML = `
            <figure>
                <figcaption>
                    <h2 class="planet-title">${planet.name}</h2>
                </figcaption>
                <img src="${planet.imgSrc}" 
                     alt="${planet.altText}" 
                     class="planet-img"
                     data-link="${planet.link}">
            </figure>
            <div class="info" style="display: none;">
                <p>Population: ${planet.population}</p>
                <p>Online: ${planet.online}</p>
            </div>
        `;

        planetGrid.appendChild(planetCard);
    });

    // Ensure event listeners are attached after elements exist
    setTimeout(() => {
        document.querySelectorAll(".planet-img").forEach(img => {
            const info = img.parentElement.nextElementSibling; // Selects .info div
            const title = img.closest(".planet-card").querySelector(".planet-title"); // Selects h2

            img.addEventListener("mouseenter", () => {
                info.style.display = "block";
                title.style.color = "var(--pink)"; // Change title color on hover
            });

            img.addEventListener("mouseleave", () => {
                info.style.display = "none";
                title.style.color = "var(--blue)"; // Revert title color
            });

            // Make the image clickable
            img.addEventListener("click", function () {
                window.location.href = this.dataset.link;
            });
        });
    }, 0); // Runs after the DOM updates
});