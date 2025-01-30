function handleLogin(event) {
    event.preventDefault(); // Prevent form submission

    const username = document.getElementById('username').value;
    const password = document.getElementById('password').value;
    const role = document.getElementById('role').value;

    // Simple validation for demonstration
    if (username === '' || password === '') {
        alert('Please enter both username and password.');
        return false;
    }

    // Redirect based on role
    if (role === 'admin' && (username === 'Om' && password === '1234' || username === 'Ibrahim' && password === '123')) {
        window.location.href = 'admin_panel.html';
    } else if (role === 'admin' && (username === 'Om' && password !== '1234' || username === 'Ibrahim' && password !== '123')) {
        alert('Please enter the correct password.');
    } else if (role === 'admin' && (username !== 'Om' && username !== 'Ibrahim')) {
        alert('Please enter the correct admin name.');
    } else if (role === 'user') {
        window.location.href = 'user_panel.html';
    }


    return false; // Prevent default form submission behavior
}