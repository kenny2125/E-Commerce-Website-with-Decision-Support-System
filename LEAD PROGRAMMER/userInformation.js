
let isEditing = false;

function toggleEdit() {
    
    const fields = document.querySelectorAll('.value');
    const editIcon = document.querySelector('.edit-icon');


    isEditing = !isEditing;

    fields.forEach(field => {
        
        field.contentEditable = isEditing;
        
        field.style.backgroundColor = isEditing ? "#f9f9f9" : "#fff";
        field.style.border = isEditing ? "1px solid #666" : "1px solid #ccc";
    });

    
    const birthdateDisplay = document.getElementById('birthdateDisplay');
    const birthdateInput = document.getElementById('birthdateInput');

    if (isEditing) {
        
        birthdateInput.style.display = "block";
        birthdateDisplay.style.display = "none";
        birthdateInput.value = formatDateToInput(birthdateDisplay.textContent); 
    } else {
        
        birthdateInput.style.display = "none";
        birthdateDisplay.style.display = "block";
    }

    
    editIcon.textContent = isEditing ? '💾' : '✏️';
}


function formatDateToInput(dateString) {
    const [day, month, year] = dateString.split('-');
    return `${year}-${month}-${day}`;
}


function updateBirthdate() {
    const birthdateInput = document.getElementById('birthdateInput');
    const birthdateDisplay = document.getElementById('birthdateDisplay');

    
    const selectedDate = new Date(birthdateInput.value);
    const formattedDate = selectedDate.toLocaleDateString('en-GB'); 

    birthdateDisplay.textContent = formattedDate.replace(/\//g, '-'); 
}