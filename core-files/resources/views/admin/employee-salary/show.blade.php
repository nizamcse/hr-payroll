@extends(Auth::user()->super_admin ? 'layouts.app' : 'layouts.company')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card my-3">
                <div class="body">
                    <table class="table table-bordered text-center">
                        <thead>
                        <tr>
                            <th colspan="3">
                                <h4>{{ $company->name ?? 'Company Name' }}</h4>
                                <p>{{ $company->address ?? 'Company Address' }}</p>
                                <h5>SALARY DETAILS</h5>
                            </th>
                        </tr>
                        </thead>
                    </table>
                    <div class="row">
                        <div class="col-md-4 col-sm-6 mr-auto">
                            <table class="table slim-table border-0">
                                <tbody>
                                <tr>
                                    <td>ID</td>
                                    <td>{{ $employee['pay_scale'] }}</td>
                                </tr>
                                <tr>
                                    <td>Name</td>
                                    <td>{{ $employee->name }}</td>
                                </tr>
                                <tr>
                                    <td>NameDate Of Joining</td>
                                    <td>{{ $employee->date_of_joining }}</td>
                                </tr>
                                <tr>
                                    <td>Line</td>
                                    <td>{{ $employee->line->name ?? 'N/A' }}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-4 col-sm-6 ml-auto">
                            <table class="table slim-table border-0">
                                <tbody>
                                <tr>
                                    <td>Branch</td>
                                    <td>{{ $employee->branch->name ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <td>Section</td>
                                    <td>{{ $employee->section->name ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <td>Designation</td>
                                    <td>{{ $employee->designation->name ?? 'N/A' }}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <table class="table table-bordered">
                        <tbody>
                        <tr>
                            <td>Basic Salary</td>
                            <td class="text-right">{{ $employee_salary->employee->payScale->basic ?? 0 }}</td>
                        </tr>
                        <tr>
                            <td>House Rent</td>
                            <td class="text-right">{{ $employee_salary->employee->payScale->house_rent ?? 0 }}</td>
                        </tr>
                        <tr>
                            <td>Medical Allowance</td>
                            <td class="text-right">{{ $employee_salary->employee->payScale->medical ?? 0 }}</td>
                        </tr>
                        <tr>
                            <td>Convey</td>
                            <td class="text-right">{{ $employee_salary->employee->payScale->convey ?? 0 }}</td>
                        </tr>
                        <tr>
                            <td>Food</td>
                            <td class="text-right">{{ $employee_salary->employee->payScale->food ?? 0 }}</td>
                        </tr>

                        <tr>
                            <td>Gross Salary</td>
                            <td class="text-right">{{ $employee_salary->employee->payScale->gross_salary ?? 0 }}</td>
                        </tr>
                        @if(count($employee_salary->bonuses))
                            <tr class="bg-light">
                                <td colspan="2">Bonusses</td>
                            </tr>
                            @foreach($employee_salary->bonuses as $bonus)
                                <tr>
                                    <td>{{ $bonus->name }}</td>
                                    <td class="text-right">{{ $bonus->pivot->amount ?? 0 }}</td>
                                </tr>
                            @endforeach
                        @endif

                        @if(count($employee_salary->deductions))
                            <tr class="bg-light">
                                <td colspan="2">Deduction</td>
                            </tr>
                            @foreach($employee_salary->deductions as $deduction)
                                <tr>
                                    <td>{{ $deduction->name }}</td>
                                    <td class="text-right">{{ $deduction->pivot->amount ?? 0 }}</td>
                                </tr>
                            @endforeach
                        @endif
                        <tr>
                            <td>Net Salary</td>
                            <td class="text-right">{{ $employee_salary->net_salary }}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
