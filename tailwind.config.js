const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    darkMode:'class',
    purge: ['./storage/framework/views/*.php', './resources/views/**/*.blade.php'],
    theme: {
        extend: {
            padding:{
              'small':'0.15rem',
            },
            height:{
              '1/10':'10%',
              '2/10':'20%',
              '3/10':'30%',
              '4/10':'40%',
              '5/10':'50%',
              '6/10':'60%',
              '7/10':'70%',
              '8/10':'80%',
              '9/10':'90%',
              '10/10':'100%',
            },
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
                lora:['Lora'],
                bowlby:['Bowlby One'],
                poppins:['Poppins']
            },
            colors:{
                blur:'rgba(0,0,0,0.6)',
                primary:'#FAE8AD',
                secondary:'#717171',
                dark:{
                    black:'#484048',
                    red:'#CF6C58',
                    yellow:'#FAF074',
                    purple:'#D5B1F2',
                    blue:'#A6E2FB',
                },
                title:'#B4B1A7',
                login:'rgba(60,187,241,0.27)',
                signup:'rgba(246,229,21,0.66)',
                about:'#2A9D8F',
                read_me:'#E9C46A',
                contact_me:'#E07A5F',
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
