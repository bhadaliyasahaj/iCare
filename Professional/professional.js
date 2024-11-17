let is_login = sessionStorage.getItem('logedin');
let hasPlan = sessionStorage.getItem('hasPlan');

// console.log(is_login)
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

document.getElementById('profileBtn').addEventListener('click',()=>{
    window.location.href = "/Profile/profile.php"
});

document.querySelectorAll('.choose').forEach((element)=>{
    console.log(element);
    element.addEventListener('click',(e)=>{
        if(hasPlan){
            window.location.href = "../TypesofYoga/typeof.html";
        } else{
            window.location.href = "../Class/index.html";
        }
    })
});