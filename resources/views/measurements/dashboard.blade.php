@extends('layouts.app')

@section('content')
    <!-- Current Measurements -->
    @if (count($measurements) > 0)
        <div class="panel panel-default">
            <div class="panel-heading">
                Current Measurements
            </div>

            <div class="panel-body">
                <table class="table table-striped measurement-table">

                    <!-- Table Headings -->
                    <thead>
                        <th class="text-center">Date</th>
                        <th class="text-center">Weight (kg)</th>
                        <th class="text-center">Body Fat (%)</th>
                        <th class="text-center">Body Water (%)</th>
                        <th class="text-center">Muscle Mass (%)</th>
                        <th class="text-center">Bone Mass (grams)</th>
                        @if (Auth::id() == $measurements[0]->user_id)
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
                                    <!--<a class="btn btn-success btn-xs" href="">
                                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Edit
                                    </a>-->
                                    <form action="/measurement/{{ $measurement->id }}" method="POST">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <button type="button" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Delete</button>
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