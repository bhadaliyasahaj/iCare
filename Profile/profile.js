let is_login = sessionStorage.getItem('logedin');
console.log(is_login)
if(is_login){
    document.getElementById('logintrialBtn').style.display = "none";
    document.getElementById('profileBtn').style.display = "inline";
}

document.getElementById("logout").addEventListener('click',()=>{
    sessionStorage.clear();
});

document.getElementById('changeMail').addEventListener('click',()=>{
    let content = `  <div class="profile-form">
    <h2>Update Your Profile</h2>
    <form action="updateemail.php" method="post" id="updateProfile">
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="newemail" required>
        </div>
        <div class="form-group">
            <label for="oldpassword">Old Password</label>
            <input type="text" id="oldpassword" name="oldpassword" required>
        </div>
        <div class="form-group">
            <label for="newpassword">New Password</label>
            <input type="text" id="newpassword" name="newpassword" required>
        </div>
        <button type="submit" id="updateEmailBtn">UPDATE MAIL AND PASSWORD</button>
    </form>
</div>`
document.getElementById('secondContainer').innerHTML = content;
});


document.getElementById("updateEmailBtn").addEventListener('click',()=>{
    sessionStorage.clear();
});

