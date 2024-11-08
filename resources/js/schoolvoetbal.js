module.exports = {
    theme: {
      extend: {
        animation: {
          sparkle: 'sparkle 1s infinite',
        },
        keyframes: {
          sparkle: {
            '0%': {
              'box-shadow': '0 0 5px rgba(255, 255, 255, 0.3), 0 0 15px rgba(255, 255, 255, 0.4)',
            },
            '50%': {
              'box-shadow': '0 0 5px rgba(255, 255, 255, 0.6), 0 0 25px rgba(255, 255, 255, 0.8)',
            },
            '100%': {
              'box-shadow': '0 0 5px rgba(255, 255, 255, 0.3), 0 0 15px rgba(255, 255, 255, 0.4)',
            },
          },
        },
      },
    },
  }
