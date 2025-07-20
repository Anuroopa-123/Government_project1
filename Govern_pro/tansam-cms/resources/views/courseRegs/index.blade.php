@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="mb-3">Course Registrations</h1>
    <table
        class="table table-striped"
        data-toggle="table"
        data-filter-control="true"
        data-pagination="true"
        data-page-size="10"
        data-sort-reset="true"
    >
        <thead>
            <tr>
                <th data-field="id" data-sortable="true" data-filter-control="input" data-filter-control-placeholder="Enter ID">ID</th>
                <th data-field="course" data-sortable="true" data-filter-control="select" data-filter-control-placeholder="Select Course">Course</th>
                <th data-field="name" data-sortable="true" data-filter-control="input" data-filter-control-placeholder="Enter Name">Name</th>
                <th data-field="dob" data-sortable="true" data-filter-control="input" data-filter-control-placeholder="YYYY-MM-DD">DOB</th>
                <th data-field="mobile_number" data-sortable="true" data-filter-control="input" data-filter-control-placeholder="Mobile Number">Mobile Number</th>
                <th data-field="email" data-sortable="false">Email</th>
                <th data-field="addr_line_one" data-sortable="false">Address Line One</th>
                <th data-field="addr_line_two" data-sortable="false">Address Line Two</th>
                <th data-field="city" data-sortable="true" data-filter-control="select" data-filter-control-placeholder="Select City">City</th>
                <th data-field="state" data-sortable="true" data-filter-control="select" data-filter-control-placeholder="Select State">State</th>
                <th data-field="zip_code" data-sortable="true" data-filter-control="select" data-filter-control-placeholder="Select ZIP">Zip Code</th>
                <th data-field="college_organization" data-sortable="false">College/Organization</th>
                <th data-field="department_domain" data-sortable="false" data-filter-control="select" data-filter-control-placeholder="Select Department/Domain">Department/Domain</th>
                <th data-field="year_experience" data-sortable="true" data-filter-control="select" data-filter-control-placeholder="Select Year/Experience">Year/Experience</th>
            </tr>
        </thead>
        <tbody>
            @foreach($courseRegs as $courseReg)
                <tr>
                    <td>{{ $courseReg->id }}</td>
                    <td>{{ $courseReg->course }}</td>
                    <td>{{ $courseReg->name }}</td>
                    <td>{{ $courseReg->dob }}</td>
                    <td>{{ $courseReg->mobile_number }}</td>
                    <td>{{ $courseReg->email }}</td>
                    <td>{{ $courseReg->address_line_one }}</td>
                    <td>{{ $courseReg->address_line_two }}</td>
                    <td>{{ $courseReg->city }}</td>
                    <td>{{ $courseReg->state }}</td>
                    <td>{{ $courseReg->zip_code }}</td>
                    <td>{{ $courseReg->college_organization }}</td>
                    <td>{{ $courseReg->department_domain }}</td>
                    <td>{{ $courseReg->year_experience }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

@section('styles')
<style>
    th .filter-control, 
    td .filter-control {
        min-width: 180px !important;
        width: 100% !important;
        padding-left: 10px;
        padding-right: 10px;
        box-sizing: border-box;
    }
    th {
        text-align: center !important;
    }
</style>
@endsection