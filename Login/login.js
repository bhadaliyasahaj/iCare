function setProfile() {
    sessionStorage.setItem('logedin', true)
}


document.getElementById("submitBtn").addEventListener("click", function (event) {
    event.preventDefault(); 

    var email = document.getElementById("emailid").value;
    var pass = document.getElementById("password").value;

    if (email.trim() === "" || pass.trim() === "") {
        alert("Please enter email and password.");
        return;
    }

    if(!document.getElementById("agree").checked){
        alert("please agree the term and condition");
        return;
    }

    fetch("checkplan.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded"
        },
        body: "email=" + encodeURIComponent(email)
    })
    .then(response => {
        if (!response.ok) {
            throw new Error("Failed to check plan status.");
        }
        return response.json();
    })
    .then(data => {
        const hasPlan = data.hasPlan; // Get the plan status from the response
        if (hasPlan) {
            sessionStorage.setItem('hasPlan', true); // Store true in session storage
        }
        return hasPlan; // Return the plan status
    })
    .catch(error => {
        console.error("Error checking plan:", error);
        return false; // Return false in case of an error
    });

    fetch("login.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded"
        },
        body: "email=" + encodeURIComponent(email) + "&pass=" + encodeURIComponent(pass)
    })
        .then(response => {
            if (!response.ok) {
                throw new Error("Invalid email or password.");
            }
            window.location.href = "../Home/index.html";
            setProfile();
        })
        .catch(error => {
            alert(error.message); 
        });
});

document.getElementById('eye').addEventListener('click', () => {
    if (document.getElementById('password').type == "password") {
        document.getElementById('password').type = "text";
    } else if (document.getElementById('password').type !== "password") {
        document.getElementById('password').type = "password";
    }
});

