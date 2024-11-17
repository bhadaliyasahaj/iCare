let is_login = sessionStorage.getItem('logedin');
let hasPlan = sessionStorage.getItem('hasPlan');
console.log(hasPlan)
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

document.getElementById('DemoContainer').innerHTML = sessionStorage.getItem('democontent');

document.getElementById('profileBtn').addEventListener('click',()=>{
    window.location.href = "/Profile/profile.php"
});

document.getElementById('joinclassBtn').addEventListener('click',()=>{
    if(!is_login){
        window.location.href = "/Login/login.html";
    }
    if(hasPlan){
        window.location.href = "/Schedule/schedule.html";
    }else {
        window.location.href = "/Class/index.html";
    }
});