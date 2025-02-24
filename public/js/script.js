document.addEventListener('DOMContentLoaded', function() {
    const updateButtons = document.querySelectorAll('.updateStudentBtn');
    const deleteForms = document.querySelectorAll('form[action*="std.delete"]');

    updateButtons.forEach(button => {
        button.addEventListener('click', () => {
            document.querySelector('#updateStudentForm input[name="name"]').value = button.getAttribute('data-name');
            document.querySelector('#updateStudentForm input[name="age"]').value = button.getAttribute('data-age');
            document.querySelector('#updateStudentForm input[name="gender"]').value = button.getAttribute('data-gender');
            document.querySelector('#updateStudentForm input[name="address"]').value = button.getAttribute('data-address');
            document.querySelector('#updateStudentForm').action = `/update-students/${button.getAttribute('data-id')}`;
        });
    });

    deleteForms.forEach(form =>{
        form.addEventListener('submit', (e) => {
            e.preventDefault();
            let confirmation = confirm('Are you sure you want to delete this student?');
            if(confirmation){
                this.submit();
            }
        });
    })
});
