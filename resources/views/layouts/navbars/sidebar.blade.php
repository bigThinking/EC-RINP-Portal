<?php
$user = \Illuminate\Support\Facades\Auth::user();
$user->load('organisation');
$role = $user->roles[0];

$user->load('organisation');

?>

<div class="sidebar" data-color="orange" data-background-color="white"
     data-image="public/material/img/sidebar-1.jpg">
    <!--
        Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

        Tip 2: you can also add an image using data-image tag
    -->
    <div class="logo">
        <a href="#user"><img  style="width: 250px;height: 25vh" src="https://innovateec.co.za/portal/public/images/rinp%20logo.png"></a>
    </div>

    <div class="sidebar-wrapper">
        <div class="card-footer ml-auto mr-auto">
            <button style="width: 200px" type="submit" id="save-role" class="btn btn-primary"><a style="color: white" href="<?= FULL_PATH ?>/home">{{ __('DASHBOARD') }}</a></button>
        </div>
        <ul class="nav">
            @if($user->roles[0]->name == 'administrator')
                <li class="nav-item {{ ($activePage == 'profile' || $activePage == 'user-management') ? ' active' : '' }}">
                    <a class="nav-link" data-toggle="collapse" href="#User" aria-expanded="true">
                        <i class="material-icons black">person</i>
                        <p>{{ __('User Management') }}
                            <b class="caret"></b>
                        </p>
                    </a>
                    <div class="collapse hide" id="User">
                        <ul class="nav">
                            <li class="nav-item{{ $activePage == 'user-management' ? ' active' : '' }}">
                                <a class="nav-link" href="{{route('user-index')}}">
                                    <span class="sidebar-mini"> <i class="material-icons black">person</i> </span>
                                    <span class="sidebar-normal"> {{ __('Users') }} </span>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav">
                            <li class="nav-item{{ $activePage == 'user-management' ? ' active' : '' }}">
                                <a class="nav-link" href="{{ route('user-role-index') }}">
                                    <span class="sidebar-mini"> <i class="material-icons black">person</i> </span>
                                    <span class="sidebar-normal"> {{ __('User Roles') }} </span>
                                </a>
                            </li>
                        </ul>
                    </div>

                    <a class="nav-link" data-toggle="collapse" href="#Organisation" aria-expanded="true">
                        <i class="material-icons black">business_center</i>
                        <p>{{ __('Organisation') }}
                            <b class="caret"></b>
                        </p>
                    </a>
                    <div class="collapse hide" id="Organisation">
                        <ul class="nav">
                            <li class="nav-item{{ $activePage == 'user-management' ? ' active' : '' }}">
                                <a class="nav-link" href="{{ route('organisation-index') }}">
                                    <span class="sidebar-mini"> <i class="material-icons black">business_center</i> </span>
                                    <span class="sidebar-normal"> {{ __('Organisations') }} </span>
                                </a>
                            </li>
                        </ul>
                    </div>

                    <a class="nav-link" data-toggle="collapse" href="#Project" aria-expanded="true">
                        <i class="material-icons black">event_note</i>
                        <p>{{ __('Projects') }}
                            <b class="caret"></b>
                        </p>
                    </a>
                    <div class="collapse hide" id="Project">
                        <ul class="nav">
                            <li class="nav-item{{ $activePage == 'user-management' ? ' active' : '' }}">
                                <a class="nav-link" href="{{ route('project-index') }}">
                                    <span class="sidebar-mini"> <i class="material-icons black">event_note</i> </span>
                                    <span class="sidebar-normal"> {{ __('Projects') }} </span>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav">
                            <li class="nav-item{{ $activePage == 'user-management' ? ' active' : '' }}">
                                <a class="nav-link" href="{{ route('project-stage-index') }}">
                                    <span class="sidebar-mini"> <i class="material-icons black">reorder</i> </span>
                                    <span class="sidebar-normal"> {{ __('Stages') }} </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <a class="nav-link" data-toggle="collapse" href="#Events" aria-expanded="true">
                        <i class="material-icons black">event_available</i>
                        <p>{{ __('Events') }}
                            <b class="caret"></b>
                        </p>
                    </a>
                    <div class="collapse hide" id="Events">
                        <ul class="nav">
                            <li class="nav-item{{ $activePage == 'user-management' ? ' active' : '' }}">
                                <a class="nav-link" href="{{ route('get-events') }}">
                                    <span class="sidebar-mini"> <i class="material-icons black">event_available</i> </span>
                                    <span class="sidebar-normal"> {{ __('Events') }} </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            @endif
            @if($user->roles[0]->name == 'not assigned')
                    <li class="nav-item {{ ($activePage == 'profile' || $activePage == 'user-management') ? ' active' : '' }}">
                        <a class="nav-link" data-toggle="collapse" href="#Organisation" aria-expanded="true">
                            <i class="material-icons black">business_center</i>
                            <p>{{ __('Organisation') }}
                                <b class="caret"></b>
                            </p>
                        </a>
                        <div class="collapse hide" id="Organisation">
                            <ul class="nav">
                                @if($user->organisation->organisation_name == 'Other (if your organisation is not on the list)' or
                                      $user->organisation->organisation_name == null)
                                <li class="nav-item{{ $activePage == 'user-management' ? ' active' : '' }}">
                                    <a class="nav-link" href="{{url('create-organisation')}}">
                                        <span class="sidebar-mini"> <i class="material-icons black">business_center</i> </span>
                                        <span class="sidebar-normal"> {{ __('Create organisations') }} </span>
                                    </a>
                                </li>
                                @else

                                    <li class="nav-item{{ $activePage == 'user-management' ? ' active' : '' }}">
                                        <a class="nav-link"  href="{{url('/edit-user-organisation/'.$user->id)}}">
                                            <span class="sidebar-mini"> <i class="material-icons black">business_center</i> </span>
                                            <span class="sidebar-normal"> {{ __('Edit organisations') }} </span>
                                        </a>
                                    </li>
                                    @endif
                            </ul>
                        </div>
                    </li>
                @endif

            @if($user->roles[0]->name == 'innovator')
                    <li class="nav-item {{ ($activePage == 'profile' || $activePage == 'user-management') ? ' active' : '' }}">
                        <a class="nav-link" data-toggle="collapse" href="#Organisation" aria-expanded="true">
                            <i class="material-icons black">business_center</i>
                            <p>{{ __('Organisation') }}
                                <b class="caret"></b>
                            </p>
                        </a>
                        <div class="collapse hide" id="Organisation">
                            <ul class="nav">
                                @if($user->organisation->organisation_name == 'Other (if your organisation is not on the list)' or
                                       $user->organisation->organisation_name == null)
                                <li class="nav-item{{ $activePage == 'user-management' ? ' active' : '' }}">
                                    <a class="nav-link" href="{{url('create-organisation')}}">
                                        <span class="sidebar-mini"> <i class="material-icons black">business_center</i> </span>
                                        <span class="sidebar-normal"> {{ __('Create organisations') }} </span>
                                    </a>
                                </li>

                                @else
                                <li class="nav-item{{ $activePage == 'user-management' ? ' active' : '' }}">
                                    <a class="nav-link"  href="{{url('/edit-user-organisation/'.$user->id)}}">
                                        <span class="sidebar-mini"> <i class="material-icons black">business_center</i> </span>
                                        <span class="sidebar-normal"> {{ __('Edit organisations') }} </span>
                                    </a>
                                </li>
                                    @endif
                            </ul>
                        </div>

                        <a class="nav-link" data-toggle="collapse" href="#Project" aria-expanded="true">
                            <i class="material-icons black">event_note</i>
                            <p>{{ __('Project') }}
                                <b class="caret"></b>
                            </p>
                        </a>
                        <div class="collapse hide" id="Project">
                            <ul class="nav">
                                @if($user->project_id == null)
                                <li class="nav-item{{ $activePage == 'user-management' ? ' active' : '' }}">
                                    <a class="nav-link" href="{{url('create-project')}}">
                                        <span class="sidebar-mini"> <i class="material-icons black">event_note</i> </span>
                                        <span class="sidebar-normal"> {{ __('Create project') }} </span>
                                    </a>
                                </li>
                                @else
                                <li class="nav-item{{ $activePage == 'user-management' ? ' active' : '' }}">
                                    <a class="nav-link"  href="{{url('/edit-user-project/'.$user->id)}}">
                                        <span class="sidebar-mini"> <i class="material-icons black">event_note</i> </span>
                                        <span class="sidebar-normal"> {{ __('Edit project') }} </span>
                                    </a>
                                </li>
                                    @endif
                            </ul>
                        </div>
                    </li>
                @endif
                @if($user->roles[0]->name == 'Incubator staff')
                    <li class="nav-item {{ ($activePage == 'profile' || $activePage == 'user-management') ? ' active' : '' }}">
                        <a class="nav-link" data-toggle="collapse" href="#Organisation" aria-expanded="true">
                            <i class="material-icons black">business_center</i>
                            <p>{{ __('Organisation') }}
                                <b class="caret"></b>
                            </p>
                        </a>
                        <div class="collapse hide" id="Organisation">
                            <ul class="nav">
                                @if($user->organisation->organisation_name == 'Other (if your organisation is not on the list)' or
                                      $user->organisation->organisation_name == null)
                                    <li class="nav-item{{ $activePage == 'user-management' ? ' active' : '' }}">
                                        <a class="nav-link" href="{{url('create-organisation')}}">
                                            <span class="sidebar-mini"> <i class="material-icons black">business_center</i> </span>
                                            <span class="sidebar-normal"> {{ __('Create organisations') }} </span>
                                        </a>
                                    </li>
                                @else
                                <li class="nav-item{{ $activePage == 'user-management' ? ' active' : '' }}">
                                    <a class="nav-link"  href="{{url('/edit-user-organisation/'.$user->id)}}">
                                        <span class="sidebar-mini"> <i class="material-icons black">business_center</i> </span>
                                        <span class="sidebar-normal"> {{ __('Edit organisations') }} </span>
                                    </a>
                                </li>
                                    @endif
                            </ul>
                        </div>
                    </li>

                    <li class="nav-item {{ ($activePage == 'profile' || $activePage == 'user-management') ? ' active' : '' }}">
                        <a class="nav-link" data-toggle="collapse" href="#Project" aria-expanded="true">
                            <i class="material-icons black">event_note</i>
                            <p>{{ __('Projects') }}
                                <b class="caret"></b>
                            </p>
                        </a>
                        <div class="collapse hide" id="Project">
                            <ul class="nav">
                                <li class="nav-item{{ $activePage == 'user-management' ? ' active' : '' }}">
                                    <a class="nav-link" href="{{ route('project-index') }}">
                                        <span class="sidebar-mini"> <i class="material-icons black">event_note</i> </span>
                                        <span class="sidebar-normal"> {{ __('Projects') }} </span>
                                    </a>
                                </li>
                            </ul>
                           {{-- <ul class="nav">
                                <li class="nav-item{{ $activePage == 'user-management' ? ' active' : '' }}">
                                    <a class="nav-link" href="{{ route('project-stage-index') }}">
                                        <span class="sidebar-mini"> <i class="material-icons black">reorder</i> </span>
                                        <span class="sidebar-normal"> {{ __('Stages') }} </span>
                                    </a>
                                </li>
                            </ul>--}}
                        </div>
                    </li>

                @endif
                @if($user->roles[0]->name == 'Facilitator')
                    <li class="nav-item {{ ($activePage == 'profile' || $activePage == 'user-management') ? ' active' : '' }}">
                        <a class="nav-link" data-toggle="collapse" href="#Task" aria-expanded="true">
                            <i class="material-icons black">person</i>
                            <p>{{ __('Tasks') }}
                                <b class="caret"></b>
                            </p>
                        </a>
                        <div class="collapse hide" id="Task">
                            <ul class="nav">
                                <li class="nav-item{{ $activePage == 'user-management' ? ' active' : '' }}">
                                    <a class="nav-link" href="{{ route('task-index') }}">
                                        <span class="sidebar-mini"> <i class="material-icons black">person</i> </span>
                                        <span class="sidebar-normal"> {{ __('View referred task') }} </span>
                                    </a>
                                </li>
                            </ul>
                        </div>

                        <a class="nav-link" data-toggle="collapse" href="#Organisation" aria-expanded="true">
                            <i class="material-icons black">person</i>
                            <p>{{ __('Organisation') }}
                                <b class="caret"></b>
                            </p>
                        </a>
                        <div class="collapse hide" id="Organisation">
                            <ul class="nav">
                                @if($user->organisation->organisation_name == 'Other (if your organisation is not on the list)' or
                                       $user->organisation->organisation_name == null)
                                <li class="nav-item{{ $activePage == 'user-management' ? ' active' : '' }}">
                                    <a class="nav-link" href="{{url('create-organisation')}}">
                                        <span class="sidebar-mini"> <i class="material-icons black">person</i> </span>
                                        <span class="sidebar-normal"> {{ __('Create organisations') }} </span>
                                    </a>
                                </li>

                                @else
                                <li class="nav-item{{ $activePage == 'user-management' ? ' active' : '' }}">
                                    <a class="nav-link"  href="{{url('/edit-user-organisation/'.$user->id)}}">
                                        <span class="sidebar-mini"> <i class="material-icons black">person</i> </span>
                                        <span class="sidebar-normal"> {{ __('Edit organisations') }} </span>
                                    </a>
                                </li>
                                    @endif
                            </ul>
                        </div>
                    </li>

                @endif
        </ul>
    </div>
</div>

<style>
    body{
        background-color: white;
    }
    .card .card-header-primary .card-icon, .card .card-header-primary .card-text, .card .card-header-primary:not(.card-header-icon):not(.card-header-text), .card.bg-primary, .card.card-rotate.bg-primary .front, .card.card-rotate.bg-primary .back {
        background: linear-gradient(60deg, #1E73BE, #1E73BE);
    }
    .btn.btn-primary {
        background-color: #1E73BE;
    }
    .text-primary {
        color: #1E73BE !important;
    }
    .btn.btn-primary:hover {
        background-color: #1E73BE;
    }

</style>
