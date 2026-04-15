<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper@6.8.4/swiper-bundle.min.js"></script>

<script>
    "use strict";

    document.addEventListener("click", function (event) {
        if (event.target.closest(".side-navbar-nav-open-button")) {
            document.querySelector(".side-navbar-nav").classList.add("show");
            document.querySelector(".side-navbar-bg-overlay").classList.remove("d-none");
        }

        if (event.target.closest(".side-navbar-nav-close-button")) {
            document.querySelector(".side-navbar-nav").classList.remove("show");
            document.querySelector(".side-navbar-bg-overlay").classList.add("d-none");
        }

        if (event.target.closest("[data-bs-toggle='collapse']")) {
            let targetDropdown = document.querySelector(event.target.getAttribute("data-bs-target"));

            document.querySelectorAll(".collapse.show").forEach(function (el) {
                if (el !== targetDropdown) {
                    new bootstrap.Collapse(el).hide();
                }
            });
        } else {
            document.querySelectorAll(".collapse.show").forEach(function (el) {
                new bootstrap.Collapse(el).hide();
            });
        }
    });

    const elementsToShow = document.querySelectorAll(".show-fade-in");
    const elementsToAnimatePath = document.querySelectorAll(".animate-path-draw");

    const observer = new IntersectionObserver(entries => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add("showing");
            }
        });
    }, { threshold: 0.2 });

    const observerAnimate = new IntersectionObserver(entries => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                anime({
                    targets: '.animate-path-draw g path',
                    strokeDashoffset: [anime.setDashoffset, 0],
                    easing: 'easeInOutSine',
                    duration: 2500,
                    delay: 500
                });
                observerAnime.unobserve(entry.target);
            }
        });
    }, { threshold: 0.2 });

    elementsToShow.forEach(el => observer.observe(el));
    elementsToAnimatePath.forEach(el => observerAnimate.observe(el));

    function createMouseBlob(containerSelector, options = {}) {
        const container = document.querySelector(containerSelector);
        if (!container) {
            console.error(`Container "${containerSelector}" tidak ditemukan!`);
            return;
        }

        const follower = document.createElement("div");
        follower.classList.add("d-block-blob");
        container.appendChild(follower);

        const defaultOptions = {
            defaultX: container.clientWidth / 2,
            defaultY: container.clientHeight / 2,
            speed: 0.1,
            baseColor: "red",
            hoverColor: "blue",
            shadowColor: "rgba(255, 0, 0, 0.5)"
        };

        const settings = { ...defaultOptions, ...options };

        follower.style.backgroundColor = settings.baseColor;
        follower.style.boxShadow = `0 0 10px ${settings.shadowColor}`;

        let posX = settings.defaultX;
        let posY = settings.defaultY;
        let targetX = posX;
        let targetY = posY;
        let containerRect = container.getBoundingClientRect();

        const updateContainerRect = () => {
            containerRect = container.getBoundingClientRect();
        };

        const handleMouseMove = (event) => {
            updateContainerRect();
            targetX = event.clientX - containerRect.left;
            targetY = event.clientY - containerRect.top;
            follower.style.backgroundColor = settings.hoverColor;
            follower.style.boxShadow = `0 0 15px ${settings.shadowColor}`;
        };

        const handleMouseLeave = () => {
            targetX = settings.defaultX;
            targetY = settings.defaultY;
            follower.style.backgroundColor = settings.baseColor;
            follower.style.boxShadow = `0 0 10px ${settings.shadowColor}`;
        };

        container.addEventListener("mousemove", handleMouseMove);
        container.addEventListener("mouseleave", handleMouseLeave);
        window.addEventListener("resize", updateContainerRect);
        window.addEventListener("scroll", updateContainerRect);

        const animate = () => {
            const dx = targetX - posX;
            const dy = targetY - posY;
            const speed = settings.speed;

            posX += dx * speed;
            posY += dy * speed;
            
            follower.style.left = `${posX}px`;
            follower.style.top = `${posY}px`;
            
            requestAnimationFrame(animate);
        };

        animate();
    }

    document.getElementById("blockBlobStories") && createMouseBlob("#blockBlobStories", { defaultX: 150, defaultY: 50, speed: 0.05, baseColor: "#dc3545", hoverColor: "#dc3545" });
    document.getElementById("blockBlobProducts") && createMouseBlob("#blockBlobProducts", { defaultX: 150, defaultY: 50, speed: 0.05, baseColor: "#dc3545", hoverColor: "#dc3545" });
    document.getElementById("blockBlobArticles") && createMouseBlob("#blockBlobArticles", { defaultX: 150, defaultY: 50, speed: 0.05, baseColor: "#dc3545", hoverColor: "#dc3545" });

    function initializeSwipers() {
        let swipers = {};

        document.querySelectorAll(".d-body-content").forEach((container) => {
            let id = container.id;
            swipers[id] = new Swiper(`#${id} .swiper-container`, {
                slidesPerView: 2,
                spaceBetween: 20,
                centeredSlides: true,
                speed: 600,
                navigation: {
                    nextEl: `.btn-slide-nav-next[data-swiper="${id}"]`,
                    prevEl: `.btn-slide-nav-prev[data-swiper="${id}"]`,
                },
                breakpoints: {
                    1024: {
                        slidesPerView: 4,
                    },
                    768: {
                        slidesPerView: 2,
                    }
                }
            });
        });
    }

    setTimeout(() => {
        if (document.querySelector(".swiper-container")) {
            initializeSwipers();
        } else {
            console.warn("Swiper container not found, trying again...");
            setTimeout(initializeSwipers, 500);
        }
    }, 100);
</script>