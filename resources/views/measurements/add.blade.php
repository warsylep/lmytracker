@extends('layouts.app')

@section('content')

    <div class="panel-body">
        <!-- Display Validation Errors -->
        @include('common.errors')

        <!-- New Measurement Form -->
        <form action="/measurement" method="POST" class="form-horizontal">
            {{ csrf_field() }}

            <div class="form-group">
                <label for="date" class="col-sm-3 control-label">Date</label>
                <div class="col-sm-6">
                    <div class="input-group date" id="date">
                        <input type="text" name="date" value="{{ old('date') }}" class="form-control" />
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="weight" class="col-sm-3 control-label">Weight</label>
                <div class="col-sm-6">
                    <input type="number" value="{{ old('weight') }}" pattern="[0-9]+([\.,][0-9])?" step="0.1" name="weight" id="measurement-weight" class="form-control">
                </div>
            </div>

            <div class="form-group">
                <label for="bodyfat" class="col-sm-3 control-label">Body Fat</label>
                <div class="col-sm-6">
                    <input type="number" value="{{ old('bodyfat') }}" pattern="[0-9]+([\.,][0-9])?" step="0.1" name="bodyfat" id="measurement-bodyfat" class="form-control">
                </div>
            </div>

            <div class="form-group">
                <label for="tbw" class="col-sm-3 control-label">Body Water</label>
                <div class="col-sm-6">
                    <input type="number" value="{{ old('tbw') }}" pattern="[0-9]+([\.,][0-9])?" step="0.1" name="tbw" id="measurement-tbw" class="form-control">
                </div>
            </div>

            <div class="form-group">
                <label for="muscle" class="col-sm-3 control-label">Muscle Mass</label>
                <div class="col-sm-6">
                    <input type="number" value="{{ old('muscle') }}" pattern="[0-9]+([\.,][0-9])?" step="0.1" name="muscle" id="measurement-muscle" class="form-control">
                </div>
            </div>

            <div class="form-group">
                <label for="bone" class="col-sm-3 control-label">Bone Mass</label>
                <div class="col-sm-6">
                    <input type="number" value="{{ old('bone') }}" pattern="[0-9]+([\.,][0-9])?" step="0.1" name="bone" id="measurement-bone" class="form-control">
                </div>                
            </div>

            <!-- Add Measurement Button -->
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" class="btn btn-default">
                        <i class="fa fa-plus"></i> Add Measurement
                    </button>
                </div>
            </div>
        </form>
    </div>

<script type="text/javascript">
    $(function () {
        $('#date').datetimepicker({
            format: 'YYYY-M-D'
        });
    });
</script>

@endsection