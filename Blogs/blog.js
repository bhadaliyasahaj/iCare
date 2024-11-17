    let is_login = sessionStorage.getItem('logedin');
    console.log(is_login)
    if(is_login){
        document.getElementById('logintrialBtn').style.display = "none";
        document.getElementById('profileBtn').style.display = "inline";
    }

document.getElementById('burger').addEventListener('click', function burger(){

    const navmenu = document.getElementById('navmenu');
    if(navmenu.classList.contains('active'))
    {
        navmenu.classList.remove('active');
    }
    else{
        navmenu.classList.add('active');
    }
});

document.querySelectorAll('.liked').forEach(element => {
    // console.log(element);
    element.addEventListener('click',function like(){

        if(element.classList.contains('fa-regular'))
        {
            element.classList.remove('fa-regular');
            element.classList.add('fa-solid');
        }
        else{
            element.classList.remove('fa-solid');
            element.classList.add('fa-regular');
        }
    })
});

document.getElementById('profileBtn').addEventListener('click',()=>{
    window.location.href = "/Profile/profile.php"
})