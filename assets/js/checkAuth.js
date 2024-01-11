let isAuth = false;

const redirect = () => window.location.replace('/authorization.html');

fetch('../../php/api/Auth/CheckAuth.php')
  .then(res => res.json())
  .then(res => {
    if (!res.auth) redirect();
    else isAuth = true;
  })