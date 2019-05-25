<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=2.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Salary-dummy</title>
    <style>
        *, ::after, ::before {
            box-sizing: border-box;
        }
        body{
            font-size: 15px;
            position: relative;
        }
        .text-align-center{
            text-align: center;
        }
        .text-align-left{
            text-align: left;
        }
        .text-align-right{
            text-align: right;
        }
        .text-vertical-align-top{
            vertical-align: text-top;
        }
        .text-weight-Bold{
            font-weight: bold;
        }

        .heading {
            font-size: medium;
            font-weight: bold;
        }
        table{
            width:100%;
            border-collapse: collapse;
        }
        .tbl-border-solid,
        .tbl-border-solid th,
        .tbl-border-solid td{
            border: 1px solid #000000;
            font-size: 8px;
        }
        .tbl-head-color{
            background-color: #C0C0C0;
        }
        .-----bottom{
            position: absolute;
            bottom: 0;
        }



    </style>
</head>

<body>
    <table>
        <tbody>
            <tr>
                <td class="text-align-left text-vertical-align-top">
                    <span>
                        Rep. Date- {{ \Carbon\Carbon::today()->format('dS M Y') }}
                    </span>
                </td>
                <td class="text-align-center text-vertical-align-top">
                    <span class="heading">Hong Kong Collection Limited</span><br>
                    <span>Pagar, Tongi, Gazipur</span><br>
                    <span class="heading">Pay Sheet of {{ \Carbon\Carbon::createFromDate($year,$month)->format('M Y') }}</span>
                </td>
                <td class="text-align-right text-vertical-align-top">
                    <span>Page 1</span><br>
                    <span>SEWING LINE-A (WAGES)</span>
                </td>
            </tr>
        </tbody>
    </table>
    <br>
    <table class="tbl-border-solid text-align-center ">
        <thead class="tbl-head-color">
            <tr>
            <td rowspan="2">
                <span>SL No</span>
            </td>
            <td rowspan="2">
                <span>Name of Employee</span>
            </td>
            <td rowspan="2">
                <span>CARD NO.</span>
            </td>
            <td rowspan="2">
                <span>GRADE</span>
            </td>
            <td rowspan="2">
                <span>Designation</span>
            </td>
            <td rowspan="2">
                <span>Joining Date</span>
            </td>
            <td rowspan="2">
                <span>Worked Day</span>
            </td>

            <td colspan="4">
                <span>Leaves & Holidays</span>
            </td>

            <td rowspan="2">
                <span>Basic</span>
            </td>
            <td rowspan="2">
                <span>H/R</span>
            </td>
            <td rowspan="2">
                <span>M/A</span>
            </td>
            <td rowspan="2">
                <span>O/A</span>
            </td>
            <td rowspan="2">
                <span>Total</span>
            </td>
            <td rowspan="2">
                <span>OT Rate</span>
            </td>
            <td rowspan="2">
                <span>OT HOUR</span>
            </td>
            <td rowspan="2">
                <span>OT AMOUNT</span>
            </td>
            <td rowspan="2">
                <span>ATTN. BONUS</span>
            </td>
            <td rowspan="2">
                <span>Absent Deduction</span>
            </td>
            <td rowspan="2">
                <span>STAMP</span>
            </td>
            <td rowspan="2">
                <span>ADV.</span>
            </td>
            <td rowspan="2">
                <span>Net Payable</span>
            </td>
            <td rowspan="2">
                <span>Signature</span>
            </td>
        </tr>
            <tr>
                <td>
                    <span>H</span>
                </td>
                <td>
                    <span>L</span>
                </td>
                <td>
                    <span>W</span>
                </td>
                <td>
                    <span>A</span>
                </td>
            </tr>
        </thead>

        @php
            $sl = 1;
        @endphp
        @foreach($employees->chunk(8) as $employee_salaries)
            <tbody>
            @foreach($employee_salaries as $employee_salary)
                <tr>
                    <td>{{ $sl++ }}</td>
                    <td>{{ $employee_salary->name }}</td>
                    <td>{{ $employee_salary->employee_id }}</td>
                    <td>{{ $employee_salary->payScale ? $employee_salary->payScale->name : 'N/A' }}</td>
                    <td>{{ $employee_salary->designation ? $employee_salary->designation->name : 'N/A' }}</td>
                    <td>{{ $employee_salary->joining_date }}</td>
                    <td>{{ $employee_salary->salaries->first() ? $employee_salary->salaries->first()->total_attend: 0 }}</td>
                    <td>{{ $employee_salary->salaries->first() ? $employee_salary->salaries->first()->holidays: 0 }}</td>
                    <td>{{ $employee_salary->salaries->first() ? $employee_salary->salaries->first()->total_leave: 0 }}</td>
                    <td>{{ $employee_salary->salaries->first() ? $employee_salary->salaries->first()->weekends: 0 }}</td>
                    <td>{{ $employee_salary->salaries->first() ? $employee_salary->salaries->first()->absent: 0 }}</td>
                    <td>{{ $employee_salary->payScale ? $employee_salary->payScale->basic : 'N/A' }}</td>
                    <td>{{ $employee_salary->payScale ? $employee_salary->payScale->house_rent : 'N/A' }}</td>
                    <td>{{ $employee_salary->payScale ? $employee_salary->payScale->medical : 'N/A' }}</td>
                    <td>{{ $employee_salary->payScale ? $employee_salary->payScale->convey : 'N/A' }}</td>
                    <td>{{ $employee_salary->payScale ? $employee_salary->payScale->gross_salary : 'N/A' }}</td>
                    <td>{{ $employee_salary->payScale ? $employee_salary->payScale->ot_salary_per_hour : 'N/A' }}</td>
                    <td>{{ $employee_salary->salaries->first() ? $employee_salary->salaries->first()->total_ot: 0 }}</td>
                    <td>{{ $employee_salary->salaries->first() ? $employee_salary->salaries->first()->total_ot_amount: 0 }}</td>
                    <td>{{ $employee_salary->salaries->first() ? $employee_salary->salaries->first()->bonuses_amount: 0 }}</td>
                    <td>{{ $employee_salary->salaries->first() ? $employee_salary->salaries->first()->deductions_amount: 0 }}</td>
                    <td>10</td>
                    <td></td>
                    <td>{{ $employee_salary->salaries->first() ? $employee_salary->salaries->first()->net_salary: 0 }}</td>
                    <td></td>
                </tr>
            @endforeach
            </tbody>
        @endforeach
        <tbody>

            <tr>
                <td colspan="6">
                    <span class="text-weight-Bold">PAGE TOTAL= </span>
                </td>
                <td>24</td>
                <td>6</td>
                <td>0</td>
                <td>0</td>
                <td>11110</td>
                <td>4100</td>
                <td>2050</td>
                <td>600</td>
                <td>1250</td>
                <td>8000</td>
                <td>39.432</td>
                <td>44</td>
                <td>1732.62</td>
                <td>0</td>
                <td>132</td>
                <td>10</td>
                <td>0</td>
                <td>9592.4</td>
                <td></td>
            </tr>
            <tr>
                <td colspan="6">
                    <span class="text-weight-Bold">GRAND TOTAL= </span>
                </td>
                <td>24</td>
                <td>6</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>4100</td>
                <td>2050</td>
                <td>600</td>
                <td>1250</td>
                <td>8000</td>
                <td>39.432</td>
                <td>44</td>
                <td>1732.62</td>
                <td>0</td>
                <td>132</td>
                <td>10</td>
                <td>0</td>
                <td>9592.4</td>
                <td></td>
            </tr>
            </tr>

        </tbody>
    </table>
    <table class="bottom text-align-center text-weight-Bold">
        <tbody>
            <td>
                <span>PREPARED BY</span>
            </td>
            <td>
                <span>CHECKED BY</span>
            </td>
            <td>
                <span>H.R. ADMIN</span>
            </td>
            <td>
                <span>ACCOUNTS</span>
            </td>
            <td>
                <span>DIRECTOR</span>
            </td>
            <td>
                <span>MD</span>
            </td>
            <td>
                <span>CHAIRMAN</span>
            </td>
        </tbody>
    </table>



</body>
</html>