const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    purge: ['./storage/framework/views/*.php', './resources/views/**/*.blade.php'],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
                lora:['Lora'],
                bowlby:['Bowlby One'],
            },
            colors:{
                primary:'#FAE8AD',
                secondary:'#717171',
                dark:{
                    black:'#484048',
                    red:'#CF6C58',
                    yellow:'#FAF074',
                    purple:'#D5B1F2',
                    blue:'#A6E2FB',
                },
                soft:{
                    yellow:'#FDD08D',
                    pink:'#FF98C5',
                    blue:'#9DD7FF',
                },
                transparent_bg:'rgba(0,0,0,0.7)',
                glass_bg:'rgba( 255, 255, 255, 0.25 )',
            }
        },
    },

    variants: {
        extend: {
            opacity: ['disabled'],
        },
    },

    plugins: [require('@tailwindcss/forms')],
};
