<template>
    <div class="card my-3">
        <div class="header">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group search-form-group">
                        <label>EMPLOYEE NAME/ID</label>
                        <input type="text" v-model="employeeName" :class="employeeId ? 'form-control': 'form-control text-danger'" @keyup="searchEmployee" required>
                        <ul class="search-result" v-if="employeeResults.length">
                            <li v-for="(searchResult,index) in employeeResults" @click="selectEmployee(searchResult)" v-if="index < 15">{{ searchResult.name }}</li>
                        </ul>
                        <input type="hidden" name="employee_id" v-model="employeeId">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>SELECT MONTH</label>
                        <select name="month" class="form-control" v-model="monthId" v-on:change="getDetails" required>
                            <option value="">-- Select Month --</option>
                            <option value="01">January</option>
                            <option value="02">February</option>
                            <option value="03">March</option>
                            <option value="04">April</option>
                            <option value="05">May</option>
                            <option value="06">June</option>
                            <option value="07">July</option>
                            <option value="08">August</option>
                            <option value="09">September</option>
                            <option value="10">October</option>
                            <option value="11">November</option>
                            <option value="12">December</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>YEAR</label>
                        <input type="text" name="year" class="form-control" v-on:keyup="getDetails" v-model="year">
                    </div>
                </div>
            </div>
        </div>
        <div class="body">
            <table class="table table-bordered" v-if="attendanceData.length">
                <thead>
                    <tr>
                        <th>SL</th>
                        <th>EMP ID</th>
                        <th>Date</th>
                        <th>In Time</th>
                        <th>Exit Time</th>
                        <th>Total Hour</th>
                        <th>OT Hour</th>
                        <th>OT Salary</th>
                        <th>In Status</th>
                        <th>Out Status</th>
                    </tr>
                </thead>
                <tbody>
                <tr v-for="(attendance,index) in attendanceData">
                    <td> {{ index+1 }} </td>
                    <td> {{ attendance.device_employee_id }} </td>
                    <td> {{ attendance.attendance_date }} </td>
                    <td> {{ attendance.in_time }} </td>
                    <td> {{ attendance.exit_time }} </td>
                    <td> {{ attendance.measurement_quantity }} </td>
                    <td> {{ attendance.overtime }} </td>
                    <td> {{ attendance.overtime_wage }} </td>
                    <td> {{ attendance.in_status }} </td>
                    <td> {{ attendance.out_status }} </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>

    export default {
        props: ['items'],

        data: function() {

            return {
                employees: [],
                employeeId: null,
                employeeResults: [],
                employeeName: "",
                monthId: "",
                year: new Date().getFullYear(),
                employee: null,
                apiUrl: null,
                employee: null,
                attendanceData: [],


            };
        },
        computed: {

        },

        methods: {
            searchEmployee(){
                this.employeeResults = [];
                this.employeeId = null;

                if(this.employeeName.length){
                    this.employeeResults = this.employees.filter((item) => {
                        return item.name.toUpperCase().search(this.employeeName.toUpperCase()) != -1 || item.id ==this.employeeName;
                    });
                }

            },
            selectEmployee(item){
                this.employeeId = item.id;
                this.employeeName = item.name;
                this.employeeResults = [];
                this.employee = item;
                this.getDetails();
            },

            getDetails: function(){
                var app =this;
                this.salaryDetails = null;
                if(this.year && this.monthId){
                    let data = {
                        employee_id : this.employeeId,
                        year: this.year,
                        month: this.monthId
                    };
                    console.log(data);
                    axios.post(app.apiUrl ,data)
                        .then(result => {
                            app.employee = result.data.employee;
                            app.attendanceData = result.data.attendanceData;
                        })
                        .catch(e => {
                            console.log(e);
                        });
                }
            },

        },
        created: function() {
            this.employees = this.items.employees;
            this.apiUrl = this.items.apiUrl;
            console.log(this.items);
        },
        mounted() {

        },
    };
</script>
