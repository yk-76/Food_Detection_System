const mix = require('laravel-mix');

mix.js('resources/js/app.js', 'public/js')
   .postCss('resources/css/app.css', 'public/css', [
       require('@tailwindcss/postcss'),
   ]);

// 1. Stop the Windows pop-up messages
mix.disableNotifications();

// 2. Make the terminal completely quiet
mix.options({
    stats: {
        all: false,      // Turn off all default logging
        errors: true,    // Only show if there is an actual error
        warnings: true,  // Show warnings
        colors: true     // Keep the terminal readable
    }
});