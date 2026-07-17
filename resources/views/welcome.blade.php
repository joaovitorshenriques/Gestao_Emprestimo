<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Nexo Credito</title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>
    <header class="landing-header py-3">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <a class="navbar-brand fw-bold fs-4 d-flex align-items-center gap-2" href="/">
                    <span class="brand-mark"><i class="bi bi-cash-coin"></i></span>
                    Nexo Credito
                </a>

                <nav>
                    @if (Route::has('login'))
                    <div class="d-flex gap-2">
                        @auth
                        <a href="{{ url('/dashboard') }}" class="btn btn-primary px-4">
                            <i class="bi bi-speedometer2 me-2"></i>Painel
                        </a>
                        @else
                        <a href="{{ route('login') }}" class="btn btn-outline-primary px-4">
                            <i class="bi bi-box-arrow-in-right me-2"></i>Entrar
                        </a>

                        @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="btn btn-primary px-4">
                            <i class="bi bi-person-plus me-2"></i>Cadastrar
                        </a>
                        @endif
                        @endauth
                    </div>
                    @endif
                </nav>
            </div>
        </div>
    </header>

    <section class="hero-section d-flex align-items-center">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-lg-9 col-xl-8 text-center">
                    <span class="hero-pill mb-3">Sistema academico de gestao financeira</span>
                    <h1 class="display-4 fw-bold mb-4 text-white">
                        Gestao de credito <span class="hero-highlight">clara e organizada</span>
                    </h1>
                    <p class="lead text-white-75 mb-5">
                        Cadastre clientes, acompanhe emprestimos e registre pagamentos em um painel simples para apresentar e usar.
                    </p>
                    <div class="d-flex flex-column flex-sm-row justify-content-center gap-3">
                        @auth
                        <a href="{{ url('/dashboard') }}" class="btn btn-primary btn-lg px-5">
                            <i class="bi bi-speedometer2 me-2"></i>Acessar Painel
                        </a>
                        @else
                        <a href="{{ route('register') }}" class="btn btn-primary btn-lg px-5">
                            <i class="bi bi-rocket me-2"></i>Comecar
                        </a>
                        <a href="#features" class="btn btn-outline-light btn-lg px-5">
                            <i class="bi bi-info-circle me-2"></i>Ver recursos
                        </a>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="features" class="pb-5 feature-band">
        <div class="container py-5">
            <h2 class="text-center mb-5 fw-bold">Funcionalidades do sistema</h2>

            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm feature-card">
                        <div class="card-body text-center p-4">
                            <span class="feature-icon mb-3"><i class="bi bi-graph-up fs-3"></i></span>
                            <h3 class="h5">Visao do painel</h3>
                            <p class="text-muted">Acompanhe emprestimos, status, parcelas e clientes em uma tela de consulta.</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm feature-card">
                        <div class="card-body text-center p-4">
                            <span class="feature-icon mb-3"><i class="bi bi-person-vcard fs-3"></i></span>
                            <h3 class="h5">Cadastro de clientes</h3>
                            <p class="text-muted">Registre dados basicos, renda e contato para associar cada operacao.</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm feature-card">
                        <div class="card-body text-center p-4">
                            <span class="feature-icon mb-3"><i class="bi bi-shield-check fs-3"></i></span>
                            <h3 class="h5">Analise de risco</h3>
                            <p class="text-muted">Simule a viabilidade do emprestimo usando renda, garantias e valor solicitado.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer class="site-footer text-white py-4 mt-auto">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="d-flex align-items-center">
                        <span class="brand-mark me-2"><i class="bi bi-cash-coin"></i></span>
                        <h3 class="h5 mb-0">Nexo Credito</h3>
                    </div>
                    <p class="text-white-50 mb-md-0 mt-2">Projeto academico para gestao de emprestimos.</p>
                </div>
                <div class="col-md-6 text-md-end mt-3 mt-md-0">
                    <p class="text-white-50 mb-0">Controle de clientes, emprestimos e pagamentos</p>
                    <p class="text-white-50 mb-md-0 mt-2">&copy; {{ date('Y') }} Trabalho final</p>
                </div>
            </div>
        </div>
    </footer>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
