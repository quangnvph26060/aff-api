/** @type {import('tailwindcss').Config} */
export default {
    content: ["./index.html", "./js/**/*.{vue,js,ts,jsx,tsx}"],
    theme: {
        screens: {
            'n': '0px',

            'sm': '576px',

            'md': '768px',

            'lg': '992px',

            'xl': '1200px',

            '2xl': '1400px',
        },
        extend: {
            colors: {
                'primary-white-color': '#FFFFFF',
                'icon-hover-color': '#FAFAFA',
                'button-hover-color': '#F2F2F2',
                'search-bar-color': '#F2F2F2',
                'button-search-color': '#E03C31',
                'button-search-hover-color': '#D03C31',
                'selected-color': '#91423d',
                'phone-color': '#1dbabf',
            },
        },
    },
    plugins: [],
};
