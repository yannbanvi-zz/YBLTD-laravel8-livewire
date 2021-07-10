  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="p-1">
      <div class="bg-dark">
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle" src="{{asset('images/user.png')}}" alt="User profile picture">
                </div>

                <h3 class="profile-username text-center ellipsis">{{ auth()->user()->prenom }} {{ auth()->user()->nom }}</h3>

                <p class="text-muted text-center">
                @foreach(auth()->user()->roles as $role)
                    {{ \Illuminate\Support\Str::ucfirst($role->nom) }}
                    ,
                @endforeach
                </p>

                <ul class="list-group bg-dark mb-3">
                  <li class="list-group-item">
                    <a href="#" class="d-flex align-items-center "><i class="fa fa-lock pr-2"></i><b >Mot de passe</b> </a>
                  </li>
                  <li class="list-group-item">
                    <a href="#" class="d-flex align-items-center"><i class="fa fa-user pr-2"></i><b >Mon profile</b> </a>
                  </li>
                </ul>


                <a href="{{ route('logout') }}"
                    onclick="event.preventDefault();document.getElementById('logout-form').submit();"
                    class="btn btn-primary btn-block"><b>Déconnexion</b></a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
              </div>
              <!-- /.card-body -->
            </div>
    </div>
  </aside>
