const navMenu = document.getElementById('nav-menu'),
      navToggle = document.getElementById('nav-toggle'),
      navClose = document.getElementById('nav-close'),
      login = document.getElementById('login'),
      loginBtn = document.getElementById('login-btn')
      loginClose = document.getElementById('login-close'),
      signup = document.getElementById('signup'),
      signupLink = document.getElementById('signupLink'),
      signupClose = document.getElementById('signup-close'),
      loginLink = document.getElementById('login-link'),
      forgotPassword = document.getElementById('forgot__password'),
      forgotPasswordLink = document.getElementById('forgotPasswordLink'),
      forgotPasswordClose = document.getElementById('forgot-password-close'),
      backToLoginLink = document.getElementById('back-to-login-link')


// Show Menu
navToggle.addEventListener('click', () => {
    navMenu.classList.add('show-menu')
})

// Hide Menu
navClose.addEventListener('click', () => {
    navMenu.classList.remove('show-menu')
})

// Login Show
loginBtn.addEventListener('click', () => {
    login.classList.add('show-login')
})

// Login Hide
loginClose.addEventListener('click', () => {
    login.classList.remove('show-login')
})

// Show Signup
signupLink.addEventListener('click', () => {
    signup.classList.add('show-login')
})

//Hide Signup
signupClose.addEventListener('click', () => {
    signup.classList.remove('show-login')
})

// Show Login from Signup 
loginLink.addEventListener('click', (e) => {
    e.preventDefault()
    signup.classList.remove('show-login')
    login.classList.add('show-login')
})

// Show Forgot Password
forgotPasswordLink.addEventListener('click', (e) => {
    e.preventDefault()
    login.classList.remove('show-login')
    forgotPassword.classList.add('show-login')
 })
 
 
//  Hide Forgot Password
 forgotPasswordClose.addEventListener('click', () => {
    forgotPassword.classList.remove('show-login')
 })
 
 //Back to Login from Forgot Password
 backToLoginLink.addEventListener('click', (e) => {
    e.preventDefault()
    forgotPassword.classList.remove('show-login')
    login.classList.add('show-login')
 })