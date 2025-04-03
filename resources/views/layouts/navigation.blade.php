<nav class="navbar navbar-expand-lg navbar-light ">
    <div class="container-fluid">
      <a class="navbar-brand" href="{{route('home')}}">
          <img style="width: 40px" src="{{asset('images/logo.png')}}">
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="{{route('home')}}">Inicio</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('services')}}">Servicios</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('psychologists.index')}}">Psicólogos</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('home')}}#contacto">Contacto</a>
          </li>
        </ul>

        <ul class="navbar-nav ms-auto">
          @auth
          <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  {{ Auth::user()->name ?? '' }}
              </a>
              <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
                  <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Perfil</a></li>
                  <li><a class="dropdown-item" href="{{ route('bookings.show') }}">Mis reservas</a></li>
                  @if(\App\Helpers\UsersHelper::isPsychologist(Auth::id()))
                  <li><a class="dropdown-item" href="{{ route('appointment.configure') }}">Configurar mi consultorio</a></li>
                  @endif
                  <form method="POST" action="{{ route('logout') }}">
                      @csrf
                      <li class="nav-item" onclick="event.preventDefault(); this.closest('form').submit();">
                          <a class="dropdown-item" href="#">Cerrar sesión</a>
                      </li>
                  </form>
              </ul>
          </li>
          @else
          <li class="nav-item">
              <a class="nav-link" href="{{ route('login') }}">Login</a>
          </li>
          @endauth
      </ul>
      </div>
    </div>
  </nav>

