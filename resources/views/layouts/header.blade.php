<!doctype html>
<html lang="en">
  <head>
      <meta charset="utf-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
      <meta http-equiv="X-UA-Compatible" content="ie=edge" />
      <title>Dashboard</title>
      <!-- CSS files -->
      <link href="./dist/css/tabler.min.css?1684106062" rel="stylesheet" />
      <link href="./dist/css/tabler-flags.min.css?1684106062" rel="stylesheet" />
      <link href="./dist/css/tabler-payments.min.css?1684106062" rel="stylesheet" />
      <link href="./dist/css/tabler-vendors.min.css?1684106062" rel="stylesheet" />
      <link href="./dist/css/demo.min.css?1684106062" rel="stylesheet" />
      <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
      <style>
      @import url('https://rsms.me/inter/inter.css');

      :root {
          --tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
      }

      body {
          font-feature-settings: "cv03", "cv04", "cv11";
      }
      </style>
  </head>
  <header class="navbar navbar-expand-md d-print-none">
      <div class="container-xl">
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu"
              aria-controls="navbar-menu" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
          </button>
          <h1 class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3">ABC BANK</h1>
      </div>
  </header>
  <header class="navbar-expand-md">
      <div class="collapse navbar-collapse" id="navbar-menu">
          <div class="navbar">
              <div class="container-xl">
                  <ul class="navbar-nav">
                      <li class="nav-item" id="homeData">
                          <a class="nav-link" href="./home">
                              <span class="nav-link-icon d-md-none d-lg-inline-block">
                                  <!-- Download SVG icon from http://tabler-icons.io/i/home -->
                                  <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                      viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                      stroke-linecap="round" stroke-linejoin="round">
                                      <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                      <path d="M5 12l-2 0l9 -9l9 9l-2 0" />
                                      <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" />
                                      <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" />
                                  </svg>
                              </span>
                              <span class="nav-link-title">
                                  Home
                              </span>
                          </a>
                      </li>
                      <li class="nav-item" id="depositData">
                          <a class="nav-link" href="./deposit">
                              <span class="nav-link-icon d-md-none d-lg-inline-block">
                                  <!-- Download SVG icon from http://tabler-icons.io/i/checkbox -->
                                  <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                      viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                      stroke-linecap="round" stroke-linejoin="round">
                                      <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                      <path d="M9 11l3 3l8 -8" />
                                      <path d="M20 12v6a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h9" />
                                  </svg>
                              </span>
                              <span class="nav-link-title">
                                  Deposit
                              </span>
                          </a>
                      </li>
                      <li class="nav-item" id="withdrawData">
                          <a class="nav-link" href="./withdraw">
                              <span class="nav-link-icon d-md-none d-lg-inline-block">
                                  <!-- Download SVG icon from http://tabler-icons.io/i/checkbox -->
                                  <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                      viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                      stroke-linecap="round" stroke-linejoin="round">
                                      <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                      <path d="M9 11l3 3l8 -8" />
                                      <path d="M20 12v6a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h9" />
                                  </svg>
                              </span>
                              <span class="nav-link-title">
                                  Withdraw
                              </span>
                          </a>
                      </li>
                      <li class="nav-item" id="transferData">
                          <a class="nav-link" href="./transfer">
                              <span class="nav-link-icon d-md-none d-lg-inline-block">
                                  <!-- Download SVG icon from http://tabler-icons.io/i/checkbox -->
                                  <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                      viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                      stroke-linecap="round" stroke-linejoin="round">
                                      <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                      <path d="M9 11l3 3l8 -8" />
                                      <path d="M20 12v6a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h9" />
                                  </svg>
                              </span>
                              <span class="nav-link-title">
                                  Transfer
                              </span>
                          </a>
                      </li>
                      <li class="nav-item" id="statementData">
                          <a class="nav-link" href="./statement">
                              <span class="nav-link-icon d-md-none d-lg-inline-block">
                                  <!-- Download SVG icon from http://tabler-icons.io/i/checkbox -->
                                  <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                      viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                      stroke-linecap="round" stroke-linejoin="round">
                                      <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                      <path d="M9 11l3 3l8 -8" />
                                      <path d="M20 12v6a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h9" />
                                  </svg>
                              </span>
                              <span class="nav-link-title">
                                  Statement
                              </span>
                          </a>
                      </li>
                      <li class="nav-item">
                      <a class="nav-link" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                      </li>
                  </ul>
              </div>
          </div>
      </div>
  </header>
  <main class="py-4">
            @yield('content')
        </main>
</html>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/mouse0270-bootstrap-notify/3.1.5/bootstrap-notify.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script>
    
</script>
@yield('script')