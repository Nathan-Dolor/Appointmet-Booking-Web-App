<nav class="navbar navbar-expand-lg" style="background-color: #A4D6F0;">
  <div class="container-fluid">
    <a class="navbar-brand" href="#"><strong><span style="color: #0d6efd;">Book</span><span style="color: #FF0000;">It</span></strong></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarText">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">        
        @auth
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="{{route('home')}}">Home</a>
          </li>
        @else
          @if(Route::currentRouteName() == 'login')
          <li class="nav-item">
            <a class="nav-link active" href="{{route('login')}}">Login</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('registration')}}">Registration</a>
          </li>
          @else
          <li class="nav-item">
            <a class="nav-link" href="{{route('login')}}">Login</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="{{route('registration')}}">Registration</a>
          </li>
          @endif
          
        @endauth
      </ul>

      @auth
      <?php
      $type = ucfirst(auth()->user()->user_type);
      ?>
      
      <span class="navbar-text dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          {{auth()->user()->fname}} {{auth()->user()->lname}}
          </a>
          <ul class="dropdown-menu dropdown-menu-end">
            <li style="margin-left: 15px;"><strong>{{$type}} Account</strong></li>
            <li><a class="dropdown-item" href="{{route('logout')}}">Logout</a></li>
          </ul>
      </span>
      @endauth
    </div>
    
  </div>
</nav>