@extends('layouts.master')

@section('title', 'Administrator paneel')

@section('content')

  @include('includes.header')

    <div class="container top">
        <div class="card">
            <div class="col-md-12">
                <h2>Gerapporteerde gebruikers</h2>
                @if (count($reports) < 1)
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
                            @foreach ($reports as $report)
                            <tr>
                                <td class="text-center">{{ $report->id }}</td>
                                <td>{{ $report->reporter->email }}</td>
                                <td>{{ $report->reason }}</td>
                                <td>{{ $report->created_at }}</td>
                                <td>{{ $report->reported->email }}</td>
                                <td class="td-actions text-right">
                                    <a href="{{ url('admin/confirm-report/'.$report->id) }}" danger-action="confirm">
                                    <button type="button" rel="tooltip" title="Gebruiker deactiveren" class="btn btn-danger btn-simple btn-sm">
                                        <i class="material-icons">visibility_off</i>
                                    </button>
                                    </a>
                                    <a href="{{ url('admin/delete-report/'.$report->id) }}" danger-action="delete">
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
    </div>

  @include('includes.footer')

@endsection
