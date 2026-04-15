function scrollIntoViewIfExists(id) {
    if (typeof document === "undefined") {
        return false;
    }

    const element = document.getElementById(id);
    if (!element) {
        return false;
    }

    element.scrollIntoView({ behavior: "smooth" });
    return true;
}

function buildShareUrl(shareTo, title, currentUrl) {
    const articleUrl = encodeURIComponent(currentUrl);

    if (shareTo === "facebook") {
        return `https://www.facebook.com/sharer/sharer.php?u=${articleUrl}`;
    }

    if (shareTo === "twitter") {
        return `https://x.com/intent/tweet?text=${title}&url=${articleUrl}`;
    }

    if (shareTo === "whatsapp") {
        return `https://wa.me/?text=${title}%20${articleUrl}`;
    }

    if (shareTo === "telegram") {
        return `https://t.me/share/url?url=${articleUrl}&text=${title}`;
    }

    if (shareTo === "linkedin") {
        return `https://www.linkedin.com/sharing/share-offsite/?url=${articleUrl}`;
    }

    return null;
}

function copyCurrentUrl(currentUrl) {
    if (typeof document === "undefined") {
        return false;
    }

    const tempInput = document.createElement("input");
    tempInput.value = decodeURIComponent(currentUrl);
    document.body.appendChild(tempInput);
    tempInput.select();
    tempInput.setSelectionRange(0, 99999);
    document.execCommand("copy");
    document.body.removeChild(tempInput);

    return true;
}

function shareArtikel(shareTo, title, currentUrl) {
    const shareUrl = buildShareUrl(shareTo, title, currentUrl);

    if (shareUrl) {
        if (typeof window !== "undefined") {
            window.open(shareUrl, "_blank");
        }
        return shareUrl;
    }

    copyCurrentUrl(currentUrl);
    if (typeof alert === "function") {
        alert("Link berhasil disalin");
    }
    return null;
}

if (typeof document !== "undefined") {
    document.addEventListener("DOMContentLoaded", function () {
        scrollIntoViewIfExists("main-artikel");
        scrollIntoViewIfExists("main-karir");
        scrollIntoViewIfExists("main-artikel-all");
        scrollIntoViewIfExists("main-karir-all");

        document.addEventListener("click", function (e) {
            const target = e.target.closest(".btn-share-artikel");
            if (target) {
                const to = target.getAttribute("to");
                const title = target.getAttribute("title");
                shareArtikel(to, title, window.location.href);
            }
        });
    });
}

if (typeof module !== "undefined" && module.exports) {
    module.exports = {
        buildShareUrl,
        copyCurrentUrl,
        scrollIntoViewIfExists,
        shareArtikel,
    };
}
