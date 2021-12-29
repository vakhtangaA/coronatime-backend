module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            colors: {
                btnColor: "#0FBA68",
                bgNewCases: "#F3EBFF",
                bgRecoveredCases: "#EBFCF3",
                bgDeathCases: "#FEFDEC",
                tableHeader: "#f6f6f7",
            },
            backgroundImage: {
                caseChart: "url(/images/caseCharts.png)",
            },
            spacing: {
                minHeightChartImg: "8rem",
                "max-w-10xl": "1500px",
            },
        },
    },
    plugins: [],
};
