@extends('layouts.master')

@section('title', 'Administrator paneel')

@section('content')

  @include('includes.header')

    <div class="container">
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
            <tr>
                <td class="text-center">1</td>
                <td>Jordy Pisser</td>
                <td>Machtsmisbruik</td>
                <td>27-05-2016 21:17:26</td>
                <td>Jari Verhaard</td>
                <td class="td-actions text-right">
                    <button type="button" rel="tooltip" title="Rapport verwijderen" class="btn btn-success btn-simple btn-sm">
                        <i class="material-icons">check_circle</i>
                    </button>
                    <button type="button" rel="tooltip" title="Gebruiker deactiveren" class="btn btn-danger btn-simple btn-sm">
                        <i class="fa fa-times"></i>
                    </button>
                </td>
            </tr>
        </tbody>
      </table>
    </div>

  @include('includes.footer')

@endsection
