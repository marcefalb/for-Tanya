const inputs = document.querySelectorAll('.registration__textfields input');
const regBtn = document.querySelector('.registration__login');
const regValidation = document.querySelector('.auth-validation');

const checkIsLoginValid = (login) => {
  return /^[A-Za-z0-9_-]+$/.test(login);
};
const checkIsPasswordValid = (password) => {
  return password.length >= 6;
}

regBtn.addEventListener('click', () => {
  const activeClass = 'input_unvalid';
  const [login, password, remember] = inputs;
  let validation = true;
  
  inputs.forEach(input => {
    if (!input.value && checkIsLoginValid(login) && checkIsPasswordValid(password)) {
      input.classList.add(activeClass);
      validation = false;
      
      input.addEventListener('change', () => input.classList.remove(activeClass));
    }
  });
  if (validation) {
    fetch('../../php/api/Auth/Register.php', {
      method: 'POST',
      body: JSON.stringify({
        login: login.value,
        password: password.value,
      }),
    })
      .then(res => res.json())
      .then(res => {
        if (res.auth) {
          document.cookie = `token=${res.token}`;
          if (!remember.checked) {
            window.addEventListener('beforeunload', function (e) {
              document.cookie = '';
            });
          }
          window.location.pathname = '/messages.html';
        } else {
          window.location.pathname = '/authorization.html';
        }
      })
  }
})