// import defaultTheme from 'tailwindcss/defaultTheme';
// import forms from '@tailwindcss/forms'
// import typography from '@tailwindcss/typography'
// import aspectRatio from '@tailwindcss/aspect-ratio';

/** @type {import('tailwindcss').Config} */
export default {
	content: [
		'./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
		'./storage/framework/views/*.php',
		'./resources/**/*.blade.php',
		'./resources/**/*.js',
		'./resources/**/*.vue'
	],
	theme: {
		extend: {
			fontFamily: {
				sans: ['Figtree', ...defaultTheme.fontFamily.sans],
			},
		},
		animation: {
			"fade-in-bottom": {
				"0%": {
					transform: "translateY(50px)",
					opacity: "0"
				},
				to: {
					transform: "translateY(0)",
					opacity: "1"
				}
			}
		}
	},
	plugins: [
		// typography,
		// forms,
		// aspectRatio,
	]
};
