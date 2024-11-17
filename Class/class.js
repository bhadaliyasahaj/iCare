let is_login = sessionStorage.getItem('logedin');
// console.log(is_login)
if (is_login) {
    document.getElementById('logintrialBtn').style.display = "none";
    document.getElementById('profileBtn').style.display = "inline";
}

document.getElementById('burger').addEventListener('click', function burger() {

    const navmenu = document.getElementById('navmenu');
    if (navmenu.classList.contains('active')) {
        navmenu.classList.remove('active');
    }
    else {
        navmenu.classList.add('active');
    }
});

document.getElementById('profileBtn').addEventListener('click', () => {
    window.location.href = "/Profile/profile.php"
});

document.querySelectorAll('.button').forEach((element) => {
    console.log(element);

    element.addEventListener('click', (e) => {
        let btnId = e.target.id;
        console.log(btnId);

        fetch("plan.json")
            .then((res) => res.json())
            .then((data) => {
                let selectedPlan = data.plans[btnId].plan_type;
                let paymentAmount = data.plans[btnId].amount;
                let planValidity = data.plans[btnId].plan_validity;
                let planInsert = data.plans[btnId].plan_insert;
                console.log(selectedPlan + paymentAmount + planValidity);


                let params = "selectedPlan=" + encodeURIComponent(selectedPlan) +
                             "&paymentAmount=" + encodeURIComponent(paymentAmount) +
                             "&planValidity=" + encodeURIComponent(planValidity) +
                             "&planInsert=" + encodeURIComponent(planInsert);
                             console.log(params)

                fetch('plan.php', {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/x-www-form-urlencoded"
                    },
                    body: params
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error("Network response was not ok");
                    }
                    if(is_login)
                    {
                        sessionStorage.setItem("hasPlan",true);
                        window.location.href = "../TypesofYoga/typeof.html";
                    }
                    else{
                        window.location.href = "../Login/login.html";
                    }
                })
                .catch(error => {
                    console.error("There was a problem with the fetch operation:", error);
                });
            })
    });

});