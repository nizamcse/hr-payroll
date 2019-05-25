<template>
    <div class="card my-3">
        <div class="header">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group search-form-group">
                        <label>EMPLOYEE NAME/ID</label>
                        <input type="text" v-model="employeeName" :class="employeeId ? 'form-control': 'form-control text-danger'" @keyup="searchEmployee">
                        <ul class="search-result" v-if="employeeResults.length">
                            <li v-for="(searchResult,index) in employeeResults" @click="selectEmployee(searchResult)" v-if="index < 15">{{ searchResult.name }}</li>
                        </ul>
                        <input type="hidden" name="employee_id" v-model="employeeId">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>SELECT MONTH</label>
                        <select name="month" class="form-control" v-model="monthId" required>
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
                        <input type="text" name="year" class="form-control" v-model="year">
                    </div>
                </div>
            </div>
            <div class="form-group text-right-my-3 d-flex">
                <button type="submit" class="btn btn-sm btn-success ml-auto"><i class="fa fa-check-circle"></i> Get Report</button>
            </div>
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
                employee: null,


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


        },
        created: function() {
            this.employees = this.items.employees;
        },
        mounted() {

        },
    };
</script>
