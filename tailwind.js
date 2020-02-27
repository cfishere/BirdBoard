
let colors = {
  transparent: 'transparent',
  'grey-light': '#E1E6E8'
}
module.exports = {
  theme: {
    colors: {
      'transparent': 'transparent',
      'sk-green': '#5D7F57',
      'sk-green-dark': '#304325',
      'grey-light': '#F5F6F9',
      'grey': 'rgba(0,0,0,0.4)',
      'black': '#231F20',
      'white' : '#FFFFFF',
      'green-darker': '#3b8070',
      'blue': '#47cdff',
    },    
    backgroundColors:{       
        page: 'var(--page-background-color)',
        card: 'var(--card-background-color)',
        button: 'var(--button-background-color)'
    },
    shadows: {
    		default: '0, 0, 5px, 0 rgba(0, 0, 0, 0.08)',
    	},    
    fontFamily: {
      'source': [
        '"Source Sans Pro"',
        'sans-serif'
      ],
      'open': [
        'Open Sans',
        'sans-serif'
      ],
    },
    borderWidth: {
      default: '1px',
      '0': '0',
      '2': '2px',
      '4': '4px',
      '8': '8px',
      '10': '10px',
    },
    minWidth: {
      '0': '0',
      'xxs': '10rem',
      'xs': '20rem',
      'sm': '30rem',
      'md': '40rem',
      'lg': '50rem',
      'xl': '60rem',
      '2xl': '70rem',
      '3xl': '80rem',
      '4xl': '90rem',
      '5xl': '100rem',
      'full': '100%',
    }
  }
}