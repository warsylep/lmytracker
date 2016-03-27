@extends('layouts.app')

@section('content')
    <!-- Current Measurements -->
    @if (count($measurements) > 0)
        <div class="panel panel-default">
            <div class="panel-heading">
                Measurements
            </div>

            <div class="panel-body">
                <table class="table table-striped measurement-table">
                    <thead>
                        <th class="text-center">Date</th>
                        <th class="text-center">
                            <a href="/chart/weight">Weight (kg)</a>
                        </th>
                        <th class="text-center">
                            <a href="/chart/bodyfat">Body Fat (%)</a>
                        </th>
                        <th class="text-center">
                            <a href="/chart/tbw">Body Water (%)</a>
                        </th>
                        <th class="text-center">
                            <a href="/chart/muscle">Muscle Mass (%)</a>
                        </th>
                        <th class="text-center">
                            <a href="/chart/bone">Bone Mass (grams)</a>
                        </th>
                        @if (Auth::id() == $measurements[0]->user_id)
                        <th class="text-center">&nbsp;</th>
                        <th class="text-center">&nbsp;</th>
                        @endif
                    </thead>

                    <!-- Table Body -->
                    <tbody>
                        @foreach ($measurements as $measurement)
                            <tr>
                                <td class="table-text text-center date" data-date="{{ $measurement->date }}">
                                    {{ $measurement->date }}
                                </td>
                                <td class="table-text text-center weight">
                                    {{ $measurement->weight }}
                                </td>
                                <td class="table-text text-center bodyfat">
                                    {{ $measurement->bodyfat }}
                                </td>
                                <td class="table-text text-center tbw">
                                    {{ $measurement->tbw }}
                                </td>
                                <td class="table-text text-center muscle">
                                    {{ $measurement->muscle }}
                                </td>
                                <td class="table-text text-center bone">
                                    {{ $measurement->bone }}
                                </td>
                                @if (Auth::id() == $measurement->user_id)
                                <td class="text-center">
                                    <a class="btn btn-success btn-xs" href="">
                                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Edit
                                    </a>
                                </td>
                                <td class="text-center">
                                    <form action="/measurement/{{ $measurement->id }}" method="POST">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <button class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Delete</button>
                                    </form>
                                </td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
@endsection

@section('javascript')
<script src="/js/table.js" type="text/javascript"></script>
@endsection