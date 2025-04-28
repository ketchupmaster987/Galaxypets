document.addEventListener("DOMContentLoaded", function () {
    // Fetch the JSON data from a file or API endpoint
    fetch('../json/planets.json')
        .then(response => response.json())
        .then(planets => {
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

            // Attach event listeners to the images and title
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
        })
        .catch(error => {
            console.error("Error loading the planet data:", error);
        });
});
