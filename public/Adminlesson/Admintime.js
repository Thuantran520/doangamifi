document.getElementById('lesson-form').addEventListener('submit', function(e) {
    var now = new Date();
    var formatted = now.getFullYear() + '-' +
        ('0' + (now.getMonth()+1)).slice(-2) + '-' +
        ('0' + now.getDate()).slice(-2);

    // Nếu có input updated_date thì gán giá trị
    var updatedInput = document.getElementById('updated_date');
    if (updatedInput) {
        updatedInput.value = formatted;
    }

    // Nếu có input created_at thì gán giá trị
    var createdInput = document.getElementById('created_at');
    if (createdInput) {
        createdInput.value = formatted;
    }
});

