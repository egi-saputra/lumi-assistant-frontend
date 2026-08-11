import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";

/** @type {import('tailwindcss').Config} */
export default {
    darkMode: "class",
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
        "./resources/js/**/*.vue",
    ],

    theme: {
        extend: {
            colors: {
                ink: "#1B1B1D",
                // paper: "#FFF8F3",
                jade: "#FF6B00",
                "jade-light": "#FF8A33",
                gold: "#D8A83E",
                slate: "#6B6560",
                // ink: "#0B1F1C",
                paper: "#EEF3EF",
                wa: "#1F8A5F",
                "wa-light": "#2BB673",
                lime: "oklch(84.1% 0.238 128.85)",
                // lime: "oklch(76.8% 0.233 130.85)",
                // "lime-light": "oklch(84.1% 0.238 128.85)",
                "lime-light": "oklch(89.7% 0.196 126.665)",
            },
            fontFamily: {
                display: ["Fraunces", "serif"],
                sans: ["Inter", "ui-sans-serif", "system-ui"],
                mono: ['"JetBrains Mono"', "ui-monospace", "monospace"],
            },
        },
    },

    plugins: [forms],
};
