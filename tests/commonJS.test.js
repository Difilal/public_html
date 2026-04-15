const {
    buildShareUrl,
    shareArtikel,
} = require("../sub-www/js/js-global-auth/commonJS.js");

describe("buildShareUrl", () => {
    test("builds facebook share URL", () => {
        const url = buildShareUrl("facebook", "Judul Artikel", "https://example.com/artikel?id=10");

        expect(url).toBe(
            "https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fexample.com%2Fartikel%3Fid%3D10"
        );
    });

    test("builds twitter share URL", () => {
        const url = buildShareUrl("twitter", "Judul Artikel", "https://example.com/artikel");

        expect(url).toBe(
            "https://x.com/intent/tweet?text=Judul Artikel&url=https%3A%2F%2Fexample.com%2Fartikel"
        );
    });

    test("returns null for unsupported share target", () => {
        expect(buildShareUrl("copy", "Judul Artikel", "https://example.com/artikel")).toBeNull();
    });
});

describe("shareArtikel", () => {
    test("opens share URL when target is supported", () => {
        global.window = {
            open: jest.fn(),
        };

        const result = shareArtikel("linkedin", "Judul", "https://example.com/post");

        expect(result).toBe(
            "https://www.linkedin.com/sharing/share-offsite/?url=https%3A%2F%2Fexample.com%2Fpost"
        );
        expect(global.window.open).toHaveBeenCalledWith(
            "https://www.linkedin.com/sharing/share-offsite/?url=https%3A%2F%2Fexample.com%2Fpost",
            "_blank"
        );

        delete global.window;
    });
});
