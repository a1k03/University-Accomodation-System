const firstname = document.getElementById('firstname')
const last_name = document.getElementById('last_name')
const date_of_birth = document.getElementById('date_of_birth')
const address = document.getElementById('address')
const telephone_number = document.getElementById('telephone_number')
const email = document.getElementById('email')
const male = document.getElementById('male')
const female = document.getElementById('female')
const form = document.getElementById('form')
const errorElement = document.getElementById('form__error')

form.addEventListener('submit', (e) => {
    let messages = []
        if (firstname.value == '' || firstname.value == null) {
            messages.push('Name is required')
        }

        if (messages.length > 0) {
            e.preventDefault()
            errorElement.innerText = messages.join(', ')
        }
    
    
})