<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Origami - Registro</title>

    <!-- Enlaces a estilos y scripts -->
    <link href="{{ asset('admin_assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="{{ asset('admin_assets/css/sb-admin-2.min.css') }}" rel="stylesheet">
</head>
<body class="bg-gradient-primary">
    <div class="container">
        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">¡Crea una cuenta!</h1>
                            </div>

                            <!-- Formulario de Registro -->
                            <form class="user" data-route="{{ route('register.save') }}">
                                <!-- Sección 1 -->
                                <div class="section" id="section1">
                                    <!-- Correo Electrónico -->
                                    <div class="mb-3">
                                        <label for="correo" class="form-label">Correo Electrónico</label>
                                        <input type="email" class="form-control" id="correo" name="email" required>
                                        <div class="invalid-feedback" id="emailError">Por favor, introduce una dirección de correo válida.</div>                                        
                                    </div>

                                    <!-- Tipo de cuenta -->
                                    <div class="mb-3">
                                        <label>Tipo de Cuenta</label>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="tipoCuenta" id="personaNatural" value="personaNatural" checked>
                                            <label class="form-check-label" for="personaNatural">Persona Natural</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="tipoCuenta" id="empresa" value="empresa">
                                            <label class="form-check-label" for="empresa">Empresa</label>
                                        </div>
                                    </div>

                                    <!-- Botón de Continuar -->
                                    <div class="d-grid">
                                        <button type="button" class="btn btn-primary" onclick="nextSection()">Continuar</button>
                                    </div>
                                </div>

                                <!-- Sección 2 -->
                                <div class="section" id="section2" style="display: none;">
                                    <!-- Campos según el tipo de cuenta -->
                                    <div class="mb-3" id="nombreFields">
                                        <label id="nombreLabel" for="nombre" class="form-label">Nombre</label>
                                        <input type="text" class="form-control" id="nombre" name="name" require>
                                        <div class="invalid-feedback" id="nameError">Por favor, introduce tu nombre.</div>
                                    </div>
                                    <div class="mb-3" id="razonSocialFields" style="display: none;">
                                        <label for="razonSocial" class="form-label">Razón Social</label>
                                        <input type="text" class="form-control" id="razonSocial" name="razonSocial">
                                        <div class="invalid-feedback" id="razonSocialError">Error</div>                                        
                                    </div>
                                    <div class="mb-3" id="giroFields" style="display: none;">
                                        <label for="giro" class="form-label">Giro</label>
                                        <input type="text" class="form-control" id="giro" name="giro">
                                        <div class="invalid-feedback" id="giroError">Error</div>                                        
                                    </div>
                                    <div class="mb-3" id="nitFields" style="display: none;">
                                        <label for="nit" class="form-label">NIT</label>
                                        <input type="text" class="form-control" id="nit" name="nit">
                                        <div class="invalid-feedback" id="nitError">Error</div>                                        
                                    </div>
                                    <div class="mb-3 form-check" id="exentoIvaFields" style="display: none;">
                                        <input type="checkbox" class="form-check-input" id="exentoIva" name="exentoIva" onclick="toggleRegistroIva()">
                                        <label class="form-check-label" for="exentoIva">Exento de IVA</label>
                                    </div>
                                    <div class="mb-3" id="registroIvaFields" style="display: none;">
                                        <label for="registroIva" class="form-label">Registro de IVA</label>
                                        <input type="text" class="form-control" id="registroIva" name="registroIva">
                                        <div class="invalid-feedback" id="registroIvaError">Error</div>                                        
                                    </div>
                                    <div class="mb-3" id="passwordFields">
                                        <label for="password" class="form-label">Contraseña</label>
                                        <div class="input-group">
                                            <input type="password" class="form-control" id="password" name="password" require>
                                            <div class="invalid-feedback" id="passwordError">La contraseña es obligatoria.</div>
                                        </div>
                                    </div>
                                    <div class="mb-3" id="confirmPasswordFields">
                                        <label for="confirmPassword" class="form-label">Confirmar Contraseña</label>
                                        <div class="input-group">
                                            <input type="password" class="form-control" id="confirmPassword" name="password_confirmation" require>
                                            <div class="invalid-feedback" id="confirmPasswordError">Por favor, confirma tu contraseña.</div>
                                        </div>
                                    </div>

                                    <!-- Botón de Continuar -->
                                    <div class="d-grid">
                                        <button type="button" class="btn btn-primary" onclick="submitForm()">Completar Registro</button>
                                    </div>
                                </div>
                            </form>

                            <hr>
                            <div class="text-center">
                                <a class="small" href="{{ route('login') }}">¿Ya tienes una cuenta? ¡Logueate!</a>
                            </div>
                            <div class="text-center">
                                <a class="small" href="{{ url('/') }}">Volver a inicio</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('admin_assets/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('admin_assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    
    <!-- Core plugin JavaScript-->
    <script src="{{ asset('admin_assets/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    
    <!-- Custom scripts for all pages-->
    <script src="{{ asset('admin_assets/js/sb-admin-2.min.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        let currentSection = 1;

    function validateForm() {
        const tipoCuenta = document.querySelector('input[name="tipoCuenta"]:checked').value;

        const emailValid = validateEmail();
        const nameValid = validateName();
        const passwordValid = validatePassword();
        const confirmPasswordValid = validateConfirmPassword();

        if (tipoCuenta === 'empresa') {
            const razonSocialValid = validateField('razonSocial');
            const giroValid = validateField('giro');
            const nitValid = validateField('nit');
            const exentoIva = document.getElementById('exentoIva').checked;

            if (!exentoIva) {
                const registroIvaValid = validateField('registroIva');
                return emailValid && nameValid && passwordValid && confirmPasswordValid &&
                       razonSocialValid && giroValid && nitValid && registroIvaValid;
            } else {
                return emailValid && nameValid && passwordValid && confirmPasswordValid &&
                       razonSocialValid && giroValid && nitValid;
            }
        } else {
            return emailValid && nameValid && passwordValid && confirmPasswordValid;
        }
    }

    function validateField(fieldId) {
        const field = document.getElementById(fieldId);
        const isValid = field.value.trim() !== '';

        const errorElement = document.getElementById(`${fieldId}Error`);
        errorElement.textContent = isValid ? '' : `Por favor, introduce ${fieldId === 'registroIva' ? 'el Registro de IVA' : 'este campo'}.`;

        if (!isValid) {
            field.classList.add('is-invalid');
        } else {
            field.classList.remove('is-invalid');
        }

        return isValid;
    }

    function updateErrorMessage(elementId, errorMessage) {
        const errorElement = document.getElementById(elementId);
        errorElement.textContent = errorMessage;
    }

    function validateEmail() {
        const emailInput = document.getElementById('correo');
        const isValid = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(emailInput.value);
        updateErrorMessage('emailError', isValid ? '' : 'Por favor, introduce una dirección de correo válida.');
        if (!isValid) {
            emailInput.classList.add('is-invalid');
        } else {
            emailInput.classList.remove('is-invalid');
        }
        return isValid;
    }

    function validateName() {
        const nameInput = document.getElementById('nombre');
        const isValid = nameInput.value.trim() !== '';
        updateErrorMessage('nameError', isValid ? '' : 'Por favor, introduce tu nombre.');
        if (!isValid) {
            nameInput.classList.add('is-invalid');
        } else {
            nameInput.classList.remove('is-invalid');
        }
        return isValid;
    }

    function validatePassword() {
        const passwordInput = document.getElementById('password');
        const isValid = passwordInput.value.trim() !== '';
        updateErrorMessage('passwordError', isValid ? '' : 'La contraseña es obligatoria.');
        if (!isValid) {
            passwordInput.classList.add('is-invalid');
        } else {
            passwordInput.classList.remove('is-invalid');
        }
        return isValid;
    }

    function validateConfirmPassword() {
        const passwordInput = document.getElementById('password');
        const confirmPasswordInput = document.getElementById('confirmPassword');
        const isEgual = confirmPasswordInput.value === passwordInput.value;
        const isEmpy = passwordInput.value.trim() !== '';
        const isValid = isEgual && isEmpy;
        updateErrorMessage('confirmPasswordError', isValid ? '' : 'Por favor, confirma tu contraseña.');
        if (!isValid) {
            confirmPasswordInput.classList.add('is-invalid');
        } else {
            confirmPasswordInput.classList.remove('is-invalid');
        }
        return isValid;
    }

    function nextSection() {
        const isEmailValid = validateEmail();

        if(isEmailValid){
        if (currentSection < 2) {
            currentSection++;
            showSection(currentSection);
        }
        }
    }

    function showSection(section) {
        for (let i = 1; i <= 2; i++) {
            document.getElementById('section' + i).style.display = 'none';
        }
        document.getElementById('section' + section).style.display = 'block';
    }

        // Mostrar u ocultar campos según el tipo de cuenta seleccionado
    document.querySelectorAll('input[name="tipoCuenta"]').forEach(function (radio) {
        radio.addEventListener('change', function () {
            const tipoCuenta = document.querySelector('input[name="tipoCuenta"]:checked').value;
            toggleFields(tipoCuenta);
        });
    });

    function toggleFields(tipoCuenta) {
        const nombreFields = document.getElementById('nombreFields');
        const razonSocialFields = document.getElementById('razonSocialFields');
        const giroFields = document.getElementById('giroFields');
        const nitFields = document.getElementById('nitFields');
        const exentoIvaFields = document.getElementById('exentoIvaFields');
        const registroIvaFields = document.getElementById('registroIvaFields');
        
        // Ocultar todos los campos
        nombreFields.style.display = 'none';
        razonSocialFields.style.display = 'none';
        giroFields.style.display = 'none';
        nitFields.style.display = 'none';
        exentoIvaFields.style.display = 'none';
        registroIvaFields.style.display = 'none';

        // Mostrar campos según el tipo de cuenta
        if (tipoCuenta === 'personaNatural') {
            nombreFields.style.display = 'block';
        } else if (tipoCuenta === 'empresa') {
            const nombreLabel = document.getElementById('nombreLabel');
            // Restablecer texto predeterminado
            nombreLabel.innerText = 'Nombre Comercial';


            nombreFields.style.display = 'block';
            razonSocialFields.style.display = 'block';
            giroFields.style.display = 'block';
            nitFields.style.display = 'block';
            exentoIvaFields.style.display = 'block';
            toggleRegistroIva();
        }
    }

    // Mostrar u ocultar campo de registro de IVA según checkbox
    function toggleRegistroIva() {
        const registroIvaFields = document.getElementById('registroIvaFields');
        const exentoIvaCheckbox = document.getElementById('exentoIva');

        if (exentoIvaCheckbox.checked) {
            registroIvaFields.style.display = 'none';
        } else {
            registroIvaFields.style.display = 'block';
        }
    }

    // Mostrar/Ocultar contraseña
    function togglePasswordVisibility(fieldId) {
        const field = document.getElementById(fieldId);
        const fieldType = field.getAttribute('type');
        if (fieldType === 'password') {
            field.setAttribute('type', 'text');
        } else {
            field.setAttribute('type', 'password');
        }
    }

    function submitForm() {
        const isFormValid = validateForm();

        if (isFormValid) { 
        const tipoCuenta = document.querySelector('input[name="tipoCuenta"]:checked').value;
        const formData = new FormData();

        // Agregar campos comunes a todos los tipos de cuenta
        // formData.append('_token', '{{ csrf_token() }}');
        formData.append('email', document.getElementById('correo').value);
        formData.append('password', document.getElementById('password').value);

        if (tipoCuenta === 'personaNatural') {
            // Agregar campos específicos para persona natural
            formData.append('email', document.getElementById('correo').value);
            formData.append('name', document.getElementById('nombre').value);
            formData.append('es_empresa', 0);

        } else if (tipoCuenta === 'empresa') {
            // Agregar campos específicos para empresa
            formData.append('es_empresa', 1);
            formData.append('name', document.getElementById('nombre').value);
            formData.append('razon_social', document.getElementById('razonSocial').value);
            formData.append('giro', document.getElementById('giro').value);
            formData.append('nit', document.getElementById('nit').value);
            formData.append('exenta_iva', document.getElementById('exentoIva').checked ? 1 : 0);
            if (!document.getElementById('exentoIva').checked) {
                formData.append('registro_iva', document.getElementById('registroIva').value);
            }
        }

        // Obtener la URL de la ruta desde el atributo de datos
        const formElement = document.querySelector('.user');
        const route = formElement.dataset.route;

                // Realizar la petición AJAX
        const csrfToken = document.head.querySelector('meta[name="csrf-token"]').content;
        
        fetch(route, {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': csrfToken
            }
        })
        .then(response => {
            if (!response.ok) {
                console.error(response);
                console.error();(`HTTP error! Status: ${response.status}`);
                Swal.fire({
                    icon: 'error',
                    title: '¡Error!',
                    text: 'Hubo un error al procesar la solicitud',
                    showConfirmButton: false,
                    timer: 2500
                })
                .then((result) => {
                    if (result.dismiss === Swal.DismissReason.timer) {
                        window.location.href = "{{ route('register') }}";
                    }
                });
            } else {
            Swal.fire({
                    icon: 'success',
                    title: '¡Registro exitoso!',
                    text: 'Ahora puedes iniciar sesión',
                    showConfirmButton: false,
                    timer: 2500
                }).then((result) => {
                    if (result.dismiss === Swal.DismissReason.timer) {
                        window.location.href = "{{ route('login') }}";
                    }
                });
            }
            })
        .catch(error => {
            console.error('Error:', error);
        });   
    }  
}
    </script>
    
</body>
</html>
