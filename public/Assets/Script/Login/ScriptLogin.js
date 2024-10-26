const registerBtn = document.getElementById('register');
const container = document.getElementById('container');
const loginBtn = document.getElementById('login');
const togglePassword = document.querySelector('#togglePassword');
const password = document.querySelector('#password');
const passwordconfirm = document.querySelector('#confirmPass');
const toggleIcon = document.querySelector('#toggleIcon');
const confirmPassword = document.querySelector('#confirmPassword');
const toggleIconConfirmation = document.querySelector('#toggleIconConfirmation');

const loginIconPass = document.querySelector('#loginIconPass');  
const togglePassLogin = document.querySelector('#togglePassLogin'); 
const passwordLogin = document.querySelector('#passwordLogin');  

registerBtn.addEventListener('click',()=>{
    container.classList.add("active");
});

loginBtn.addEventListener('click',()=>{
    container.classList.remove("active");
});

togglePassword.addEventListener('click', function () {
    
    const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
    password.setAttribute('type', type);
    
    toggleIcon.classList.toggle('bi-eye');
    toggleIcon.classList.toggle('bi-eye-slash');
});

confirmPassword.addEventListener('click', function(){
    const type = passwordconfirm.getAttribute('type') === 'password' ? 'text' : 'password';
    passwordconfirm.setAttribute('type',type);

    toggleIconConfirmation.classList.toggle('bi-eye');
    toggleIconConfirmation.classList.toggle('bi-eye-slash');
});

loginIconPass.addEventListener('click', ()=>{
    const type = passwordLogin.getAttribute('type') === 'password' ? 'text' : 'password';
    passwordLogin.setAttribute('type',type);

    togglePassLogin.classList.toggle('bi-eye');
    togglePassLogin.classList.toggle('bi-eye-slash');
})

//ajax

$(document).ready(function(){
    $('#registerForm').submit(function(e){
        e.preventDefault();
        $.ajax({
            url: '/tubes_web/public/register/authenticate',
            type: 'post',
            data: $('#registerForm').serialize(),
            dataType: 'json',
            success: function(response){
                if(response.status === 'success'){
                    alert('Register Berhasil');
                    window.location.href = '/tubes_web/public/login';
                } else {
                    alert('Register Gagal');
                }
            },
            error: function(xhr, status, error){
                console.log('Terjadi kesalahan: ' + error);
            }
        });
    });

    $('#loginForm').submit(function(e){
        e.preventDefault();
        $.ajax({
            url: '/tubes_web/public/login/authenticate',
            type: 'post',
            data: $('#loginForm').serialize(),
            dataType: 'json',
            success: function(response){
                if(response.status === 'success'){
                    window.location.href = '/tubes_web/public/';
                } else {
                    alert('stambuk atau password salah');
                }
            },
            error: function(xhr, status, error){
                console.log('Terjadi kesalahan: ' + xhr.responseText);
            }
        });
    });
});
