var checkboxes = document.querySelectorAll('input[name=gender]');
checkboxes.forEach(function(checkbox) {

    checkbox.addEventListener('click', function() {

        checkboxes.forEach(function(c) {

            if (c !== checkbox) 
            {
                c.checked = false;
            }
        });
    });
});