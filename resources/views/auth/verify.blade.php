<!DOCTYPE html>
<html lang="es" style="background: #B0535E">
    <head>
        <meta charset="utf-8" />
        <title>Verificar correo electrónico</title>
        <link rel="icon" type="image/x-icon" href="/img/logo.png" />
        <link href="/css/sb-admin-2.css" rel="stylesheet" />
        <link href="/css/style.css" rel="stylesheet">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main style="background-color: #B0535E">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-8">
                                <div class="card shadow-lg border-0 rounded-lg mt-5 mb-5">
                                    <img class="imagen my-4" src="/img/logo.png" width="100px" height="100px" alt="Dulce Encanto">
                                    <h3 class="text-center font-weight-light " style="color: #B0535E">Dulce Encanto</h3>
                                    <div class="card-header text-center">{{ __('Verify Your Email Address') }}</div>
                                        <div class="card-body">
                                            @if (session('resent'))
                                                <div class="alert alert-success" role="alert">
                                                    {{ __('A fresh verification link has been sent to your email address.') }}
                                                </div>
                                            @endif

                                            {{ __('Before proceeding, please check your email for a verification link.') }}
                                            {{ __('If you did not receive the email') }},
                                            <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                                                @csrf
                                                <button type="submit" class="btn btn-link p-0 m-0 align-baseline centrado">{{ __('click here to request another') }}</button>.
                                            </form>
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="/js/sb-admin-2.js"></script>
    </body>
</html>