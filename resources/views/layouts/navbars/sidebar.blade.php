<?php
$user = \Illuminate\Support\Facades\Auth::user();
$user->load('organisation', 'organisation.project');
$role = $user->roles[0];
?>

<div class="sidebar" data-background-color="white"
    data-image="{{ asset('material') }}/img/sidebar-1.jpg">

    <div class="logo">
        <a href="#user"><img style="width: 250px;height: 25vh" src="{{ asset('images') }}/rinp_logo.png"></a>
    </div>

    <div class="sidebar-wrapper">
        <div class="card-footer ml-auto mr-auto">
            <button style="width: 200px" type="submit" id="save-role" class="btn btn-primary"><a style="color: white"
                    href="<?= FULL_PATH ?>/home">{{ __('DASHBOARD') }}</a></button>
        </div>
        <ul class="nav">
            @if($user->roles[0]->name == config('constants.ADMINISTRATOR'))
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
                   {{-- <ul class="nav">
                        <li class="nav-item{{ $activePage == 'user-management' ? ' active' : '' }}">
                            <a class="nav-link" href="{{ route('user-role-index') }}">
                                <span class="sidebar-mini"> <i class="material-icons black">person</i> </span>
                                <span class="sidebar-normal"> {{ __('User Roles') }} </span>
                            </a>
                        </li>
                    </ul>--}}
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
                
                <a class="nav-link {{ $activePage == 'user-management' ? ' active' : '' }}"
                    href="{{ route('view-calls') }}">
                    <i class="material-icons black">event_available</i>
                    <p>{{ __('Calls') }}</p>
                </a>
            </li>
            @endif

            @if($user->roles[0]->name == config('constants.UNASSIGNED'))
            <li class="nav-item {{ ($activePage == 'profile' || $activePage == 'user-management') ? ' active' : '' }}">
                <a class="nav-link" data-toggle="collapse" href="#Organisation" aria-expanded="true">
                    <i class="material-icons black">business_center</i>
                    <p>{{ __('Organisation') }}
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse hide" id="Organisation">
                    <ul class="nav">
                        @if($user->organisation->organisation_name == config('constants.NO_ORGANISATION')
                        or
                        $user->organisation->organisation_name == null)
                        <li class="nav-item{{ $activePage == 'user-management' ? ' active' : '' }}">
                            <a class="nav-link" href="{{url('create-organisation')}}">
                                <span class="sidebar-mini"> <i class="material-icons black">business_center</i> </span>
                                <span class="sidebar-normal"> {{ __('Create organisation') }} </span>
                            </a>
                        </li>
                        @elseif($user->is_approved)

                        <li class="nav-item{{ $activePage == 'user-management' ? ' active' : '' }}">
                            <a class="nav-link" href="{{url('/edit-user-organisation/'.$user->id)}}">
                                <span class="sidebar-mini"> <i class="material-icons black">business_center</i> </span>
                                <span class="sidebar-normal"> {{ __('Edit organisation') }} </span>
                            </a>
                        </li>
                        @endif
                    </ul>
                </div>
            </li>
            @endif

            @if($user->roles[0]->name == config('constants.INNOVATOR'))
            <li class="nav-item {{ ($activePage == 'profile' || $activePage == 'user-management') ? ' active' : '' }}">
                <a class="nav-link" data-toggle="collapse" href="#Organisation" aria-expanded="true">
                    <i class="material-icons black">business_center</i>
                    <p>{{ __('Organisation') }}
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse hide" id="Organisation">
                    <ul class="nav">
                        @if($user->organisation->organisation_name == config('constants.NO_ORGANISATION')
                        or
                        $user->organisation->organisation_name == null)
                        <li class="nav-item{{ $activePage == 'user-management' ? ' active' : '' }}">
                            <a class="nav-link" href="{{url('create-organisation')}}">
                                <span class="sidebar-mini"> <i class="material-icons black">business_center</i> </span>
                                <span class="sidebar-normal"> {{ __('Create organisation') }} </span>
                            </a>
                        </li>

                        @elseif($user->is_approved)
                        <li class="nav-item{{ $activePage == 'user-management' ? ' active' : '' }}">
                            <a class="nav-link" href="{{url('/edit-user-organisation/'.$user->id)}}">
                                <span class="sidebar-mini"> <i class="material-icons black">business_center</i> </span>
                                <span class="sidebar-normal"> {{ __('Edit organisation') }} </span>
                            </a>
                        </li>
                        @endif
                    </ul>
                </div>

                @if(!($user->organisation->organisation_name == config('constants.NO_ORGANISATION')
                or
                $user->organisation->organisation_name == null))
                <a class="nav-link" data-toggle="collapse" href="#Project" aria-expanded="true">
                    <i class="material-icons black">event_note</i>
                    <p>{{ __('Project') }}
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse hide" id="Project">
                    <ul class="nav">
                        @if($user->organisation->project == null)
                        <li class="nav-item{{ $activePage == 'user-management' ? ' active' : '' }}">
                            <a class="nav-link" href="{{url('create-project')}}">
                                <span class="sidebar-mini"> <i class="material-icons black">event_note</i> </span>
                                <span class="sidebar-normal"> {{ __('Create project') }} </span>
                            </a>
                        </li>
                        @else
                        <li class="nav-item{{ $activePage == 'user-management' ? ' active' : '' }}">
                            <a class="nav-link" href="{{url('/edit-user-project/'.$user->id)}}">
                                <span class="sidebar-mini"> <i class="material-icons black">event_note</i> </span>
                                <span class="sidebar-normal"> {{ __('Edit project') }} </span>
                            </a>
                        </li>
                        @endif
                    </ul>
                </div>

                <a class="nav-link {{ $activePage == 'user-management' ? ' active' : '' }}"
                    href="{{ route('view-calls') }}">
                    <i class="material-icons black">event_available</i>
                    <p>{{ __('Calls') }} </p>
                </a>
            </li>
            @endif
            @endif

            @if($user->roles[0]->name == config('constants.INCUBATOR'))
            <li class="nav-item {{ ($activePage == 'profile' || $activePage == 'user-management') ? ' active' : '' }}">
                <a class="nav-link" data-toggle="collapse" href="#Organisation" aria-expanded="true">
                    <i class="material-icons black">business_center</i>
                    <p>{{ __('Organisation') }}
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse hide" id="Organisation">
                    <ul class="nav">
                        @if($user->organisation->organisation_name == config('constants.NO_ORGANISATION')
                        or
                        $user->organisation->organisation_name == null)
                        <li class="nav-item{{ $activePage == 'user-management' ? ' active' : '' }}">
                            <a class="nav-link" href="{{url('create-organisation')}}">
                                <span class="sidebar-mini"> <i class="material-icons black">business_center</i> </span>
                                <span class="sidebar-normal"> {{ __('Create organisation') }} </span>
                            </a>
                        </li>
                        @elseif($user->is_approved)
                        <li class="nav-item{{ $activePage == 'user-management' ? ' active' : '' }}">
                            <a class="nav-link" href="{{url('/edit-user-organisation/'.$user->id)}}">
                                <span class="sidebar-mini"> <i class="material-icons black">business_center</i> </span>
                                <span class="sidebar-normal"> {{ __('Edit organisation') }} </span>
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
    <a class="nav-link {{ $activePage == 'user-management' ? ' active' : '' }}" href="{{ route('view-calls') }}">
        <i class="material-icons black">event_available</i>
        <p>{{ __('Calls') }}
        </p>
    </a>
    </li>

    @endif

    @if($user->roles[0]->name == config('constants.FACILITATOR'))
    <li class="nav-item {{ ($activePage == 'profile' || $activePage == 'user-management') ? ' active' : '' }}">
        <a class="nav-link" data-toggle="collapse" href="#Task" aria-expanded="true">
            <i class="material-icons black">person</i>
            <p>{{ __('Resource requests') }}
                <b class="caret"></b>
            </p>
        </a>
        <div class="collapse hide" id="Task">
            <ul class="nav">
                <li class="nav-item{{ $activePage == 'user-management' ? ' active' : '' }}">
                    <a class="nav-link" href="{{ route('task-index') }}">
                        <span class="sidebar-mini"> <i class="material-icons black">person</i> </span>
                        <span class="sidebar-normal"> {{ __('View resource requests') }} </span>
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
                @if($user->organisation->organisation_name == config('constants.NO_ORGANISATION') or
                $user->organisation->organisation_name == null)
                <li class="nav-item{{ $activePage == 'user-management' ? ' active' : '' }}">
                    <a class="nav-link" href="{{url('create-organisation')}}">
                        <span class="sidebar-mini"> <i class="material-icons black">person</i> </span>
                        <span class="sidebar-normal"> {{ __('Create organisation') }} </span>
                    </a>
                </li>

                @elseif($user->is_approved)
                <li class="nav-item{{ $activePage == 'user-management' ? ' active' : '' }}">
                    <a class="nav-link" href="{{url('/edit-user-organisation/'.$user->id)}}">
                        <span class="sidebar-mini"> <i class="material-icons black">person</i> </span>
                        <span class="sidebar-normal"> {{ __('Edit organisation') }} </span>
                    </a>
                </li>
                @endif
            </ul>
        </div>

        <a class="nav-link {{ $activePage == 'user-management' ? ' active' : '' }}" href="{{ route('view-calls') }}">
            <i class="material-icons black">event_available</i>
            <p>{{ __('Calls') }}</p>
        </a>
    </li>
    @endif
    </ul>
</div>
</div>