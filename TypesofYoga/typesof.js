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

document.querySelectorAll('.goBtn').forEach(element=>{
    element.addEventListener('click',(e)=>{
        let id = e.target.id;
        // console.log(e.target.id);
        fetch('DemoClass.json')
        .then(res => res.json())
        .then(data=>{
            // console.log(data.classDetails[id]);
            let detail = data.classDetails[id];
            let content = `
            <div class="mainContainer">
            <div class="firstBack">
                <div class="firstSub">
                    <div class="video-info">
                        <div class="videoDetails">
                            <h2>${detail.heading}</h2>
                            <p>${detail.content}</p>
                            <p class="props">Props: ${detail.props}</p>
                        </div>
                    </div>
                    <div class="video-frame">
                        <div class="video">
                            <iframe src="${detail.videosrc}" frameborder="0" allowfullscreen></iframe>
                        </div>
                    </div>
                </div>
            </div>
            <div class="secondBack">
                <div class="secondSub">
                    <span class="level"><i class="fa-solid fa-layer-group icon"></i> ${detail.level}</span>
                    <span class="coachname"><i class="fa-solid fa-person icon"></i> ${detail.coachname}</span>
                    <span class="duration"><i class="fa-regular fa-clock icon"></i> ${detail.classduration}</span>
                </div>
            </div>
        </div>
        <div class="secContainer">
            <div class="secBack">
                <div class="coachImage"><img src="${detail.coachimageurl}" alt=""></div>
                <div class="aboutCoach">
                    <div class="coachHeading">About The Coach</div>
                    <div class="coachName">${detail.coachname}</div>
                    <div class="coachInfo">${detail.aboutcoach}</div>
                </div>
            </div>
            </div>
            <div class="btnContainer"><button id="joinclassBtn">Join Live Class</button></div>`;
        
        sessionStorage.setItem('democontent',content);

        window.open("DemoClass/DemoClass1.html","_self");


            // document.getElementById('container2').remove();
        })
    })
});

document.getElementById('profileBtn').addEventListener('click',()=>{
    window.location.href = "/Profile/profile.php"
})