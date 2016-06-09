@extends('layouts.master')

@section('title', 'Administrator paneel')

@section('content')

  @include('includes.header')

    <div class="container top">

        @if (session('notification'))
            <div class="alert alert-info alert-padding">
                <div class="container-fluid">
                    <div class="alert-icon">
                        <i class="material-icons">info_outline</i>
                    </div>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true"><i class="material-icons">clear</i></span>
                    </button>
                    <b>Info:</b> {{ session('notification') }}
                </div>
            </div>
        @endif

        <div class="card">
            <div class="col-md-12">
                <table class="table">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th>Naam</th>
                            <th>Email</th>
                            <th class="text-right">Actie</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($admins as $admin)
                        <tr>
                            <td class="text-center">{{ $admin->id }}</td>
                            <td>{{ $admin->firstname.' '.$admin->lastname }}</td>
                            <td>{{ $admin->email }}</td>
                            <td class="td-actions text-right">
                                <form action="{{ url('admin/'.$admin->id.'/remove') }}" method="POST" danger-action="verwijderen">
                                    <button type="submit" rel="tooltip" title="Administrator verwijderen" class="btn btn-danger btn-simple btn-sm">
                                        <i class="material-icons">clear</i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <p id="updateAdminResult"></p>
                <button class="btn btn-primary btn-raised btn-xs pull-right" data-toggle="modal" data-target="#search_user">Administrator toevoegen</button>
            </div>
        </div>
    </div>

    <div class="container top">
        <div class="card">
            <div class="col-md-12">
                <h2>Gerapporteerde gebruikers</h2>
                @if (count($userReports) < 1)
                    <h4 class="no-result">Geen resultaten gevonden...</h4>
                @else
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th>Naam</th>
                                <th>Reden</th>
                                <th>Datum</th>
                                <th>Door</th>
                                <th class="text-right">Actie</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($userReports as $report)
                            <tr>
                                <td class="text-center">{{ $report->id }}</td>
                                <td>{{ $report->reported->email }}</td>
                                <td>{{ $report->reason }}</td>
                                <td>{{ $report->created_at }}</td>
                                <td>{{ $report->reporter->email }}</td>
                                <td class="td-actions text-right">
                                    <a href="{{ url('admin/user/report/confirm/'.$report->id) }}" danger-action="goedkeuren">
                                    <button type="button" rel="tooltip" title="Gebruiker deactiveren" class="btn btn-danger btn-simple btn-sm">
                                        <i class="material-icons">visibility_off</i>
                                    </button>
                                    </a>
                                    <a href="{{ url('admin/user/report/delete/'.$report->id) }}" danger-action="verwijderen">
                                    <button type="button" rel="tooltip" title="Rapport verwijderen" class="btn btn-danger btn-simple btn-sm">
                                        <i class="material-icons">clear</i>
                                    </button>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>

        <div class="card">
            <div class="col-md-12">
                <h2>Gerapporteerde bedrijven</h2>
                @if (count($companyReports) < 1)
                    <h4 class="no-result">Geen resultaten gevonden...</h4>
                @else
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th>Naam</th>
                                <th>Reden</th>
                                <th>Datum</th>
                                <th>Door</th>
                                <th class="text-right">Actie</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($companyReports as $report)
                            <tr>
                                <td class="text-center">{{ $report->id }}</td>
                                <td>{{ $report->reported->name }}</td>
                                <td>{{ $report->reason }}</td>
                                <td>{{ $report->created_at }}</td>
                                <td>{{ $report->reporter->email }}</td>
                                <td class="td-actions text-right">
                                    <a href="{{ url('admin/company/report/confirm/'.$report->id) }}" danger-action="goedkeuren">
                                    <button type="button" rel="tooltip" title="Bedrijf deactiveren" class="btn btn-danger btn-simple btn-sm">
                                        <i class="material-icons">visibility_off</i>
                                    </button>
                                    </a>
                                    <a href="{{ url('admin/company/report/delete/'.$report->id) }}" danger-action="verwijderen">
                                    <button type="button" rel="tooltip" title="Rapport verwijderen" class="btn btn-danger btn-simple btn-sm">
                                        <i class="material-icons">clear</i>
                                    </button>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>

        <div class="card">
            <div class="col-md-12">
                <h2>Geblokkeerde gebruikers</h2>
                @if (count($blockedUsers) < 1)
                    <h4 class="no-result">Geen resultaten gevonden...</h4>
                @else
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th>Naam</th>
                                <th class="text-right">Actie</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($blockedUsers as $user)
                            <tr>
                                <td class="text-center">{{ $user->id }}</td>
                                <td>{{ $user->email }}</td>
                                <td class="td-actions text-right">
                                    <a href="{{ url('admin/user/activate/'.$user->id) }}">
                                    <button type="button" rel="tooltip" title="Gebruiker activeren" class="btn btn-danger btn-simple btn-sm">
                                        <i class="material-icons">visibility_on</i>
                                    </button>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>

        <div class="card">
            <div class="col-md-12">
                <h2>Geblokkeerde Bedrijven</h2>
                @if (count($blockedCompanies) < 1)
                    <h4 class="no-result">Geen resultaten gevonden...</h4>
                @else
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th>Naam</th>
                                <th class="text-right">Actie</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($blockedCompanies as $company)
                            <tr>
                                <td class="text-center">{{ $company->id }}</td>
                                <td>{{ $company->name }}</td>
                                <td class="td-actions text-right">
                                    <a href="{{ url('admin/company/activate/'.$company->id) }}">
                                    <button type="button" rel="tooltip" title="Bedrijf activeren" class="btn btn-danger btn-simple btn-sm">
                                        <i class="material-icons">visibility_on</i>
                                    </button>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>

    <!-- ADMINISTRATOR TOEVOEGEN -->
    <div class="modal fade" id="search_user" tabindex="-1" role="dialog" aria-labelledby="search_user" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="material-icons">clear</i></button>
                    <h4 class="modal-title">Administrator toevoegen</h4>
                </div>
                <div class="modal-body">
                    <form action="/admin/checkadmin" method="POST">
                        <input type="text" class="form-control" name="user_email" id="userSearch" placeholder="Email" autocomplete="off">

                    <div id="userResult"></div>
                </div>
                <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Annuleren</button>
                        <button type="submit" class="btn btn-info">Toevoegen</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

  @include('includes.footer')

@endsection
