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

function validateStambuk(stambuk) {
    const stambukRegex = /^(131|130)(2022|2023|2024|2025)[0-9]{5}$/;

    if (!stambukRegex.test(stambuk)) {
        return { success: false, message: "Stambuk harus diawali dengan 131 atau 130, diikuti tahun 2022-2025, dan panjangnya 11 karakter." };
    }
    return { success: true, message: "Stambuk valid." };
}

function validateEmail(email) {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    if(!emailRegex.test(email)) {
        return { success: false, message: "Format email tidak valid." };
    }
    const domain = email.split('@')[1];

    if(domain !=='umi.ac.id' && domain !== 'student.umi.ac.id') {
        return { success: false, message: "Email harus menggunakan domain UMI."};
    }
    return { success: true, message: "Email Valid" };
}

function validatePassword(password, confirmPassword) {
    const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z]).{8,}$/;

    if(!passwordRegex.test(password)) {
        return { success: false, message: "Password harus mengandung huruf besar, huruf kecil, dan minimal 8 karakter."};
    }
    if(password !== confirmPassword) {
        return { success: false, message: "Password tidak sama."};
    }
    return { success: true, message: "Password Valid"};
}
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

$(document).ready(function () {
    $('#registerForm').submit(function (e) {
        e.preventDefault();
        const emailinput = document.getElementById('email');
        const passwordinput = document.getElementById('password');
        const email = $('#email').val();
        const password = $('#password').val();
        const confirmPassword = $('#confirmPass').val();

        const emailResult = validateEmail(email);
        const passwordResult = validatePassword(password, confirmPassword);

        console.log("confirm pass : ",confirmPassword)
        console.log("origin pass : ",password);
        console.log(email);
        let isValid = true;

        if (!emailResult.success) {
           emailinput.setCustomValidity(emailResult.message);
           isValid = false;
        } else {
            emailinput.setCustomValidity('');
        }

        if (!passwordResult.success) {
            passwordinput.setCustomValidity(passwordResult.message);
            isValid = false;
        } else {
            $('#passwordError').text('');
        }
        if (isValid) {
            
            $.ajax({
                url: '/tubes_web/public/register/authenticate',
                type: 'post',
                data: $('#registerForm').serialize(),
                dataType: 'json',
                success: function (response) {
                    if (response.status === 'success') {
                        alert('Register Berhasil');
                        window.location.href = '/tubes_web/public/login';
                    } else {
                        alert('Register Gagal ' + response.message);
                        console.log(response.message);
                    }
                },
                error: function (xhr, status, error) {
                    console.log('Terjadi kesalahan: ' + error);
                },
            });
        }
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
                    alert(response.role);
                    window.location.href = response.redirect;

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
