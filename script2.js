const xhr = new XMLHttpRequest();

xhr.open('GET', 'fetch_data.php', true);
xhr.onload = function() {
    if (xhr.status === 200) {
        const data = JSON.parse(xhr.responseText);
        const dataContainer = document.getElementById('data-container');

        dataContainer.innerHTML = `
            <p>Full Name: ${data.full_name}</p>
            <p>Date of Birth: ${data.date_of_birth}</p>
            <p>Email: ${data.email}</p>
            <p>Mobile Number: ${data.mobile_number}</p>
            <p>Gender: ${data.gender}</p>
            <p>Blood Group: ${data.blood_group}</p>
            <p>Occupation: ${data.occupation}</p>
        `;
    }
};

xhr.send();