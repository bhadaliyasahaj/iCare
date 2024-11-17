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
