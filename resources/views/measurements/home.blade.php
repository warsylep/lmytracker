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
                        <th>Date</th>
                        <th>Weight</th>
                        <th>Body Fat</th>
                        <th>Body Water</th>
                        <th>Muscle Mass</th>
                        <th>Bone Mass</th>
                        @if (Auth::id() == $measurements[0]->user_id)
                        <th>&nbsp;</th>
                        @endif
                    </thead>

                    <!-- Table Body -->
                    <tbody>
                        @foreach ($measurements as $measurement)
                            <tr>
                                <td class="table-text">
                                    <div>{{ $measurement->date }}</div>
                                </td>

                                <td class="table-text">
                                    <div>{{ $measurement->weight }}</div>
                                </td>

                                <td class="table-text">
                                    <div>{{ $measurement->bodyfat }}</div>
                                </td>

                                <td class="table-text">
                                    <div>{{ $measurement->tbw }}</div>
                                </td>

                                <td class="table-text">
                                    <div>{{ $measurement->muscle }}</div>
                                </td>

                                <td class="table-text">
                                    <div>{{ $measurement->bone }}</div>
                                </td>

                                @if (Auth::id() == $measurement->user_id)
                                <td>
                                    <form action="/measurement/{{ $measurement->id }}" method="POST">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <button>Delete Measurement</button>
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