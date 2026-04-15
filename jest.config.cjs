module.exports = {
    collectCoverage: true,
    collectCoverageFrom: [
        "sub-www/js/js-global-auth/commonJS.js",
    ],
    coverageDirectory: "coverage",
    coverageReporters: [
        "lcov",
        "text",
    ],
    testEnvironment: "node",
    testMatch: [
        "**/tests/**/*.test.js",
    ],
};
