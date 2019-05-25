@extends(Auth::user()->super_admin ? 'layouts.app' : 'layouts.company')

@section('content')
    @include('partials.header',['title' => 'Basic Settings'])
    <div class="row clearfix">
        <div class="col-lg-12">
            <div class="card">
                <div class="body">
                    <form action="{{ route('basic-settings') }}" method="post">
                        @csrf
                        <div class="row m-0">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>In Time</label>
                                    <date-time :inputs="{format: 'HH:mm',name: 'in_time',time: '{{ $basic_settings ? $basic_settings->in_time : '' }}' }"></date-time>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Exit Time</label>
                                    <date-time :inputs="{format: 'HH:mm',name: 'exit_time',time: '{{ $basic_settings ? $basic_settings->exit_time : '' }}' }"></date-time>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <p><strong>Weekends</strong></p>
                                <div class="row m-0 d-flex">
                                    <div>
                                        <div class="form-group">
                                            <label class="fancy-checkbox">
                                                <input type="checkbox" name="weekends[]" value="6" {{ $basic_settings ? $basic_settings->weekends ? in_array(6,$basic_settings->weekends) ? 'checked' : '' : '' : '' }}>
                                                <span>Saturday</span>
                                            </label>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="form-group">
                                            <label class="fancy-checkbox">
                                                <input type="checkbox" name="weekends[]" value="0" {{ $basic_settings ? $basic_settings->weekends ? in_array(0,$basic_settings->weekends) ? 'checked' : '' : '' : '' }}>
                                                <span>Sunday</span>
                                            </label>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="form-group">
                                            <label class="fancy-checkbox">
                                                <input type="checkbox" name="weekends[]" value="1" {{ $basic_settings ? $basic_settings->weekends ? in_array(1,$basic_settings->weekends) ? 'checked' : '' : '' : '' }}>
                                                <span>Monday</span>
                                            </label>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="form-group">
                                            <label class="fancy-checkbox">
                                                <input type="checkbox" name="weekends[]" value="2" {{ $basic_settings ? $basic_settings->weekends ? in_array(2,$basic_settings->weekends) ? 'checked' : '' : '' : '' }}>
                                                <span>Tuesday</span>
                                            </label>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="form-group">
                                            <label class="fancy-checkbox">
                                                <input type="checkbox" name="weekends[]" value="3" {{ $basic_settings ? $basic_settings->weekends ? in_array(3,$basic_settings->weekends) ? 'checked' : '' : '' : '' }}>
                                                <span>Wednesday</span>
                                            </label>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="form-group">
                                            <label class="fancy-checkbox">
                                                <input type="checkbox" name="weekends[]" value="4" {{ $basic_settings ? $basic_settings->weekends ? in_array(4,$basic_settings->weekends) ? 'checked' : '' : '' : '' }}>
                                                <span>Thursday</span>
                                            </label>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="form-group">
                                            <label class="fancy-checkbox">
                                                <input type="checkbox" name="weekends[]" value="5" {{ $basic_settings ? $basic_settings->weekends ? in_array(5,$basic_settings->weekends) ? 'checked' : '' : '' : '' }}>
                                                <span>Friday</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group text-right">
                            <button type="submit" class="btn btn-sm btn-info">UPDATE SETTINGS</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('script')
    <script src="{{ asset('core-files/public/js/app.js') }}"></script>
    <script>
        $(document).ready(function(){

        });
    </script>
@endsection