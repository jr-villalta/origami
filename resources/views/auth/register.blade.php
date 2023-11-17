<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
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
                            <form action="{{ route('register.save') }}" method="POST" class="user">
                                @csrf
                                <!-- Sección 1 -->
                                <div class="section" id="section1">
                                    <!-- Correo Electrónico -->
                                    <div class="mb-3">
                                        <label for="correo" class="form-label">Correo Electrónico</label>
                                        <input type="email" class="form-control" id="correo" name="correo" required>
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
                                        <input type="text" class="form-control" id="nombre" name="nombre">
                                    </div>
                                    <div class="mb-3" id="razonSocialFields" style="display: none;">
                                        <label for="razonSocial" class="form-label">Razón Social</label>
                                        <input type="text" class="form-control" id="razonSocial" name="razonSocial">
                                    </div>
                                    <div class="mb-3" id="giroFields" style="display: none;">
                                        <label for="giro" class="form-label">Giro</label>
                                        <input type="text" class="form-control" id="giro" name="giro">
                                    </div>
                                    <div class="mb-3" id="nitFields" style="display: none;">
                                        <label for="nit" class="form-label">NIT</label>
                                        <input type="text" class="form-control" id="nit" name="nit">
                                    </div>
                                    <div class="mb-3 form-check" id="exentoIvaFields" style="display: none;">
                                        <input type="checkbox" class="form-check-input" id="exentoIva" name="exentoIva" onclick="toggleRegistroIva()">
                                        <label class="form-check-label" for="exentoIva">Exento de IVA</label>
                                    </div>
                                    <div class="mb-3" id="registroIvaFields" style="display: none;">
                                        <label for="registroIva" class="form-label">Registro de IVA</label>
                                        <input type="text" class="form-control" id="registroIva" name="registroIva">
                                    </div>
                                    <div class="mb-3" id="passwordFields">
                                        <label for="password" class="form-label">Contraseña</label>
                                        <div class="input-group">
                                            <input type="password" class="form-control" id="password" name="password">
                                            <button class="btn btn-outline-secondary" type="button" id="togglePassword" onclick="togglePasswordVisibility('password')"><i class="fas fa-eye"></i></button>
                                        </div>
                                    </div>
                                    <div class="mb-3" id="confirmPasswordFields">
                                        <label for="confirmPassword" class="form-label">Confirmar Contraseña</label>
                                        <div class="input-group">
                                            <input type="password" class="form-control" id="confirmPassword" name="confirmPassword">
                                            <button class="btn btn-outline-secondary" type="button" id="toggleConfirmPassword" onclick="togglePasswordVisibility('confirmPassword')"><i class="fas fa-eye"></i></button>
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

    <script>
        let currentSection = 1;

        function nextSection() {
            if (currentSection < 2) {
                currentSection++;
                showSection(currentSection);
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
        const tipoCuenta = document.querySelector('input[name="tipoCuenta"]:checked').value;

        if (tipoCuenta === 'personaNatural') {
            // Procesar datos para persona natural (nombre, correo, contraseña)
            const nombre = document.getElementById('nombre').value;
            const correo = document.getElementById('correo').value;
            const password = document.getElementById('password').value;

            // Realizar las acciones necesarias con estos datos (puedes enviarlos al controlador, mostrar en un alert, etc.)
            alert(`Persona Natural\nNombre: ${nombre}\nCorreo: ${correo}\nContraseña: ${password}`);
        } else if (tipoCuenta === 'empresa') {
            // Procesar datos para empresa (nombre, razón social, giro, NIT, etc.)
            const nombre = document.getElementById('nombre').value;
            const razonSocial = document.getElementById('razonSocial').value;
            const giro = document.getElementById('giro').value;
            const nit = document.getElementById('nit').value;
            const password = document.getElementById('password').value;

            // Verificar si está exento de IVA
            const exentoIva = document.getElementById('exentoIva').checked;
            let registroIva = 'Exento de IVA';
            if (!exentoIva) {
                registroIva = document.getElementById('registroIva').value;
            }

            // Realizar las acciones necesarias con estos datos (puedes enviarlos al controlador, mostrar en un alert, etc.)
            alert(`Empresa\nNombre comercial: ${nombre}\nRazón Social: ${razonSocial}\nGiro: ${giro}\nNIT: ${nit}\nExento de IVA: ${exentoIva ? 'Sí' : 'No'}\nRegistro IVA: ${registroIva}\nContraseña: ${password}`);
        }
    }
    </script>
</body>
</html>
