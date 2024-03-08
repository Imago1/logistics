$(document).ready(function() {
    $('#employeesTable').on('click', 'tr', function() {
        var data = $('#employeesTable').DataTable().row(this).data();
        $('#employeeId').val(data[0]);
        $('#office').val(data[1]);
        $('#name').val(data[2]);
        $('#position').val(data[3]);
        $('#email').val(data[4]);
        $('#phone').val(data[5]);
    });

    $('#officesTable').on('click', 'tr', function() {
        var data = $('#officesTable').DataTable().row(this).data();
        $('#officeId').val(data[0]);
        $('#name').val(data[1]);
        $('#address').val(data[2]);
        $('#city').val(data[3]);
        $('#country').val(data[4]);
        $('#phone').val(data[5]);
        $('#email').val(data[6]);

    });
    
    $('#packagesTable').on('click', 'tr', function() {
        var rowData = $('#packagesTable').DataTable().row(this).data();
        console.log(rowData);
        $('#id').val(rowData[0]);
        $('#senderId').val(rowData[1]);
        $('#sender').val(rowData[2]);
        $('#receiver').val(rowData[3]);
        $('#address').val(rowData[4]);
        $('#delivery_type').val(rowData[5]);
        $('#weight').val(rowData[6]);
    });

    $('#usersTable').on('click', 'tr', function() {
        var rowData = $('#usersTable').DataTable().row(this).data();

        $('#userId').val(rowData[0]);
        $('#email').val(rowData[1]);
        $('#role').val(rowData[2]);
    });
    
    

    $('#clear').on('click', function(e) {
        e.preventDefault();
        $('#employeeId').val('');
        $('#name').val('');
        $('#position').val('');
        $('#email').val('');
        $('#phone').val('');

        $('#id').val('');
        $('#sender').val('');
        $('#receiver').val('');
        $('#address').val('');
        $('#delivery_type').val('');
        $('#weight').val('');
    });
});
